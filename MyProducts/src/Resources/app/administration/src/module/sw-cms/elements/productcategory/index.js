Shopware.Service('cmsService').registerCmsElement({
    name: 'productcategory',
    label: 'sw-cms.elements.customProductCategoryElement.label',
    component: 'sw-cms-el-productcategory',
    configComponent: 'sw-cms-el-config-productcategory',
    previewComponent: 'sw-cms-el-preview-productcategory',
    defaultConfig: {
        defProduct: {
            id: '1',
            name: 'default product',
            image: ''
        }
    }
});
