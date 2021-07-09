import template from './sw-cms-el-productcategory.html.twig';
import './sw-cms-el-productcategory.scss';

Shopware.Component.register('sw-cms-el-productcategory', {
    template,
    computed: {
        defProduct() {
            return `this.element.config.defProduct.image}`;
        }
    },
});


