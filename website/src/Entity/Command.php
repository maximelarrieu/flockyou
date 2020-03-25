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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_command;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandProduct", mappedBy="command")
     */
    private $commandProducts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="commands")
     */
    private $user;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $total;

    public function __construct()
    {
        $this->commandProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $commandProduct->setCommand($this);
        }

        return $this;
    }

    public function removeCommandProduct(CommandProduct $commandProduct): self
    {
        if ($this->commandProducts->contains($commandProduct)) {
            $this->commandProducts->removeElement($commandProduct);
            // set the owning side to null (unless already changed)
            if ($commandProduct->getCommand() === $this) {
                $commandProduct->setCommand(null);
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

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }
}
