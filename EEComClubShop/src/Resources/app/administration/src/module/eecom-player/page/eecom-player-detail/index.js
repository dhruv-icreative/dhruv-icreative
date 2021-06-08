import template from './eecom-player-detail.html.twig';
import errorConfig from "./error-cfg.json";
import eecomPlayerDetail from "./state";

const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;
const { hasOwnProperty } = Shopware.Utils.object;
const { mapPageErrors, mapGetters, mapState } = Shopware.Component.getComponentHelper();

Component.register('eecom-player-detail', {
    template,

    inject: [
        'repositoryFactory'
    ],

    mixins: [
        Mixin.getByName('notification'),
        Mixin.getByName('placeholder')
    ],

    props: {
        playerId: {
            type: String,
            required: false,
            default: null
        }
    },

    data() {
        return {
            processSuccess: false
        };
    },

    metaInfo() {
        return {
            title: this.$createTitle(this.playerTitle)
        };
    },

    computed: {
        ...mapState('eecomPlayerDetail', [
            'loading',
            'player'
        ]),

        ...mapGetters('eecomPlayerDetail', [
            'playerRepository',
            'isLoading'
        ]),

        ...mapPageErrors(errorConfig),

        playerRepository() {
            return this.repositoryFactory.create('eecom_player');
        },

        playerCriteria() {
            const criteria = new Criteria();

            criteria.getAssociation('playerPicture');
            criteria.getAssociation('shoeProducts');
            criteria.getAssociation('onePlayingPositions');
            criteria.getAssociation('twoPlayingPositions');
            criteria.getAssociation('teamPositions');
            criteria.getAssociation('playerTeam');

            return criteria;
        },

        playerTitle() {
            return this.placeholder(this.player, 'firstName', this.playerId ? '' : this.$tc('eecom-player.detail.textHeadline'));
        }
    },

    beforeCreate() {
        Shopware.State.registerModule('eecomPlayerDetail', eecomPlayerDetail);
    },

    created() {
        this.createdComponent();
    },

    beforeDestroy() {
        Shopware.State.unregisterModule('eecomPlayerDetail');
    },

    destroyed() {
        this.destroyedComponent();
    },

    watch: {
        playerId() {
            this.destroyedComponent();
            this.createdComponent();
        }
    },

    methods: {
        createdComponent() {
            Shopware.State.commit('eecomPlayerDetail/setPlayer', this.playerRepository.create(Shopware.Context.api));
            Shopware.State.commit('eecomPlayerDetail/setApiContext', Shopware.Context.api);
            this.$root.$on('sidebar-toggle-open', this.openMediaSidebar);

            if(this.playerId) {
                return this.getPlayer();
            }

            // fill default data
            this.player.active = true;
            this.player.gender = 'male';
            this.player.playingFoot = 'Right';
            this.player.profession = 'Amateur';
            this.player.jerseySize = 's';
            this.player.shortSize = 's';
        },

        destroyedComponent() {
            this.$root.$off('sidebar-toggle-open');
        },

        getPlayer() {
            Shopware.State.commit('eecomPlayerDetail/setLoading', true);

            this.playerRepository
                .get(this.$route.params.id, Shopware.Context.api, this.playerCriteria)
                .then((entity) => {
                    Shopware.State.commit('eecomPlayerDetail/setPlayer', entity);
                    Shopware.State.commit('eecomPlayerDetail/setLoading', false);
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
            Shopware.State.commit('eecomPlayerDetail/setLoading', true);

            this.playerRepository
                .save(this.player, Shopware.Context.api)
                .then(() => {
                    if(this.playerId) {
                        this.getPlayer();
                    }
                    else {
                        this.$router.push({ name: 'eecom.player.detail', params: { id: this.player.id } });
                    }
                    Shopware.State.commit('eecomPlayerDetail/setLoading', false);
                    this.processSuccess = true;
                }).catch((exception) => {
                Shopware.State.commit('eecomPlayerDetail/setLoading', false);
                this.createNotificationError({
                    title: this.$t('eecom-player.detail.errorTitle'),
                    message: this.$t('eecom-player.detail.errorMessage')
                });
            });
        },

        saveFinish() {
            this.processSuccess = false;
        },
    }
});
