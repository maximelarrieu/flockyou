<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={"groups"={"products"}})
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"products"})
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\State", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"products"})
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"products"})
     */
    private $image;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Size", inversedBy="products")
     */
    private $size;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     * @Groups({"products"})
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="product", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=false)
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Flocage", inversedBy="products")
     */
    private $flocage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CartProduct", mappedBy="product", cascade={"persist", "remove"})
     */
    private $cartProducts;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->carts = new ArrayCollection();
        $this->cartProducts = new ArrayCollection();
//        $this->flocage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
    {
        $this->state = $state;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setProduct($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getProduct() === $this) {
                $comment->setProduct(null);
            }
        }

        return $this;
    }

    public function getAvgRating()
    {
        $sum = array_reduce($this->comments->toArray(), function ($total, $comment) {
            return $total + $comment->getRating();
        }, 0);

        if (count($this->comments) > 0) return $moyenne = $sum / count($this->comments);
        return 0;
    }

    public function getCommentFromAuthor(Users $author)
    {
        foreach ($this->comments as $comment) {
            if ($comment->getAuthor() === $author) {
                return $comment;
            }
        }
        return null;
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
            $cartProduct->setProduct($this);
        }

        return $this;
    }

    public function removeCartProduct(CartProduct $cartProduct): self
    {
        if ($this->cartProducts->contains($cartProduct)) {
            $this->cartProducts->removeElement($cartProduct);
            // set the owning side to null (unless already changed)
            if ($cartProduct->getProduct() === $this) {
                $cartProduct->setProduct(null);
            }
        }

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
