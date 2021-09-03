import Flatpickr from 'flatpickr';
import 'flatpickr/dist/l10n';
import template from './sw-datepicker.html.twig';
import 'flatpickr/dist/flatpickr.css';
import $ from 'jquery';

const {Component}= Shopware;
Component.override('sw-datepicker',{
    template: template,
    mounted:{

},
    methods: {
        getMergedConfig(newConfig) {
            if (newConfig.mode !== undefined) {
                console.warn(
                    '[sw-datepicker] The only allowed mode is the default \'single\' mode ' +
                    '(the specified mode will be ignored!). ' +
                    'The modes \'multiple\' or \'range\' are currently not supported'
                );
            }

            return Object.assign(
                {},
                this.defaultConfig,
                {
                    enableTime: this.enableTime,
                    noCalendar: this.noCalendar
                },
                newConfig,
                {
                    mode: 'multiple'
                }
            );
        }
    }
});