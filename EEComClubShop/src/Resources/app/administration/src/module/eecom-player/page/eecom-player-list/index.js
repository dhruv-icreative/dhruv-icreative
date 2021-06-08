import template from './eecom-player-list.html.twig';
import './eecom-player-list.scss';

const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;

Component.register('eecom-player-list', {
    template,

    inject: [
        'repositoryFactory'
    ],

    mixins: [
        Mixin.getByName('notification'),
        Mixin.getByName('listing')
    ],

    data() {
        return {
            players: null,
            sortBy: 'createdAt',
            sortDirection: 'DESC',
            naturalSorting: true,
            isLoading: false,
            total: 0
        };
    },

    metaInfo() {
        return {
            title: this.$createTitle()
        };
    },

    computed: {
        playerRepository() {
            return this.repositoryFactory.create('eecom_player');
        },

        columns() {
            return [{
                property: 'lastName',
                dataIndex: 'lastName',
                label: this.$t('eecom-player.list.columnName'),
                inlineEdit: 'string',
                allowResize: true,
            }, {
                property: 'firstName',
                dataIndex: 'firstName',
                label: this.$t('eecom-player.list.columnFirstName'),
                routerLink: 'eecom.player.detail',
                inlineEdit: 'string',
                allowResize: true,
                primary: true
            }, {
                property: 'active',
                label: this.$t('eecom-player.list.columnActive'),
                inlineEdit: 'boolean',
                allowResize: true,
                align: 'center'
            }, {
                property: 'playerTeam.team.name',
                dataIndex: 'playerTeam.team.name',
                label: this.$t('eecom-player.list.columnClubTeam'),
                allowResize: true,
            }, {
                property: 'profession',
                dataIndex: 'profession',
                label: this.$t('eecom-player.list.columnProfession'),
                allowResize: true,
            },  {
                property: 'hocMember',
                dataIndex: 'hocMember',
                label: this.$t('eecom-player.list.columnHocMember'),
                allowResize: true,
                align: 'center'
            }];
        }
    },

    methods: {
        getList() {
            this.isLoading = true;

            const playerCriteria = new Criteria(this.page, this.limit);
            this.naturalSorting = this.sortBy === 'createdAt';

            playerCriteria.setTerm(this.term);
            playerCriteria.addSorting(Criteria.sort(this.sortBy, this.sortDirection, this.naturalSorting));
            playerCriteria.getAssociation('playerTeam.team.teamClub.club');

            this.playerRepository
                .search(playerCriteria, Shopware.Context.api)
                .then((result) => {
                    this.players = result;
                    this.total = result.total;
                    this.isLoading = false;
                }).catch(() => {
                this.isLoading = false;
            });
        },

        onInlineEditSave(promise, player) {
            const playerName = player.firstName;

            return promise.then(() => {
                this.createNotificationSuccess({
                    message: this.$tc('eecom-player.list.saveSuccessMessage', 0, { name: playerName})
                });
            }).catch(() => {
                this.getList();
            });
        }
    }
});
