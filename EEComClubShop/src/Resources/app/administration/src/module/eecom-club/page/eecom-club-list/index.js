import template from './eecom-club-list.html.twig';
import './eecom-club-list.scss';

const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;

Component.register('eecom-club-list', {
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
            clubs: null,
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
        clubRepository() {
            return this.repositoryFactory.create('eecom_club');
        },

        columns() {
            return [{
                property: 'shortName',
                dataIndex: 'shortName',
                label: this.$t('eecom-club.list.columnName'),
                routerLink: 'eecom.club.detail',
                inlineEdit: 'string',
                allowResize: true,
                primary: true
            }, {
                property: 'active',
                label: this.$t('eecom-club.list.columnActive'),
                inlineEdit: 'boolean',
                allowResize: true,
                align: 'center'
            }, {
                property: 'longName',
                dataIndex: 'longName',
                label: this.$t('eecom-club.list.columnLongName')
            }, {
                property: 'fullName',
                dataIndex: 'fullName',
                label: this.$t('eecom-club.list.columnFullName')
            }];
        }
    },

    methods: {
        getList() {
            this.isLoading = true;

            const clubCriteria = new Criteria(this.page, this.limit);
            this.naturalSorting = this.sortBy === 'createdAt';

            clubCriteria.setTerm(this.term);
            clubCriteria.addSorting(Criteria.sort(this.sortBy, this.sortDirection, this.naturalSorting));
            clubCriteria.getAssociation('teams');

            this.clubRepository
                .search(clubCriteria, Shopware.Context.api)
                .then((result) => {
                    this.clubs = result;
                    this.total = result.total;
                    this.isLoading = false;
                }).catch(() => {
                this.isLoading = false;
            });
        },

        onInlineEditSave(promise, club) {
            const clubName = club.shortName;

            return promise.then(() => {
                this.createNotificationSuccess({
                    message: this.$tc('eecom-club.list.saveSuccessMessage', 0, { name: clubName})
                });
            }).catch(() => {
                this.getList();
            });
        },

        onChangeLanguage(languageId) {
            Shopware.State.commit('context/setApiLanguageId', languageId);
            this.getList();
        },
    }
});
