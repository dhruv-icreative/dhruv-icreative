import template from './eecom-club-detail.html.twig';
import errorConfig from './error-cfg.json';
import eecomClubDetail from './state';

const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;
const { hasOwnProperty } = Shopware.Utils.object;
const { mapPageErrors, mapGetters, mapState } = Shopware.Component.getComponentHelper();

Component.register('eecom-club-detail', {
    template,

    inject: [
        'mediaService',
        'repositoryFactory'
    ],

    mixins: [
        Mixin.getByName('notification'),
        Mixin.getByName('placeholder')
    ],

    props: {
        clubId: {
            type: String,
            required: false,
            default: null
        }
    },

    data() {
        return {
            processSuccess: false,
            mediaLogoSquare: null,
            mediaLogoLandscape: null
        };
    },

    metaInfo() {
        return {
            title: this.$createTitle(this.clubTitle)
        };
    },

    computed: {
        ...mapState('eecomClubDetail', [
            'loading',
            'club'
        ]),

        ...mapGetters('eecomClubDetail', [
            'clubRepository',
            'isLoading'
        ]),

        ...mapPageErrors(errorConfig),

        clubRepository() {
            return this.repositoryFactory.create('eecom_club');
        },

        clubCriteria() {
            const criteria = new Criteria();

            criteria.getAssociation('seoUrls')
                .addFilter(Criteria.equals('isCanonical', true));

            criteria.getAssociation('media');
            criteria.getAssociation('teams');

            criteria
                .addAssociation('seoUrls')
                .addAssociation('cover')
                .addAssociation('clubLogoSquare')
                .addAssociation('clubLogoLandscape');

            return criteria;
        },

        clubTitle() {
            return this.placeholder(this.club, 'shortName', this.clubId ? '' : this.$tc('eecom-club.detail.textHeadline'));
        }
    },

    beforeCreate() {
        Shopware.State.registerModule('eecomClubDetail', eecomClubDetail);
    },

    created() {
        this.createdComponent();
    },

    beforeDestroy() {
        Shopware.State.unregisterModule('eecomClubDetail');
    },

    destroyed() {
        this.destroyedComponent();
    },

    watch: {
        clubId() {
            this.destroyedComponent();
            this.createdComponent();
        }
    },

    methods: {
        createdComponent() {
            // when create
            if (!this.clubId) {
                // set language to system language
                if (!Shopware.State.getters['context/isSystemDefaultLanguage']) {
                    Shopware.State.commit('context/resetLanguageToDefault');
                }
            }

            Shopware.State.commit('eecomClubDetail/setClub', this.clubRepository.create(Shopware.Context.api));
            Shopware.State.commit('eecomClubDetail/setApiContext', Shopware.Context.api);
            this.$root.$on('sidebar-toggle-open', this.openMediaSidebar);

            if(this.clubId) {
                return this.getClub();
            }

            this.club.active = true;
        },

        destroyedComponent() {
            this.$root.$off('sidebar-toggle-open');
        },

        getClub() {
            Shopware.State.commit('eecomClubDetail/setLoading', true);

            this.clubRepository
                .get(this.$route.params.id, Shopware.Context.api, this.clubCriteria)
                .then((entity) => {
                    Shopware.State.commit('eecomClubDetail/setClub', entity);
                    Shopware.State.commit('eecomClubDetail/setLoading', false);
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
            Shopware.State.commit('eecomClubDetail/setLoading', true);

            this.clubRepository
                .save(this.club, Shopware.Context.api)
                .then(() => {
                    if(this.clubId) {
                        this.getClub();
                    }
                    else {
                        this.$router.push({ name: 'eecom.club.detail', params: { id: this.club.id } });
                    }
                    Shopware.State.commit('eecomClubDetail/setLoading', false);
                    this.processSuccess = true;
                }).catch((exception) => {
                    Shopware.State.commit('eecomClubDetail/setLoading', false);
                    this.createNotificationError({
                        title: this.$t('eecom-club.detail.errorTitle'),
                        message: exception
                    });
                });
        },

        saveFinish() {
            this.processSuccess = false;
        },

        onChangeLanguage(languageId) {
            Shopware.State.commit('context/setApiLanguageId', languageId);
            this.createdComponent();
        },

        saveOnLanguageChange() {
            return this.onClickSave();
        },

        abortOnLanguageChange() {
            return Shopware.State.getters['eecomClubDetail/hasChanges'];
        }
    }
});
