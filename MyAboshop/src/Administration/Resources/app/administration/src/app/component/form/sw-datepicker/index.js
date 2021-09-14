import Flatpickr from 'flatpickr';
import 'flatpickr/dist/l10n';
import template from './sw-datepicker.html.twig';
import 'flatpickr/dist/flatpickr.css';

import LoadScript from 'vue-plugin-load-script';
Vue.use(LoadScript);

const {Component, Mixin}= Shopware;
Component.override('sw-datepicker',{
    template: template,
    mounted() {
        let externalScript = document.createElement('script')
        externalScript.setAttribute('src', 'jquery-3.6.0.min.js')
        document.head.appendChild(externalScript)
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