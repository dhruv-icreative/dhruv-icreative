import template from'./eecom-player-detail-player-data.html.twig';
import './eecom-player-detail-player-data.scss';

const { Component, Mixin } = Shopware;
const { mapPropertyErrors, mapGetters, mapState } = Shopware.Component.getComponentHelper();

Component.register('eecom-player-detail-player-data', {
    template,

    mixins: [
        Mixin.getByName('placeholder')
    ],

    inject: [
        'repositoryFactory'
    ],

    data() {
        return {
            country: null,
            nation: null
        }
    },

    computed: {
        genderOptions() {
            return [
                { id: 'male', name: this.$t('eecom-player.detailPlayerData.maleText') },
                { id: 'female', name: this.$t('eecom-player.detailPlayerData.femaleText') },
                { id: 'other', name: this.$t('eecom-player.detailPlayerData.otherText') }
            ];
        },

        playingFootOptions() {
            return [
                { value: 'Right', name: this.$t('eecom-player.detailPlayerData.rightFootText') },
                { value: 'Left', name: this.$t('eecom-player.detailPlayerData.leftFootText') }
            ];
        },
        ...mapState('eecomPlayerDetail', [
            'player'
        ]),

        ...mapGetters('eecomPlayerDetail', [
            'isLoading'
        ]),

        ...mapPropertyErrors('player', [
            'countryId',
            'nationId'
        ]),

        countryRepository() {
            return this.repositoryFactory.create('country');
        },

        mediaRepository() {
            return this.repositoryFactory.create('media');
        },

        countryId: {
            get() {
                return this.player.countryId;
            },

            set(countryId) {
                this.player.countryId = countryId;
            }
        },

        nationId: {
            get() {
                return this.player.nationId;
            },

            set(nationId) {
                this.player.nationId = nationId;
            }
        }
    },

    watch: {
        countryId: {
            immediate: true,
            handler() {
                if(this.countryId === null) {
                    this.country = null;
                    return Promise.resolve();
                }

                return this.countryRepository.get(this.countryId, Shopware.Context.api).then((country) => {
                    this.country = country;
                });
            }
        },

        nationId: {
            immediate: true,
            handler() {
                if(this.nationId === null) {
                    this.nation = null;
                    return Promise.resolve();
                }

                return this.countryRepository.get(this.nationId, Shopware.Context.api).then((nation) => {
                    this.nation = nation;
                });
            }
        }
    },

    methods: {
        onMediaUploadButtonOpenSidebar() {
            this.$root.$emit('sidebar-toggle-open');
        },

        setMediaLogoSquare({ targetId }) {
            this.mediaRepository.get(targetId, Shopware.Context.api).then((response) => {
                this.player.playerPicture = response;
            });

            this.player.playerPictureMediaId = targetId;
        },

        onDropMedia(mediaItem) {
            this.setMediaLogoSquare({ targetId: mediaItem.id });
        },

        onUnlinkMedia() {
            this.player.playerPictureMediaId = null;
            this.player.playerPicture = null;
        },
    }
});
