// Did not work. Apply new method
import template from 'index.html.twig';
flatpickr.defaultConfig
{
    template:template
    locale: app.request.locale
    enableTime: false
    disable:[
        {
            from: "today",
            to: new Date().fp_incr(2)

        }

    ]

    mode:"multiple"
    minDate : context.context.extensions.testContextExtension['key1']
    maxDate : context.context.extensions.testContextExtension['key2']
    dateFormat: "Y-m-d"

}