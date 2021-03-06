import template from './sw-cms-el-config-product-slider.html.twig';
import './sw-cms-el-config-product-slider.scss';

const { Component, Mixin } = Shopware;
const { Criteria, EntityCollection } = Shopware.Data;

Component.register('sw-cms-el-config-product-slider', {
    template,

    inject: ['repositoryFactory'],

    mixins: [
        Mixin.getByName('cms-element')
    ],

    data() {
        return {
            productCollection: null,
            productStream: null,
            showProductStreamPreview: false,

            // Temporary values to store the previous selection in case the user changes the assignment type.
            tempProductIds: [],
            tempStreamId: null
        };
    },

    computed: {
        productRepository() {
            return this.repositoryFactory.create('product');
        },

        productStreamRepository() {
            return this.repositoryFactory.create('product_stream');
        },

        products() {
            if (this.element.data && this.element.data.products && this.element.data.products.length > 0) {
                return this.element.data.products;
            }

            return null;
        },

        productMediaFilter() {
            const criteria = new Criteria(1, 25);
            criteria.addAssociation('cover');
            criteria.addAssociation('options.group');

            return criteria;
        },

        productMultiSelectContext() {
            const context = Object.assign({}, Shopware.Context.api);
            context.inheritance = true;

            return context;
        },

        productAssignmentTypes() {
            return [ {
                label: this.$tc('sw-cms.elements.productSlider.config.productAssignmentTypeOptions.productStream'),
                value: 'product_stream'
            }];
        },
        productStreamCriteria() {
            const criteria = new Criteria(1, 10);
            const sorting = this.element.config.productStreamSorting.value;

            if (!sorting || sorting === 'random') {
                return criteria;
            }

            const field = sorting.split(':')[0];
            const direction = sorting.split(':')[1];

            criteria.addSorting(Criteria.sort(field, direction, false));

            return criteria;
        },

        productStreamPreviewColumns() {
            return [
                {
                    property: 'name',
                    label: this.$tc('sw-category.base.products.columnNameLabel'),
                    dataIndex: 'name',
                    sortable: false
                }, {
                    property: 'manufacturer.name',
                    label: this.$tc('sw-category.base.products.columnManufacturerLabel'),
                    sortable: false
                }
            ];
        }
    },

    created() {
        this.createdComponent();
    },

    methods: {
        createdComponent() {
            this.initElementConfig('product-slider');

            this.productCollection = new EntityCollection('/product', 'product', Shopware.Context.api);

            if (this.element.config.products.value.length <= 0) {
                return;
            }

            if (this.element.config.products.source === 'product_stream') {
                this.loadProductStream();
            } else {
                // We have to fetch the assigned entities again
                // ToDo: Fix with NEXT-4830
                const criteria = new Criteria(1, 100);
                criteria.addAssociation('cover');
                criteria.addAssociation('options.group');
                criteria.setIds(this.element.config.products.value);

                this.productRepository
                    .search(criteria, Object.assign({}, Shopware.Context.api, { inheritance: true }))
                    .then((result) => {
                        this.productCollection = result;
                    });
            }
        },

        onChangeAssignmentType(type) {
            if (type === 'product_stream') {
                this.tempProductIds = this.element.config.products.value;
                this.element.config.products.value = this.tempStreamId;
            } else {
                this.tempStreamId = this.element.config.products.value;
                this.element.config.products.value = this.tempProductIds;
            }
        },

        loadProductStream() {
            this.productStreamRepository
                .get(this.element.config.products.value, Shopware.Context.api, new Criteria())
                .then((result) => {
                    this.productStream = result;
                });
        },

        onChangeProductStream(streamId) {
            if (streamId === null) {
                this.productStream = null;
                return;
            }

            this.loadProductStream();
        },

        onClickProductStreamPreview() {
            if (this.productStream === null) {
                return;
            }

            this.showProductStreamPreview = true;
        },

        onCloseProductStreamModal() {
            this.showProductStreamPreview = false;
        },

        onProductsChange() {
            this.element.config.products.value = this.productCollection.getIds();

            this.$set(this.element.data, 'products', this.productCollection);
        }
    }
});