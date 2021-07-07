import template from './sw-cms-el-config-dailymotion.html.twig';

Shopware.Component.register('sw-cms-el-config-dailymotion', {
    template,

    mixins: [
        'cms-element'
    ],

    computed: {
        dailyUrl() {
            return this.element.config.dailyUrl;
        }
    },

    created() {
        this.createdComponent();
    },

    methods: {
        createdComponent() {
            this.initElementConfig('dailymotion');
        },

        onElementUpdate(element) {
            this.$emit('element-update', element);
        }
    }
});