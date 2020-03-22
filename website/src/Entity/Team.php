<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\League", inversedBy="teams")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"products"})
     */
    private $league;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"products"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"products"})
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=3)
     * @Groups({"products"})
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="team", cascade={"remove"})
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flocage", mappedBy="team", cascade={"remove"})
     */
    private $flocages;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->flocages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeague(): ?League
    {
        return $this->league;
    }

    public function setLeague(?League $league): self
    {
        $this->league = $league;

        return $this;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setTeam($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getTeam() === $this) {
                $product->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flocage[]
     */
    public function getFlocages(): Collection
    {
        return $this->flocages;
    }

    public function addFlocage(Flocage $flocage): self
    {
        if (!$this->flocages->contains($flocage)) {
            $this->flocages[] = $flocage;
            $flocage->setTeam($this);
        }

        return $this;
    }

    public function removeFlocage(Flocage $flocage): self
    {
        if ($this->flocages->contains($flocage)) {
            $this->flocages->removeElement($flocage);
            // set the owning side to null (unless already changed)
            if ($flocage->getTeam() === $this) {
                $flocage->setTeam(null);
            }
        }

        return $this;
    }
}
