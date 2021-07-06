<?php declare(strict_types=1);

namespace MyImages\Subscriber;

use Shopware\Storefront\Page\GenericPageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\Framework\Struct\ArrayEntity;
use Shopware\Core\System\SystemConfig\SystemConfigService;

class MySubscriber implements EventSubscriberInterface
{
    protected $SystemConfig;
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
        $configPlugintext = $this->SystemConfig->get('MySlogans.config.slogantext1');
        $configPlugintextfont = $this->SystemConfig->get('MySlogans.config.sloganfont1');
        $configPlugintextcolor = $this->SystemConfig->get('MySlogans.config.slogancolor1');

        $configPlugintext2 = $this->SystemConfig->get('MySlogans.config.slogantext2');
        $configPlugintextfont2 = $this->SystemConfig->get('MySlogans.config.sloganfont2');
        $configPlugintextcolor2 = $this->SystemConfig->get('MySlogans.config.slogancolor2');

        $configPlugintext3 = $this->SystemConfig->get('MySlogans.config.slogantext3');
        $configPlugintextfont3 = $this->SystemConfig->get('MySlogans.config.sloganfont3');
        $configPlugintextcolor3 = $this->SystemConfig->get('MySlogans.config.slogancolor3');

        $configPlugintext4 = $this->SystemConfig->get('MySlogans.config.slogantext4');
        $configPlugintextfont4 = $this->SystemConfig->get('MySlogans.config.sloganfont4');
        $configPlugintextcolor4 = $this->SystemConfig->get('MySlogans.config.slogancolor4');

        $array = ['key1' => $configPlugintext,'key2' => $configPlugintextfont,'key3' => $configPlugintextcolor,'key4' => $configPlugintext2,'key5' => $configPlugintextfont2,'key6' =>$configPlugintextcolor2,'key7' =>$configPlugintext3,'key8' =>$configPlugintextfont3,'key9'=>$configPlugintextcolor3,'key10'=>$configPlugintext4,'key11'=>$configPlugintextfont4,'key12'=>$configPlugintextcolor4];
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