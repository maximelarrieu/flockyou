<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandProductRepository")
 */
class CommandProduct
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Command", inversedBy="commandProducts")
     */
    private $command;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CartProduct", inversedBy="commandProducts", cascade={"persist"})
     */
    private $cartProduct;

//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\CartProduct", mappedBy="commandProducts", cascade={"persist"})
//     */
//    private $cartProducts;

//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\CartProduct", inversedBy="commandProducts")
//     */
//    private $cartProducts;

//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\CartProduct", mappedBy="commandProduct", cascade={"persist"})
//     */
//    private $cartProducts;

//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\CartProduct", inversedBy="commandProducts")
//     */
//    private $cartProducts;
//
//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\CartProduct", inversedBy="commandProducts")
//     */
//    private $cartProduct;

//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\CartProduct", inversedBy="cartProducts")
//     */
//    private $cartProduct;

//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\CartProduct", mappedBy="commandProduct")
//     */
//    private $cartProducts;
//
//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\CartProduct", inversedBy="commandProducts")
//     */
//    private $cartProducts;


    public function __construct()
    {
        $this->cartProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommand(): ?Command
    {
        return $this->command;
    }

    public function setCommand(?Command $command): self
    {
        $this->command = $command;

        return $this;
    }

    /**
     * @return Collection|CartProduct[]
     */
    public function getCartProducts(): Collection
    {
        return $this->cartProducts;
    }

    public function addCartProduct(CartProduct $cartProduct): self
    {
        if (!$this->cartProducts->contains($cartProduct)) {
            $this->cartProducts[] = $cartProduct;
            $cartProduct->addCommandProduct($this);
        }

        return $this;
    }

    public function removeCartProduct(CartProduct $cartProduct): self
    {
        if ($this->cartProducts->contains($cartProduct)) {
            $this->cartProducts->removeElement($cartProduct);
            // set the owning side to null (unless already changed)
            if ($cartProduct->getCommandProducts() === $this) {
                $cartProduct->removeCommandProduct($this);
            }
        }

        return $this;
    }

    public function getCartProduct(): ?CartProduct
    {
        return $this->cartProduct;
    }

    public function setCartProduct(?CartProduct $cartProduct): self
    {
        $this->cartProduct = $cartProduct;

        return $this;
    }

//    public function getCartProducts(): ?CartProduct
//    {
//        return $this->cartProducts;
//    }
//
//    public function setCartProducts(?CartProduct $cartProducts): self
//    {
//        $this->cartProducts = $cartProducts;
//
//        return $this;
//    }

//    /**
//     * @return Collection|CartProduct[]
//     */
//    public function getCartProducts(): Collection
//    {
//        return $this->cartProducts;
//    }
//
//    public function addCartProduct(CartProduct $cartProduct): self
//    {
//        if (!$this->cartProducts->contains($cartProduct)) {
//            $this->cartProducts[] = $cartProduct;
//            $cartProduct->setCommandProduct($this);
//        }
//
//        return $this;
//    }
//
//    public function removeCartProduct(CartProduct $cartProduct): self
//    {
//        if ($this->cartProducts->contains($cartProduct)) {
//            $this->cartProducts->removeElement($cartProduct);
//            // set the owning side to null (unless already changed)
//            if ($cartProduct->getCommandProduct() === $this) {
//                $cartProduct->setCommandProduct(null);
//            }
//        }
//
//        return $this;
//    }
//
//    public function getCartProducts(): ?CartProduct
//    {
//        return $this->cartProducts;
//    }
//
//    public function setCartProducts(?CartProduct $cartProducts): self
//    {
//        $this->cartProducts = $cartProducts;
//
//        return $this;
//    }
//
//    public function getCartProduct(): ?CartProduct
//    {
//        return $this->cartProduct;
//    }
//
//    public function setCartProduct(?CartProduct $cartProduct): self
//    {
//        $this->cartProduct = $cartProduct;
//
//        return $this;
//    }

//    public function getCartProduct(): ?CartProduct
//    {
//        return $this->cartProduct;
//    }
//
//    public function setCartProduct(?CartProduct $cartProduct): self
//    {
//        $this->cartProduct = $cartProduct;
//
//        return $this;
//    }

//    /**
//     * @return Collection|CartProduct[]
//     */
//    public function getCartProducts(): Collection
//    {
//        return $this->cartProducts;
//    }
//
//    public function addCartProduct(CartProduct $cartProduct): self
//    {
//        if (!$this->cartProducts->contains($cartProduct)) {
//            $this->cartProducts[] = $cartProduct;
//            $cartProduct->setCommandProduct($this);
//        }
//
//        return $this;
//    }
//
//    public function removeCartProduct(CartProduct $cartProduct): self
//    {
//        if ($this->cartProducts->contains($cartProduct)) {
//            $this->cartProducts->removeElement($cartProduct);
//            // set the owning side to null (unless already changed)
//            if ($cartProduct->getCommandProduct() === $this) {
//                $cartProduct->setCommandProduct(null);
//            }
//        }
//
//        return $this;
//    }

//    public function getCartProducts(): ?CartProduct
//    {
//        return $this->cartProducts;
//    }
//
//    public function setCartProducts(?CartProduct $cartProducts): self
//    {
//        $this->cartProducts = $cartProducts;
//
//        return $this;
//    }
}
