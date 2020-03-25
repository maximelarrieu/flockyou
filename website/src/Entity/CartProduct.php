<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="cartProducts")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandProduct", mappedBy="cartProduct", cascade={"persist"})
     */
    private $commandProducts;

//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\CommandProduct", inversedBy="cartProducts", cascade={"persist"})
//     */
//    private $commandProducts;

//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\CommandProduct", mappedBy="cartProducts")
//     */
//    private $commandProducts;

//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\CommandProduct", mappedBy="cartProduct", cascade={"persist"})
//     */
//    private $commandProducts;
//
//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\CommandProduct", inversedBy="cartProducts", cascade={"persist"})
//     */
//    private $commandProduct;

//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\CommandProduct", mappedBy="cartProducts")
//     */
//    private $commandProducts;

//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\CommandProduct", mappedBy="cartProduct")
//     */
//    private $cartProducts;

//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\CommandProduct", inversedBy="cartProducts")
//     */
//    private $commandProduct;
//
//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\CommandProduct", mappedBy="cartProducts")
//     */
//    private $commandProducts;

    public function __construct()
    {
//        $this->commandProducts = new ArrayCollection();
    }

//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="cartProduct")
//     */
//    private $users;

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
     * @return Collection|CommandProduct[]
     */
    public function getCommandProducts(): Collection
    {
        return $this->commandProducts;
    }

    public function addCommandProduct(CommandProduct $commandProduct): self
    {
        if (!$this->commandProducts->contains($commandProduct)) {
            $this->commandProducts[] = $commandProduct;
            $commandProduct->setCartProduct($this);
        }

        return $this;
    }

    public function removeCommandProduct(CommandProduct $commandProduct): self
    {
        if ($this->commandProducts->contains($commandProduct)) {
            $this->commandProducts->removeElement($commandProduct);
            // set the owning side to null (unless already changed)
            if ($commandProduct->getCartProduct() === $this) {
                $commandProduct->setCartProduct(null);
            }
        }

        return $this;
    }
//
//    public function getCommandProducts(): ?CommandProduct
//    {
//        return $this->commandProducts;
//    }
//
//    public function setCommandProducts(?CommandProduct $commandProducts): self
//    {
//        $this->commandProducts = $commandProducts;
//
//        return $this;
//    }

//    /**
//     * @return Collection|CommandProduct[]
//     */
//    public function getCommandProducts(): Collection
//    {
//        return $this->commandProducts;
//    }
//
//    public function addCommandProduct(CommandProduct $commandProduct): self
//    {
//        if (!$this->commandProducts->contains($commandProduct)) {
//            $this->commandProducts[] = $commandProduct;
//            $commandProduct->setCartProducts($this);
//        }
//
//        return $this;
//    }
//
//    public function removeCommandProduct(CommandProduct $commandProduct): self
//    {
//        if ($this->commandProducts->contains($commandProduct)) {
//            $this->commandProducts->removeElement($commandProduct);
//            // set the owning side to null (unless already changed)
//            if ($commandProduct->getCartProducts() === $this) {
//                $commandProduct->setCartProducts(null);
//            }
//        }
//
//        return $this;
//    }

//    /**
//     * @return Collection|CommandProduct[]
//     */
//    public function getCommandProducts(): Collection
//    {
//        return $this->commandProducts;
//    }
//
//    public function addCommandProduct(CommandProduct $commandProduct): self
//    {
//        if (!$this->commandProducts->contains($commandProduct)) {
//            $this->commandProducts[] = $commandProduct;
//            $commandProduct->setCartProduct($this);
//        }
//
//        return $this;
//    }
//
//    public function removeCommandProduct(CommandProduct $commandProduct): self
//    {
//        if ($this->commandProducts->contains($commandProduct)) {
//            $this->commandProducts->removeElement($commandProduct);
//            // set the owning side to null (unless already changed)
//            if ($commandProduct->getCartProduct() === $this) {
//                $commandProduct->setCartProduct(null);
//            }
//        }
//
//        return $this;
//    }
//
//    public function getCommandProduct(): ?CommandProduct
//    {
//        return $this->commandProduct;
//    }
//
//    public function setCommandProduct(?CommandProduct $commandProduct): self
//    {
//        $this->commandProduct = $commandProduct;
//
//        return $this;
//    }
////
//    /**
//     * @return Collection|CommandProduct[]
//     */
//    public function getCommandProducts(): Collection
//    {
//        return $this->commandProducts;
//    }
//
//    public function addCommandProduct(CommandProduct $commandProduct): self
//    {
//        if (!$this->commandProducts->contains($commandProduct)) {
//            $this->commandProducts[] = $commandProduct;
//            $commandProduct->setCartProducts($this);
//        }
//
//        return $this;
//    }
//
//    public function removeCommandProduct(CommandProduct $commandProduct): self
//    {
//        if ($this->commandProducts->contains($commandProduct)) {
//            $this->commandProducts->removeElement($commandProduct);
//            // set the owning side to null (unless already changed)
//            if ($commandProduct->getCartProducts() === $this) {
//                $commandProduct->setCartProducts(null);
//            }
//        }
//
//        return $this;
//    }

//    /**
//     * @return Collection|CommandProduct[]
//     */
//    public function getCartProducts(): Collection
//    {
//        return $this->cartProducts;
//    }
//
//    public function addCartProduct(CommandProduct $cartProduct): self
//    {
//        if (!$this->cartProducts->contains($cartProduct)) {
//            $this->cartProducts[] = $cartProduct;
//            $cartProduct->setCartProduct($this);
//        }
//
//        return $this;
//    }
//
//    public function removeCartProduct(CommandProduct $cartProduct): self
//    {
//        if ($this->cartProducts->contains($cartProduct)) {
//            $this->cartProducts->removeElement($cartProduct);
//            // set the owning side to null (unless already changed)
//            if ($cartProduct->getCartProduct() === $this) {
//                $cartProduct->setCartProduct(null);
//            }
//        }
//
//        return $this;
//    }

//    public function getCommandProduct(): ?CommandProduct
//    {
//        return $this->commandProduct;
//    }
//
//    public function setCommandProduct(?CommandProduct $commandProduct): self
//    {
//        $this->commandProduct = $commandProduct;
//
//        return $this;
//    }
//
//    /**
//     * @return Collection|CommandProduct[]
//     */
//    public function getCommandProducts(): Collection
//    {
//        return $this->commandProducts;
//    }
//
//    public function addCommandProduct(CommandProduct $commandProduct): self
//    {
//        if (!$this->commandProducts->contains($commandProduct)) {
//            $this->commandProducts[] = $commandProduct;
//            $commandProduct->setCartProducts($this);
//        }
//
//        return $this;
//    }
//
//    public function removeCommandProduct(CommandProduct $commandProduct): self
//    {
//        if ($this->commandProducts->contains($commandProduct)) {
//            $this->commandProducts->removeElement($commandProduct);
//            // set the owning side to null (unless already changed)
//            if ($commandProduct->getCartProducts() === $this) {
//                $commandProduct->setCartProducts(null);
//            }
//        }
//
//        return $this;
//    }
//
//    public function getUsers(): ?Users
//    {
//        return $this->users;
//    }
//
//    public function setUsers(?Users $users): self
//    {
//        $this->users = $users;
//
//        return $this;
//    }
}
