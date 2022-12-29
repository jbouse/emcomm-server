<?php
namespace App\Entity;

use App\Entity\MobileProvider;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

class B2fText
{
    #[Assert\NotBlank]
    #[Assert\Positive]
    #[Assert\Length(
        min: 10,
        max: 10,
        exactMessage: 'The phone number must be {{ limit }} digits.',
    )]
    protected $recipient;

    private $provider;

    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 90,
        minMessage: 'The message must be at least {{ limit }} character long.',
        maxMessage: 'The message cannot be longer than {{ limit }} characters.',

    )]
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

    public function getProvider(): ?MobileProvider
    {
        return $this->provider;
    }

    public function setProvider(MobileProvider $provider): void
    {
        $this->provider = $provider;
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