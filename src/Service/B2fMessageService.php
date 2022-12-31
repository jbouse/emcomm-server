<?php
namespace App\Service;

use Twig\Environment;
use App\Entity\B2fMessage;
use App\Entity\B2fText;

class B2fMessageService
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function generateId(): string
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $messageId  = '';
        for ($i = 0; $i < 10; $i++) { $messageId .= $characters[rand(0, strlen($characters) - 1)]; }

        return $messageId;
    }

    public function sendTextMessage(B2fText $text): string
    {
        $message = $this->twig->render('b2f/text_message.txt.twig', [
            'message'       => $text,
            'date'       => gmdate('Y/m/d H:i'),
            'message_id' => $this->generateId(),
        ]); 

        return $message;
    }

    public function sendEmailMessage(B2fMessage $email): string
    {
        $message = $this->twig->render('b2f/email_message.txt.twig', [
            'message'      => $email,
            'date'       => gmdate('Y/m/d h:i'),
            'message_id' => $this->generateId(),
        ]);
 
        return $message;
   }
}
