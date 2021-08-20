<?php declare(strict_types=1);

namespace MyAboshop\Subscriber;

use Shopware\Storefront\Page\GenericPageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\Framework\Struct\ArrayEntity;
use Shopware\Core\System\SystemConfig\SystemConfigService;



class MySubscriber implements EventSubscriberInterface
{
    protected $SystemConfig;
    public $me;
    public function __construct(SystemConfigService $SystemConfig)
    {
        $this->SystemConfig = $SystemConfig;

    }


    public static function getSubscribedEvents(): array
    {
        // Return the events to listen to as array like this:  <event to listen to> => <method to execute>
        return [
            GenericPageLoadedEvent::class => 'onPageLoaded'
        ];
    }

    public function onPageLoaded(GenericPageLoadedEvent $event)
    {
        // Do something
        // E.g. work with the loaded entities: $event->getEntities()

        $something = $this->SystemConfig->get('Hello');
        $configMinDate = $this->SystemConfig->get('MyAboshop.config.mindate');
        $configMaxDate = $this->SystemConfig->get('MyAboshop.config.maxdate');
        $configDisabledDate = $this->SystemConfig->get('MyAboshop.config.disableddate');

        $array = ['key1' => $configMinDate,'key2' => $configMaxDate,'key3' => $configDisabledDate];

        $configfield1 = $this->SystemConfig->get('MyAboshop.config.fieldtype1');
        $configfield2 = $this->SystemConfig->get('MyAboshop.config.fieldtype2');
        $configfield3 = $this->SystemConfig->get('MyAboshop.config.fieldtype3');
        $array2 = ['key1' => $configfield1,'key2' => $configfield2,'key3' => $configfield3];

        //assign the array to the page
        $event->getPage()->assign($array);
        //add the array to the page as an extension
        $event->getPage()->addExtension('testPageExtension', new ArrayEntity($array));

        //assign the array to the context
        $event->getContext()->assign($array);

        //add the array to the context as an extension
        $event->getContext()->addExtension('testContextExtension', new ArrayEntity($array));
    }
}