import template from './eecom-team-detail.html.twig';
import errorConfig from './error-cfg.json';
import eecomTeamDetail from './state';

const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;
const { hasOwnProperty } = Shopware.Utils.object;
const { mapPageErrors, mapGetters, mapState } = Shopware.Component.getComponentHelper();

Component.register('eecom-team-detail', {
    template,

    inject: [
        'repositoryFactory'
    ],

    mixins: [
        Mixin.getByName('notification'),
        Mixin.getByName('placeholder')
    ],

    props: {
        teamId: {
            type: String,
            required: false,
            default: null
        }
    },

    data() {
        return {
            processSuccess: false,
            category: null
        };
    },

    metaInfo() {
        return {
            title: this.$createTitle(this.teamTitle)
        };
    },

    computed: {
        ...mapState('eecomTeamDetail', [
            'loading',
            'team'
        ]),

        ...mapGetters('eecomTeamDetail', [
            'teamRepository',
            'isLoading'
        ]),

        ...mapPageErrors(errorConfig),

        categoryRepository() {
            return this.repositoryFactory.create('category');
        },

        teamRepository() {
            return this.repositoryFactory.create('eecom_team');
        },

        teamCriteria() {
            const criteria = new Criteria();

            criteria.getAssociation('media');
            criteria.getAssociation('league');
            criteria.getAssociation('players.player');

            criteria.addAssociation('cover');

            return criteria;
        },

        teamTitle() {
            return this.placeholder(this.team, 'name', this.teamId ? '' : this.$tc('eecom-team.detail.textHeadline'));
        }
    },

    beforeCreate() {
        Shopware.State.registerModule('eecomTeamDetail', eecomTeamDetail);
    },

    created() {
        this.createdComponent();
    },

    beforeDestroy() {
        Shopware.State.unregisterModule('eecomTeamDetail');
    },

    destroyed() {
        this.destroyedComponent();
    },

    watch: {
        teamId() {
            this.destroyedComponent();
            this.createdComponent();
        }
    },

    methods: {
        createdComponent() {
            // when create
            if (!this.teamId) {
                // set language to system language
                if (!Shopware.State.getters['context/isSystemDefaultLanguage']) {
                    Shopware.State.commit('context/resetLanguageToDefault');
                }
            }

            Shopware.State.commit('eecomTeamDetail/setTeam', this.teamRepository.create(Shopware.Context.api));
            Shopware.State.commit('eecomTeamDetail/setApiContext', Shopware.Context.api);
            this.$root.$on('sidebar-toggle-open', this.openMediaSidebar);

            if(this.teamId) {
                return this.getTeam();
            }

            // fill default data
            this.team.active = true;
            this.team.profession = 'Amateur';
            this.team.sportType = 'football';
            this.team.teamType = 'men';
        },

        destroyedComponent() {
            this.$root.$off('sidebar-toggle-open');
        },

        getTeam() {
            Shopware.State.commit('eecomTeamDetail/setLoading', true);

            this.teamRepository
                .get(this.$route.params.id, Shopware.Context.api, this.teamCriteria)
                .then((entity) => {
                    Shopware.State.commit('eecomTeamDetail/setTeam', entity);
                    Shopware.State.commit('eecomTeamDetail/setLoading', false);
                });
        },

        openMediaSidebar() {
            // Check if we have a reference to the component before calling a method
            if (!hasOwnProperty(this.$refs, 'mediaSidebarItem')
                || !this.$refs.mediaSidebarItem) {
                return;
            }
            this.$refs.mediaSidebarItem.openContent();
        },

        onClickSave() {
            Shopware.State.commit('eecomTeamDetail/setLoading', true);

            if(!this.teamId) {
                console.log('have teamId');
                this.category = this.categoryRepository.create(Shopware.Context.api);
                this.category.name = this.team.name;
                this.categoryRepository.save(this.category, Shopware.Context.api).then(() => {
                    /*console.log(this.category.id);*/
                    this.team.categoryId = this.category.id;

                    this.teamRepository
                        .save(this.team, Shopware.Context.api)
                        .then(() => {
                            if(this.teamId) {
                                this.getTeam();
                            }
                            else {
                                this.$router.push({ name: 'eecom.team.detail', params: { id: this.team.id } });
                            }
                            Shopware.State.commit('eecomTeamDetail/setLoading', false);
                            this.processSuccess = true;
                        }).catch((exception) => {
                        Shopware.State.commit('eecomTeamDetail/setLoading', false);
                        this.createNotificationError({
                            title: this.$t('eecom-team.detail.errorTitle'),
                            message: exception
                        });
                    });
                }).catch((exception) => {
                    Shopware.State.commit('eecomTeamDetail/setLoading', false);
                    this.createNotificationError({
                        title: this.$t('eecom-team.detail.errorTitle'),
                        message: exception
                    });
                });
            }
            else {
                console.log('not have teamId');
                this.teamRepository
                    .save(this.team, Shopware.Context.api)
                    .then(() => {
                        if(this.teamId) {
                            this.getTeam();
                        }
                        else {
                            this.$router.push({ name: 'eecom.team.detail', params: { id: this.team.id } });
                        }
                        Shopware.State.commit('eecomTeamDetail/setLoading', false);
                        this.processSuccess = true;
                    }).catch((exception) => {
                    Shopware.State.commit('eecomTeamDetail/setLoading', false);
                    this.createNotificationError({
                        title: this.$t('eecom-team.detail.errorTitle'),
                        message: exception
                    });
                });
            }

        },

        saveFinish() {
            this.processSuccess = false;
        },

        onAddItemToTeam(mediaItem) {
            if (this._checkIfMediaIsAlreadyUsed(mediaItem.id)) {
                this.createNotificationInfo({
                    message: this.$tc('eecom-team.mediaForm.errorMediaItemDuplicated')
                });
                return false;
            }

            this.addMedia(mediaItem).then((mediaId) => {
                this.$root.$emit('media-added', mediaId);
                return true;
            }).catch(() => {
                this.createNotificationError({
                    title: this.$tc('eecom-team.mediaForm.errorHeadline'),
                    message: this.$tc('eecom-team.mediaForm.errorMediaItemDuplicated')
                });

                return false;
            });
            return true;
        },

        addMedia(mediaItem) {
            Shopware.State.commit('eecomTeamDetail/setLoading', true);

            if (this.team.media.has(mediaItem.id)) {
                Shopware.State.commit('eecomTeamDetail/setLoading', false);
                // eslint-disable-next-line prefer-promise-reject-errors
                return Promise.reject('A media item with this id exists');
            }

            return new Promise((resolve) => {
                // if no other media exists
                if (this.team.media.length === 0) {
                    // set media item as cover
                    this.team.coverId = mediaItem.id;
                }
                this.team.media.add(mediaItem);

                Shopware.State.commit('eecomTeamDetail/setLoading', false);

                resolve(mediaItem.id);
                return true;
            });
        },

        _checkIfMediaIsAlreadyUsed(mediaId) {
            return this.team.media.some((teamMedia) => {
                return teamMedia.id === mediaId;
            });
        },

        onChangeLanguage(languageId) {
            Shopware.State.commit('context/setApiLanguageId', languageId);
            this.createdComponent();
        },

        saveOnLanguageChange() {
            return this.onClickSave();
        },

        abortOnLanguageChange() {
            return Shopware.State.getters['eecomTeamDetail/hasChanges'];
        }

    }
});
