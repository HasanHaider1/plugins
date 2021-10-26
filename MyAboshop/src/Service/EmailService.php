<?php

namespace MyAboshop\Service;

use Shopware\Core\Content\Mail\Service\AbstractMailService;
use Shopware\Core\Content\MailTemplate\MailTemplateEntity;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Validation\DataBag\DataBag;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\Content\Mail\Service\MailService;

use MyAboshop\Service\SalesChannelService;

class EmailService
{
    private $mailService;
    private $mailTemplateRepository;
    private $salesChannelService;

    public function __construct(
        AbstractMailService $mailService,
        EntityRepositoryInterface $mailTemplateRepository,
        SalesChannelService $salesChannelService
    )
    {
        $this->mailService = $mailService;
        $this->mailTemplateRepository = $mailTemplateRepository;
        $this->salesChannelService = $salesChannelService;
    }

    /**
     * Method for sending an email notification
     *
     * @param array $recipients
     * @param string $senderName
     * @param string $subject
     * @param string $messageHtml
     * @param string $messagePlain
     * @param SalesChannelContext|null $salesChannelContext
     * @param array $templateData
     * @return bool
     */
    public function sendMail(
        array $recipients,
        string $senderName,
        string $subject,
        string $messageHtml = '',
        string $messagePlain = '',
        SalesChannelContext $salesChannelContext = null,
        array $templateData = []
    ) : bool
    {
        $data = new DataBag();

        //basic e-mail data
        $data->set('recipients', $recipients);     //format: ['email address' => 'recipient name']
        $data->set('senderName', $senderName);
        $data->set('subject', $subject);
        $data->set('contentHtml', $messageHtml);
        $data->set('contentPlain', $messagePlain);

        //fill HTML and PlainText version with the other of the two, if empty
        if (!$messagePlain && $messageHtml) {
            $data->set('contentPlain', strip_tags($messageHtml));
        }
        elseif ($messagePlain && !$messageHtml) {
            $data->set('contentHtml', $messagePlain);
        }

        //get the sales channel context, if not already present
        if (!isset($salesChannelContext)) {
            $salesChannelContext = $this->salesChannelService->createSalesChannelContext();
        }

        //set sales channel context
        $data->set('salesChannelId', $salesChannelContext->getSalesChannel()->getId());

        //set the template (not mandatory)
        $mailTemplate = $this->getMailTemplate();
        $data->set('templateId', $mailTemplate->getId());

        //send the e-mail
        $this->mailService->send($data->all(), $salesChannelContext->getContext(), []);
        $result = $this->mailService->send($data->all(), $salesChannelContext->getContext(), $templateData);
        if ($result) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Method for getting an email template by its ID or the first one available, if no ID is supplied
     *
     * @param string $id
     * @param Context $context
     * @return MailTemplateEntity|null
     */
    private function getMailTemplate(string $id = null, Context $context = null): ?MailTemplateEntity
    {
        //get the sales channel context, if not already present
        if (!isset($context)) {
            $salesChannelContext = $this->salesChannelService->createSalesChannelContext();
            $context = $salesChannelContext->getContext();
        }

        $id = <<<SQL
            SELECT id
            FROM mail_template_type
            WHERE technical_name = "order_confirmation"
SQL;
        //set the criteria for searching in the mail template repository
        $criteria = new Criteria();
        $criteria->addAssociation('media.media');
        $criteria->setLimit(1);

        //if a template ID was passed, we will get that template, otherwise just the first one the repository returns
        if (isset($id)) {
            $criteria->addFilter(new EqualsFilter('id', $id));
        }

        //get and return one template
        console.log( $this->mailTemplateRepository->search($criteria, $context)->first());
        return $this->mailTemplateRepository->search($criteria, $context)->first();
    }

}