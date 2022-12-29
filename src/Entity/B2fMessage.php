<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class B2fMessage
{
    #[Assert\NotBlank]
    protected $recipient;

    #[Assert\NotBlank]
    protected $subject;

    #[Assert\NotBlank]
    protected $body;

    #[Assert\NotBlank]
    protected $sender;

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function setRecipient(string $recipient): void
    {
        $this->recipient = $recipient;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getSender(): string
    {
        return $this->sender;
    }

    public function setSender(string $sender): void
    {
        $this->sender = $sender;
    }
}