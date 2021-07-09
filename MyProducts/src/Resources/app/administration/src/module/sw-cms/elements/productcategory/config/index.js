import template from './sw-cms-el-config-productcategory.html.twig';

Shopware.Component.register('sw-cms-el-config-productcategory', {
    template,

    mixins: [
        'cms-element'
    ],

    computed: {
        defProduct() {
            return this.element.config.defProduct;
        }
    },

    created() {
        this.createdComponent();
    },

    methods: {
        createdComponent() {
            this.initElementConfig('productcategory');
        },

        onElementUpdate(element) {
            this.$emit('element-update', element);
        }
    }
});