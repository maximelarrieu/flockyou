<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandRepository")
 */
class Command
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="commands")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CartProduct", mappedBy="command", cascade={"persist"})
     */
    private $cartProduct;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_command;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    public function __construct()
    {
        $this->cartProduct = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|CartProduct[]
     */
    public function getCartProduct(): Collection
    {
        return $this->cartProduct;
    }

    public function addCartProduct(CartProduct $cartProduct): self
    {
        if (!$this->cartProduct->contains($cartProduct)) {
            $this->cartProduct[] = $cartProduct;
            $cartProduct->setCommand($this);
        }

        return $this;
    }

    public function removeCartProduct(CartProduct $cartProduct): self
    {
        if ($this->cartProduct->contains($cartProduct)) {
            $this->cartProduct->removeElement($cartProduct);
            // set the owning side to null (unless already changed)
            if ($cartProduct->getCommand() === $this) {
                $cartProduct->setCommand(null);
            }
        }

        return $this;
    }

    public function getNbCommand(): ?int
    {
        return $this->nb_command;
    }

    public function setNbCommand(?int $nb_command): self
    {
        $this->nb_command = $nb_command;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
