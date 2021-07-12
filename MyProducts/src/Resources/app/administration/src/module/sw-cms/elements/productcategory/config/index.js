import template from './sw-cms-el-config-productcategory.html.twig';
import './sw-cms-el-config-productcategory.scss';

const { Component, Mixin } = Shopware;
const { Criteria, EntityCollection } = Shopware.Data;

Component.register('sw-cms-el-config-productcategory', {
    template,

    inject: ['repositoryFactory'],

    mixins: [
        Mixin.getByName('cms-element')
    ],

    data() {
        return {
            productCollection: [preview_camera_large.jpg, preview_glasses_large.jpg, preview_mountain_large.jpg],
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



    created() {
        this.createdComponent();
    },

    methods: {
        createdComponent() {
            this.initElementConfig('productcategory');

            this.productCollection = new EntityCollection('/product', 'product', Shopware.Context.api);

            if (this.element.config.products.value.length <= 0) {
                return;
            }


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


        onProductsChange() {
            this.element.config.products.value = this.productCollection.getIds();

            this.$set(this.element.data, 'products', this.productCollection);
        }
    }
});