<?php

namespace App\Controller;

use App\Model\Table\UserTable;
use App\Model\Entity\UserEntity;
use App\Helper\SessionHelper;

class TestsController extends AppController
{

    public function __construct()
    {
        parent::__construct("");
    }

    public function test()
    {

        // \ini_set("SMTP", "smtp.gmail.com");
        // \ini_set("smtp_port", 25);

        // $m = mail(
        //     "mickaelr20@gmail.com",
        //     "test sujet",
        //     "test message"
        // );

        // var_dump($m);


        // return;
        $file = \file_get_contents("./config/smtp_gmail.json");
        $smtp_gmail_array = json_decode($file, true);

        try {
            // Create the Transport
            $transport = (new \Swift_SmtpTransport('ssl3://smtp.gmail.com', 25))
                ->setUsername($smtp_gmail_array['email'])
                ->setPassword($smtp_gmail_array['password']);

            // Create the Mailer using your created Transport
            $mailer = new \Swift_Mailer($transport);

            // Create a message
            $message = (new \Swift_Message('Wonderful Subject'))
                ->setFrom(['john@doe.com' => 'John Doe'])
                ->setTo(['mickaelr20@gmail.com'])
                ->setBody('Here is the message itself');

            // Send the message
            $result = $mailer->send($message);
        } catch (\Exception $e) {
            var_dump($e);
        }
    }
}
