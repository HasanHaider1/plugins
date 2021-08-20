import template from './my-date-picker.html.twig';
import './my-date-picker.scss';

var script = document.createElement('script');
script.src = 'js/jquery-3.6.0.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

Shopware.Component.register('my-date-picker', {
    template: template,

    mounted: function(){

        $('.date').datepicker({
            multidate: true,
            format: 'dd-mm-yyyy'
        });
    }
});