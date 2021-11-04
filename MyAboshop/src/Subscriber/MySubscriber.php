<?php declare(strict_types=1);

namespace MyAboshop\Subscriber;


use Shopware\Storefront\Page\GenericPageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\Framework\Struct\ArrayEntity;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Symfony\Component\HttpFoundation\RequestStack;


class MySubscriber implements EventSubscriberInterface
{
    protected $SystemConfig;
    public $me;
    private $requestStack;

    public function __construct(  RequestStack $requestStack, SystemConfigService $SystemConfig)
    {
        $this->requestStack = $requestStack;
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
        //$_POST('meraemail');
        //$event->getInput();
        $request = $this->requestStack->getCurrentRequest();
        //$test = $request->get('meraemail');
        //$value=$request->query->get('meraemail');
        //$value=$request->get('users');
        //console.log($value);
        //echo $value;

        $something = $this->SystemConfig->get('Hello');
        $configMinDate = $this->SystemConfig->get('MyAboshop.config.mindate');
        $configMaxDate = $this->SystemConfig->get('MyAboshop.config.maxdate');
        $configDisabledDate = $this->SystemConfig->get('MyAboshop.config.disableddate');
        $configDisabledDates = $this->SystemConfig->get('MyAboshop.config.mydatepicker');

        $array = ['key1' => $configMinDate,'key2' => $configMaxDate,'key3' => $configDisabledDate];

        $configfield1 = $this->SystemConfig->get('MyAboshop.config.fieldtype1');
        $configfield2 = $this->SystemConfig->get('MyAboshop.config.fieldtype2');
        $configfield3 = $this->SystemConfig->get('MyAboshop.config.fieldtype3');
/*
        foreach ($configDisabledDates as $value) {
            echo "$value <br>";
            array_push($array2,$value);
        }
*/
        //assign the array to the page
        $event->getPage()->assign([$configDisabledDates]);
        //add the array to the page as an extension
        $event->getPage()->addExtension('testPageExtension', new ArrayEntity([$configDisabledDates]));

        //assign the array to the context
        $event->getContext()->assign($array);

        //add the array to the context as an extension
        $event->getContext()->addExtension('testContextExtension', new ArrayEntity($array));
    }
}