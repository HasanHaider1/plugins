import './component';
import './preview';

Shopware.Service('cmsService').registerCmsBlock({
    name: 'productcategory',
    label: 'sw-cms.blocks.commerce.productcategory.label',
    category: 'commerce',
    component: 'sw-cms-block-productcategory',
    previewComponent: 'sw-cms-preview-productcategory',
    defaultConfig: {
        marginBottom: '20px',
        marginTop: '20px',
        marginLeft: '20px',
        marginRight: '20px',
        sizingMode: 'boxed'
    },
    slots: {
        productcategory: 'productcategory'
    }
});