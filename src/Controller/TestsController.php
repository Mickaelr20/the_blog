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
        $this->debug("test", "test");
        try {
            // Create the Transport
            $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 25))
                ->setUsername('bletrazer@gmail.com')
                ->setPassword('your password');

            // Create the Mailer using your created Transport
            $mailer = new \Swift_Mailer($transport);

            // Create a message
            $message = (new \Swift_Message('Wonderful Subject'))
                ->setFrom(['john@doe.com' => 'John Doe'])
                ->setTo(['receiver@domain.org'])
                ->setBody('Here is the message itself');

            // Send the message
            $result = $mailer->send($message);
        } catch (\Exception $e) {
            $this->debug("Exception email", $e);
        }
    }
}
