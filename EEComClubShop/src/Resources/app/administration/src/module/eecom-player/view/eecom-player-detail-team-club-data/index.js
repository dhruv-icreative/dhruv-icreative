import template from './eecom-player-detail-team-club-data.html.twig';
import './eecom-player-detail-team-club-data.scss';

const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;
const { mapPropertyErrors, mapGetters, mapState } = Shopware.Component.getComponentHelper();

Component.register('eecom-player-detail-team-club-data', {
    template,

    mixins: [
        Mixin.getByName('placeholder')
    ],

    inject: [
        'repositoryFactory'
    ],

    computed: {
        teamPlayerRepository() {
            return this.repositoryFactory.create("eecom_team_player");
        },
        professionOptions() {
            return [
                { value: 'Amateur', name: this.$t('eecom-player.detailTeamClubData.amateurText') },
                { value: 'Semi-Pro', name: this.$t('eecom-player.detailTeamClubData.semiproText') },
                { value: 'Pro', name: this.$t('eecom-player.detailTeamClubData.proText') }
            ];
        },

        jerseySizeOptions() {
            return [
                {value: 'xs', name: this.$t('eecom-player.detailTeamClubData.xsSizeText')},
                {value: 's', name: this.$t('eecom-player.detailTeamClubData.sSizeText')},
                {value: 'm', name: this.$t('eecom-player.detailTeamClubData.mSizeText')},
                {value: 'l', name: this.$t('eecom-player.detailTeamClubData.lSizeText')},
                {value: 'xl', name: this.$t('eecom-player.detailTeamClubData.xlSizeText')},
                {value: '2xl', name: this.$t('eecom-player.detailTeamClubData.2xlSizeText')},
                {value: '3xl', name: this.$t('eecom-player.detailTeamClubData.3xlSizeText')},
            ];
        },

        shortSizeOptions() {
            return [
                {value: 'xs', name: this.$t('eecom-player.detailTeamClubData.xsSizeText')},
                {value: 's', name: this.$t('eecom-player.detailTeamClubData.sSizeText')},
                {value: 'm', name: this.$t('eecom-player.detailTeamClubData.mSizeText')},
                {value: 'l', name: this.$t('eecom-player.detailTeamClubData.lSizeText')},
                {value: 'xl', name: this.$t('eecom-player.detailTeamClubData.xlSizeText')},
                {value: '2xl', name: this.$t('eecom-player.detailTeamClubData.2xlSizeText')},
                {value: '3xl', name: this.$t('eecom-player.detailTeamClubData.3xlSizeText')},
            ];
        },

        ...mapState('eecomPlayerDetail', [
            'player'
        ]),

        ...mapGetters('eecomPlayerDetail', [
            'isLoading'
        ]),

        ...mapPropertyErrors('player', [
            'profession',
            'jerseySize',
            'shortSize'
        ]),

        productCriteria() {
            const productCriteria = new Criteria();
            productCriteria.addFilter(Criteria.equals('parentId', null));

            return productCriteria;
        },

        eecomTeamId: {
            get: function () {
                if (!this.player.playerTeam) {
                    return
                }

                return this.player.playerTeam.eecomTeamId;
            },

            set: function (id) {
                if (!this.player.playerTeam) {
                    this.player.playerTeam = this.teamPlayerRepository.create(Shopware.Context.api);
                }

                this.player.playerTeam.eecomTeamId = id;
            }
        }
    }
});
