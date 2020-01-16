<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamsRepository")
 */
class Teams
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Leagues", inversedBy="teams")
     */
    private $league;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $team_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $team_image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Products", mappedBy="team")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeague(): ?Leagues
    {
        return $this->league;
    }

    public function setLeague(?Leagues $league): self
    {
        $this->league = $league;

        return $this;
    }

    public function getTeamName(): ?string
    {
        return $this->team_name;
    }

    public function setTeamName(string $team_name): self
    {
        $this->team_name = $team_name;

        return $this;
    }

    public function getTeamImage(): ?string
    {
        return $this->team_image;
    }

    public function setTeamImage(?string $team_image): self
    {
        $this->team_image = $team_image;

        return $this;
    }

    /**
     * @return Collection|Products[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setTeam($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
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
}
