<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class Products
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $product_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $product_slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Teams", inversedBy="products")
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\States", inversedBy="products")
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sizes", inversedBy="products")
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $product_image;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): self
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getProductSlug(): ?string
    {
        return $this->product_slug;
    }

    public function setProductSlug(string $product_slug): self
    {
        $this->product_slug = $product_slug;

        return $this;
    }

    public function getTeam(): ?Teams
    {
        return $this->team;
    }

    public function setTeam(?Teams $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getState(): ?States
    {
        return $this->state;
    }

    public function setState(?States $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getSize(): ?Sizes
    {
        return $this->size;
    }

    public function setSize(?Sizes $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getProductImage(): ?string
    {
        return $this->product_image;
    }

    public function setProductImage(string $product_image): self
    {
        $this->product_image = $product_image;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
