import template from './eecom-team-detail-product-assignment.html.twig';
import './eecom-team-detail-product-assignment.scss';

const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;
const { mapPropertyErrors, mapGetters, mapState } = Shopware.Component.getComponentHelper();
const ShopwareError = Shopware.Classes.ShopwareError;

Component.register('eecom-team-detail-product-assignment', {
    template,

    inject: [
        'repositoryFactory'
    ],

    mixins: [
        Mixin.getByName('placeholder')
    ],

    data() {
        return {
            productStreamFilter: null,
            productStreamInvalid: false,
            manualAssignedProductsCount: 0
        }
    },

    watch: {
        'team.productStreamId'(id) {
            if (!id) {
                this.productStreamFilter = null;
                return;
            }
            this.loadProductStreamPreview();
        }
    },

    created() {
        this.createdComponent();
    },

    computed: {
        productAssignmentTypes() {
            return [
                {
                    value: 'product',
                    label: this.$tc('eecom-team.detailProductAssignment.productAssignmentTypeManualLabel')
                },
                {
                    value: 'product_stream',
                    label: this.$tc('eecom-team.detailProductAssignment.productAssignmentTypeStreamLabel')
                }
            ];
        },

        ...mapState('eecomTeamDetail', [
            'team'
        ]),

        ...mapGetters('eecomTeamDetail', [
            'isLoading'
        ]),

        ...mapPropertyErrors('team', [
            'productStreamId',
            'productAssignmentType'
        ]),

        productStreamRepository() {
            return this.repositoryFactory.create('product_stream');
        },

        productColumns() {
            return [
                {
                    property: 'name',
                    label: this.$tc('eecom-team.detailProductAssignment.columnNameLabel'),
                    dataIndex: 'name',
                    routerLink: 'sw.product.detail',
                    sortable: false
                }, {
                    property: 'manufacturer.name',
                    label: this.$tc('eecom-team.detailProductAssignment.columnManufacturerLabel'),
                    routerLink: 'sw.manufacturer.detail',
                    sortable: false
                }
            ];
        },

        manufacturerColumn() {
            return 'column-manufacturer.name';
        },

        nameColumn() {
            return 'column-name';
        },

        productCriteria() {
            const productCriteria = new Criteria(1, 10);
            productCriteria
                .addAssociation('options.group')
                .addAssociation('manufacturer')
                .addFilter(Criteria.equals('parentId', null));
            return productCriteria;
        },

        productStreamInvalidError() {
            if (this.productStreamInvalid) {
                return new ShopwareError({
                    code: 'PRODUCT_STREAM_INVALID',
                    detail: this.$tc('eecom-team.detailProductAssignment.dynamicProductGroupInvalidMessage')
                });
            }
            return null;
        },
    },

    methods: {
        createdComponent() {
            if (!this.team.productStreamId) {
                return;
            }
            this.loadProductStreamPreview();
        },

        loadProductStreamPreview() {
            this.productStreamRepository
                .get(this.team.productStreamId, Shopware.Context.api)
                .then((response) => {
                    this.productStreamFilter = response.apiFilter;
                    this.productStreamInvalid = response.invalid;
                });
        },

        onPaginateManualProductAssignment(assignment) {
            this.manualAssignedProductsCount = assignment.total;
        }
    }
});
