<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BankRepository")
 */
class Bank
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cart_number;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $expiration_date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cart_code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="banks")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCartNumber(): ?string
    {
        return $this->cart_number;
    }

    public function setCartNumber(?string $cart_number): self
    {
        $this->cart_number = $cart_number;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expiration_date;
    }

    public function setExpirationDate(?\DateTimeInterface $expiration_date): self
    {
        $this->expiration_date = $expiration_date;

        return $this;
    }

    public function getCartCode(): ?int
    {
        return $this->cart_code;
    }

    public function setCartCode(?int $cart_code): self
    {
        $this->cart_code = $cart_code;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }
}
