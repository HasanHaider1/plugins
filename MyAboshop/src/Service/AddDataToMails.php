<?php declare(strict_types=1);

namespace MyAboshop\Service;

use Shopware\Storefront\Page\GenericPageLoadedEvent;
use Shopware\Core\Content\Mail\Service\AbstractMailService;
use Shopware\Core\Framework\Context;
use Symfony\Component\Mime\Email;
use Shopware\Core\System\SystemConfig\SystemConfigService;

class AddDataToMails extends AbstractMailService
{

    /**
     * @var AbstractMailService
     */
    private AbstractMailService $mailService;

    public function __construct(AbstractMailService $mailService, SystemConfigService $SystemConfig)
    {
        $this->mailService = $mailService;
        $this->SystemConfig = $SystemConfig;
    }
    /*
    public static function getSubscribedEvents(): array
    {
        // Return the events to listen to as array like this:  <event to listen to> => <method to execute>
        return [
            GenericPageLoadedEvent::class => 'onPageLoaded'
        ];
    }
    */
    public function getDecorated(): AbstractMailService
    {
        return $this->mailService;
    }
    /*
    public function onPageLoaded(GenericPageLoadedEvent $event)
    {
        $event->getRequest('email');
        return $event;
    }
    */

    public function send(array $data, Context $context, array $templateData = []): ?Email
    {
        $templateData['recipients'] = ['hasanhere11@gmail.com' => 'recipient one', 'hasanhere11@gmail.com' => 'recipient two'];

        $configfield1 = $this->SystemConfig->get('MyAboshop.config.fieldtype1');
        $configfield2 = $this->SystemConfig->get('MyAboshop.config.fieldtype2');
        $configfield3 = $this->SystemConfig->get('MyAboshop.config.fieldtype3');

        $templateData['field1'] = $configfield1;
        $templateData['field2'] = $configfield2;
        $templateData['field3'] = $configfield3;
        $templateData['recipients'] = $configfield1;
        return $this->mailService->send($data, $context, $templateData);

        }

}