import template from './eecom-club-data-basic-info.html.twig';

const { Component, Mixin } = Shopware;
const { mapPropertyErrors, mapGetters, mapState } = Shopware.Component.getComponentHelper();

Component.register('eecom-club-data-basic-info', {
    template,

    mixins: [
        Mixin.getByName('placeholder')
    ],

    inject: [
        'repositoryFactory'
    ],

    data() {
        return {
            country: null
        };
    },

    computed: {
        ...mapState('eecomClubDetail', [
            'loading',
            'club'
        ]),

        ...mapGetters('eecomClubDetail', [
            'isLoading'
        ]),

        ...mapPropertyErrors('club', [
            'shortName',
            'countryId'
        ]),

        countryRepository() {
            return this.repositoryFactory.create('country');
        },

        mediaRepository() {
            return this.repositoryFactory.create('media');
        },

        countryId: {
            get() {
                return this.club.countryId;
            },

            set(countryId) {
                this.club.countryId = countryId;
            }
        },

        isTitleRequired() {
            return Shopware.State.getters['context/isSystemDefaultLanguage'];
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
        }
    },

    methods: {
        onMediaUploadButtonOpenSidebar() {
            this.$root.$emit('sidebar-toggle-open');
        },

        setMediaLogoSquare({ targetId }) {
            this.mediaRepository.get(targetId, Shopware.Context.api).then((response) => {
                this.club.clubLogoSquare = response;
            });

            this.club.logoSquareId = targetId;
        },

        onDropMediaLogoSquare(mediaItem) {
            this.setMediaLogoSquare({ targetId: mediaItem.id });
        },

        onUnlinkLogoSquare() {
            this.club.logoSquareId = null;
            this.club.clubLogoSquare = null;
        },

        setMediaLogoLandscape({ targetId }) {
            this.mediaRepository.get(targetId, Shopware.Context.api).then((response) => {
                this.club.clubLogoLandscape = response;
            });

            this.club.logoLandscapeId = targetId;
        },

        onDropMediaLogoLandscape(mediaItem) {
            this.setMediaLogoLandscape({ targetId: mediaItem.id });
        },

        onUnlinkLogoLandscape() {
            this.club.logoLandscapeId = null;
            this.club.clubLogoLandscape = null;
        }
    }
});
