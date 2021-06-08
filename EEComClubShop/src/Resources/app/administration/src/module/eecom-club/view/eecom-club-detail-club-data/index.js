import template from './eecom-club-detail-club-data.html.twig';
import './eecom-club-detail-club-data.scss';

const { Component, Mixin } = Shopware;
const { mapGetters, mapState } = Shopware.Component.getComponentHelper();

Component.register('eecom-club-detail-club-data', {
    template,

    mixins: [
        Mixin.getByName('placeholder')
    ],

    inject: [
        'repositoryFactory'
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
            columnCount: 5,
            columnWidth: 90
        };
    },

    computed: {
        mediaItems() {
            const mediaItems = this.clubMedia.slice();
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
            if (!this.club) {
                return null;
            }
            const coverId = this.club.cover ? this.club.cover.id : this.club.coverId;

            if(this.club.media) {
                return this.club.media.find((media) => media.id === coverId);
            }
            return null;
        },
        ...mapState('eecomClubDetail', [
            'loading',
            'club'
        ]),

        ...mapGetters('eecomClubDetail', [
            'isLoading'
        ]),

        mediaRepository() {
            return this.repositoryFactory.create('media');
        },

        clubMediaRepository() {
            return this.repositoryFactory.create(this.club.media.entity, this.club.media.source);
        },

        clubMedia() {
            if(!this.club) {
                return [];
            }

            return this.club.media;
        },

        gridAutoRows() {
            return `grid-auto-rows: ${this.columnWidth}`;
        },

        currentCoverID() {
            const coverMediaItem = this.clubMedia.find(coverMedium => coverMedium.media.id === this.club.coverId);

            return coverMediaItem.id;
        }
    },

    methods: {
        onMediaUploadButtonOpenSidebar() {
            this.$root.$emit('sidebar-toggle-open');
        },

        getPlaceholderCount(columnCount) {
            if (this.clubMedia.length + 3 < columnCount * 2) {
                columnCount *= 2;
            }

            let placeholderCount = columnCount;

            if (this.clubMedia.length !== 0) {
                placeholderCount = columnCount - ((this.clubMedia.length) % columnCount);
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
            if(this.club.media.find((clubMedia) => clubMedia.id === targetId)) {
                return;
            }

            this.mediaRepository.get(targetId, Shopware.Context.api).then((response) => {
                if(this.club.media.length <= 0) {
                    this.club.cover = response;
                    this.club.coverId = response.id;
                }
                this.club.media.add(response);
            });
        },

        onDropMedia(dragData) {
            if(this.club.media.has(dragData.id)) {
                return;
            }

            if(this.club.media.length <= 0) {
                // set media item as cover if first item
                this.club.cover = dragData;
                this.club.coverId = dragData.id;
            }
            this.club.media.add(dragData);
        },

        isCover(clubMedia) {
            const coverId = this.club.cover ? this.club.cover.id : this.club.coverId;

            if (this.club.media.length === 0 || clubMedia.isPlaceholder) {
                return false;
            }

            return clubMedia.id === coverId;
        },

        removeFile(clubMedia) {
            // remove cover id if mediaId matches
            if (this.club.coverId === clubMedia.id) {
                this.club.cover = null;
                this.club.coverId = null;
            }

            this.club.media.remove(clubMedia.id);

            if (this.club.coverId === null && this.club.media.length > 0) {
                this.club.coverId = this.club.media.first().id;
            }
        },

        markMediaAsCover(clubMedia) {
            this.club.cover = clubMedia;
            this.club.coverId = clubMedia.id;
        },

        onMediaItemDragSort(dragData, dropData, validDrop) {
            if (validDrop !== true) {
                return;
            }
            this.club.media.moveItem(dragData.position, dropData.position);

            this.updateMediaItemPositions();
        },

        updateMediaItemPositions() {
            this.clubMedia.forEach((medium, index) => {
                medium.position = index;
            });
        }
    }
});
