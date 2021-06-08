import template from './eecom-font-list.html.twig';
import './eecom-font-list.scss';

const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;

Component.register('eecom-font-list', {
    template,

    mixins: [
        Mixin.getByName('notification'),
        Mixin.getByName('listing')
    ],

    inject: [
        'repositoryFactory'
    ],

    data() {
        return {
            fonts: null,
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
        fontRepository() {
            return this.repositoryFactory.create('eecom_font');
        },

        columns() {
            return [{
                property: 'name',
                dataIndex: 'name',
                label: this.$t('eecom-font.list.columnName'),
                routerLink: 'eecom.font.detail',
                inlineEdit: 'string',
                allowResize: true,
                primary: true
            }, {
                property: 'fontUrl',
                label: this.$t('eecom-font.list.columnExternalFont'),
                allowResize: true,
                align: 'center'
            }];
        }
    },

    methods: {
        getList() {
            this.isLoading = true;

            const fontCriteria = new Criteria(this.page, this.limit);
            this.naturalSorting = this.sortBy === 'createdAt';

            fontCriteria.setTerm(this.term);
            fontCriteria.addSorting(Criteria.sort(this.sortBy, this.sortDirection, this.naturalSorting));

            this.fontRepository
                .search(fontCriteria, Shopware.Context.api)
                .then((result) => {
                    this.fonts = result;
                    this.total = result.total;
                    this.isLoading = false;
                }).catch(() => {
                this.isLoading = false;
            });
        },

        onInlineEditSave(promise, font) {
            const fontName = font.name;

            return promise.then(() => {
                this.createNotificationSuccess({
                    message: this.$tc('eecom-font.list.saveSuccessMessage', 0, { name: fontName})
                });
            }).catch(() => {
                this.getList();
            });
        }
    }
});
