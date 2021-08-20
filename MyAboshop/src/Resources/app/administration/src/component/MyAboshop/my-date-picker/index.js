import template from './my-date-picker.html.twig';
import './my-date-picker.scss';

Shopware.Component.register('my-date-picker', {
    template: template,

    mounted: function(){

        $('.date').datepicker({
            multidate: true,
            format: 'dd-mm-yyyy'
        });
    }
});