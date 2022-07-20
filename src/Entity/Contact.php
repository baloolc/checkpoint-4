<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[Assert\NotBlank()]
    #[Assert\Email()]
    #[Assert\Length(
        max: 180
    )]
    private ?string $email;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 255
    )]
    private ?string $firstname;

    #[Assert\NotBlank()]
    #[Assert\Length(
        max: 255
    )]
    private ?string $lastname;

    #[Assert\NotBlank()]
    private ?string $message;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
