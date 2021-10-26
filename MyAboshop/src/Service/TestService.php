<?php

namespace MyAboshop\Service;

class TestService
{

    public function testMethod ()
    {
        $email = 'test@email.xx';
        $message = '
            <p>This is a testing email</p>
            <p>TEST TEST TEST</p>
        ';
        $result = $this->emailService->sendMail([$email => 'Test recipient'], 'Test sender', 'Test subject', $message);

        if (!$result) {
            //do something, if the email was not sent successfully
        }
    }

}