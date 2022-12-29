<?php

namespace App\Entity;

use App\Repository\MobileProviderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MobileProviderRepository::class)]
class MobileProvider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $emailSuffix = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmailSuffix(): ?string
    {
        return $this->emailSuffix;
    }

    public function setEmailSuffix(string $emailSuffix): self
    {
        $this->emailSuffix = $emailSuffix;

        return $this;
    }
}
