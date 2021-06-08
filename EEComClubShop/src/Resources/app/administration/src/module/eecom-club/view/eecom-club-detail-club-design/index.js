import template from './eecom-club-detail-club-design.html.twig';
import './eecom-club-detail-club-design.scss';

const { Component } = Shopware;
const { mapGetters, mapState } = Shopware.Component.getComponentHelper();

Component.register('eecom-club-detail-club-design', {
    template,

    computed: {
        ...mapState('eecomClubDetail', [
            'club'
        ]),

        ...mapGetters('eecomClubDetail', [
            'isLoading'
        ])
    },
});
