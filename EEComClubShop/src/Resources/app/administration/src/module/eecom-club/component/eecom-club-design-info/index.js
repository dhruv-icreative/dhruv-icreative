import template from './eecom-club-design-info.html.twig';

const { Component } = Shopware;
const { mapGetters, mapState } = Shopware.Component.getComponentHelper();

Component.register('eecom-club-design-info', {
    template,

    data() {
        return {
            currentDesign: null
        };
    },
    computed: {
        options() {
            return [
                { id: 'smoky', name: this.$t('eecom-club.detailClubDesign.smokyDesignLabel') },
                { id: 'wave', name: this.$t('eecom-club.detailClubDesign.waveDesignLabel') },
                { id: 'peaks', name: this.$t('eecom-club.detailClubDesign.peaksDesignLabel') },
                { id: 'lowpoly', name: this.$t('eecom-club.detailClubDesign.lowpolyDesignLabel') },
            ];
        },
        ...mapState('eecomClubDetail', [
            'club'
        ]),

        ...mapGetters('eecomClubDetail', [
            'isLoading'
        ]),
    },

    methods: {
        openPreviewModal() {
            this.currentDesign = this.club.clubShopDesign;
        },

        closePreviewModal() {
            this.currentDesign = null;
        }
    }
});
