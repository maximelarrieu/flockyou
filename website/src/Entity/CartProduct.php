<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartProductRepository")
 */
class CartProduct
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="cartProducts", cascade={"remove"})
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Flocage", inversedBy="cartProducts")
     */
    private $flocage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Size", inversedBy="cartProducts")
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cart", inversedBy="cartproduct")
     */
    private $cart;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getFlocage(): ?Flocage
    {
        return $this->flocage;
    }

    public function setFlocage(?Flocage $flocage): self
    {
        $this->flocage = $flocage;

        return $this;
    }

    public function getSize(): ?Size
    {
        return $this->size;
    }

    public function setSize(?Size $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
