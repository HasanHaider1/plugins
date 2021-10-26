<?php declare(strict_types=1);

namespace MyAboshop\Service;

use Shopware\Core\Content\Mail\Service\AbstractMailService;
use Shopware\Core\Framework\Context;
use Symfony\Component\Mime\Email;

class AddDataToMails extends AbstractMailService
{
    /**
     * @var AbstractMailService
     */
    private AbstractMailService $mailService;

    public function __construct(AbstractMailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function getDecorated(): AbstractMailService
    {
        return $this->mailService;
    }

    public function send(array $data, Context $context, array $templateData = []): ?Email
    {
        $templateData['myCustomField1'] = $_REQUEST["meraemail"];
        $templateData['myCustomField2'] = 'Example data 2';

        return $this->mailService->send($data, $context, $templateData);
    }
}