import template from './sw-cms-el-productcategory.html.twig';
import './sw-cms-el-productcategory.scss';

Shopware.Component.register('sw-cms-el-productcategory', {
    template,

    mixins: [
        'cms-element'
    ],

    computed: {
        myProduct() {
            return `${this.element.config.myProduct.id}`;
        }
    },

    created() {
        this.createdComponent();
    },

    methods: {
        createdComponent() {
            this.initElementConfig('productcategory');
        }
    }
});