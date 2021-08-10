<?php declare(strict_types=1);

namespace MyAboshop\Service;

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

    public function getDecorated(): AbstractMailService
    {
        return $this->mailService;
    }

    public function send(array $data, Context $context, array $templateData = []): ?Email
    {
        $configfield1 = $this->SystemConfig->get('MySlogans.config.fieldtype1');
        $configfield2 = $this->SystemConfig->get('MySlogans.config.fieldtype2');
        $configfield3 = $this->SystemConfig->get('MySlogans.config.fieldtype3');

        $templateData['field1'] = $configfield1;
        $templateData['field2'] = $configfield2;
        $templateData['field3'] = $configfield3;

        return $this->mailService->send($data, $context, $templateData);
    }
}