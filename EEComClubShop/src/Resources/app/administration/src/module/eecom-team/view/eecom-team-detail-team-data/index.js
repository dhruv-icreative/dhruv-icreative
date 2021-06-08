import template from './eecom-team-detail-team-data.html.twig';
import './eecom-team-detail-team-data.scss';

const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;
const { mapPropertyErrors, mapGetters, mapState } = Shopware.Component.getComponentHelper();

Component.register('eecom-team-detail-team-data', {
    template,

    mixins: [
        Mixin.getByName('placeholder')
    ],

    inject: [
        'repositoryFactory'
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
            league: null,
            columnCount: 5,
            columnWidth: 90
        };
    },

    computed: {
        professionOptions() {
            return [
                { value: 'Amateur', name: this.$t('eecom-team.detail.amateurText') },
                { value: 'Semi-Pro', name: this.$t('eecom-team.detail.semiproText') },
                { value: 'Pro', name: this.$t('eecom-team.detail.proText') }
            ]
        },

        sportTypeOptions() {
            return [
                { id: 'football', name: this.$t('eecom-team.detail.footballText') },
                { id: 'handball', name: this.$t('eecom-team.detail.handballText') },
                { id: 'volleyball', name: this.$t('eecom-team.detail.volleyballText') },
                { id: 'basketball', name: this.$t('eecom-team.detail.basketballText') }
            ]
        },

        teamTypeOptions() {
            return [
                { id: 'men', name: this.$t('eecom-team.detail.menText') },
                { id: 'women', name: this.$t('eecom-team.detail.womenText') },
                { id: 'youth', name: this.$t('eecom-team.detail.youthText') },
                { id: 'kids', name: this.$t('eecom-team.detail.kidsText') }
            ]
        },

        mediaItems() {
            const mediaItems = this.teamMedia.slice();
            const placeholderCount = this.getPlaceholderCount(this.columnCount);

            if (placeholderCount === 0) {
                return mediaItems;
            }

            for (let i = 0; i < placeholderCount; i += 1) {
                mediaItems.push(this.createPlaceholderMedia(mediaItems));
            }
            return mediaItems;
        },

        cover() {
            if (!this.team) {
                return null;
            }
            const coverId = this.team.cover ? this.team.cover.id : this.team.coverId;

            if(this.team.media) {
                return this.team.media.find((media) => media.id === coverId);
            }
            return null;
        },

        ...mapState('eecomTeamDetail', [
            'loading',
            'team'
        ]),

        ...mapGetters('eecomTeamDetail', [
            'isLoading'
        ]),

        ...mapPropertyErrors('team', [
            'name',
            'profession',
            'sportType',
            'teamType'
        ]),

        mediaRepository() {
            return this.repositoryFactory.create('media');
        },

        leagueRepository() {
            return this.repositoryFactory.create('eecom_league');
        },

        teamMediaRepository() {
            return this.repositoryFactory.create(this.team.media.entity, this.team.media.source);
        },

        teamMedia() {
            if(!this.team) {
                return [];
            }

            return this.team.media;
        },

        gridAutoRows() {
            return `grid-auto-rows: ${this.columnWidth}`;
        },

        currentCoverID() {
            const coverMediaItem = this.teamMedia.find(coverMedium => coverMedium.media.id === this.team.coverId);

            return coverMediaItem.id;
        },

        isTitleRequired() {
            return Shopware.State.getters['context/isSystemDefaultLanguage'];
        },

        categoryCriteria() {
            const categoryCriteria = new Criteria();
            categoryCriteria.addFilter(Criteria.equals('categoryId', null));

            return categoryCriteria;
        }
    },

    methods: {
        onMediaUploadButtonOpenSidebar() {
            this.$root.$emit('sidebar-toggle-open');
        },

        getPlaceholderCount(columnCount) {
            if (this.teamMedia.length + 3 < columnCount * 2) {
                columnCount *= 2;
            }

            let placeholderCount = columnCount;

            if (this.teamMedia.length !== 0) {
                placeholderCount = columnCount - ((this.teamMedia.length) % columnCount);
                if (placeholderCount === columnCount) {
                    return 0;
                }
            }

            return placeholderCount;
        },

        createPlaceholderMedia(mediaItems) {
            return {
                isPlaceholder: true,
                isCover: mediaItems.length === 0,
                media: {
                    isPlaceholder: true,
                    name: ''
                },
                id: mediaItems.length.toString()
            };
        },

        setMediaItem({ targetId }) {
            // on replace
            if(this.team.media.find((teamMedia) => teamMedia.id === targetId)) {
                return;
            }

            this.mediaRepository.get(targetId, Shopware.Context.api).then((response) => {
                if(this.team.media.length <= 0) {
                    this.team.cover = response;
                    this.team.coverId = response.id;
                }
                this.team.media.add(response);
            });
        },

        onDropMedia(dragData) {
            if(this.team.media.has(dragData.id)) {
                return;
            }

            if(this.team.media.length <= 0) {
                // set media item as cover if first item
                this.team.cover = dragData;
                this.team.coverId = dragData.id;
            }
            this.team.media.add(dragData);
        },

        isCover(teamMedia) {
            const coverId = this.team.cover ? this.team.cover.id : this.team.coverId;

            if (this.team.media.length === 0 || teamMedia.isPlaceholder) {
                return false;
            }

            return teamMedia.id === coverId;
        },

        removeFile(teamMedia) {
            // remove cover id if mediaId matches
            if (this.team.coverId === teamMedia.id) {
                this.team.cover = null;
                this.team.coverId = null;
            }

            this.team.media.remove(teamMedia.id);

            if (this.team.coverId === null && this.team.media.length > 0) {
                this.team.coverId = this.team.media.first().id;
            }
        },

        markMediaAsCover(teamMedia) {
            this.team.cover = teamMedia;
            this.team.coverId = teamMedia.id;
        },

        onMediaItemDragSort(dragData, dropData, validDrop) {
            if (validDrop !== true) {
                return;
            }
            this.team.media.moveItem(dragData.position, dropData.position);

            this.updateMediaItemPositions();
        },

        updateMediaItemPositions() {
            this.teamMedia.forEach((medium, index) => {
                medium.position = index;
            });
        }
    }
});
