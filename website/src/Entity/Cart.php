<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 */
class Cart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CartProduct", mappedBy="cart")
     */
    private $cartproduct;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="carts")
     */
    private $user;

    public function __construct()
    {
        $this->cartproduct = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|CartProduct[]
     */
    public function getCartproduct(): Collection
    {
        return $this->cartproduct;
    }

    public function addCartproduct(CartProduct $cartproduct): self
    {
        if (!$this->cartproduct->contains($cartproduct)) {
            $this->cartproduct[] = $cartproduct;
            $cartproduct->setCart($this);
        }

        return $this;
    }

    public function removeCartproduct(CartProduct $cartproduct): self
    {
        if ($this->cartproduct->contains($cartproduct)) {
            $this->cartproduct->removeElement($cartproduct);
            // set the owning side to null (unless already changed)
            if ($cartproduct->getCart() === $this) {
                $cartproduct->setCart(null);
            }
        }

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
