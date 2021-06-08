import template from './eecom-team-list.html.twig';
import './eecom-team-list.scss';

const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;

Component.register('eecom-team-list', {
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
            teams: null,
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
        teamRepository() {
            return this.repositoryFactory.create('eecom_team');
        },

        columns() {
            return [{
                property: 'name',
                dataIndex: 'name',
                label: this.$t('eecom-team.list.columnName'),
                routerLink: 'eecom.team.detail',
                inlineEdit: 'string',
                allowResize: true,
                primary: true
            }, {
                property: 'active',
                label: this.$t('eecom-team.list.columnActive'),
                inlineEdit: 'boolean',
                allowResize: true,
                align: 'center'
            }, {
                property: 'teamClub.club.shortName',
                dataIndex: 'teamClub.club.shortName',
                label: this.$t('eecom-team.list.columnClub'),
                allowResize: true,
            }, {
                property: 'profession',
                dataIndex: 'profession',
                label: this.$t('eecom-team.list.columnProfession'),
                allowResize: true,
            }];
        }
    },

    methods: {
        getList() {
            this.isLoading = true;

            const teamCriteria = new Criteria(this.page, this.limit);
            this.naturalSorting = this.sortBy === 'createdAt';

            teamCriteria.setTerm(this.term);
            teamCriteria.addSorting(Criteria.sort(this.sortBy, this.sortDirection, this.naturalSorting));
            teamCriteria.getAssociation('teamClub.club');

            this.teamRepository
                .search(teamCriteria, Shopware.Context.api)
                .then((result) => {
                    this.teams = result;
                    this.total = result.total;
                    this.isLoading = false;
                }).catch(() => {
                this.isLoading = false;
            });
        },

        onInlineEditSave(promise, team) {
            const teamName = team.name;

            return promise.then(() => {
                this.createNotificationSuccess({
                    message: this.$tc('eecom-team.list.saveSuccessMessage', 0, { name: teamName})
                });
            }).catch(() => {
                this.getList();
            });
        },

        onChangeLanguage(languageId) {
            Shopware.State.commit('context/setApiLanguageId', languageId);
            this.getList();
        }
    }
});
