<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\FlocageRepository")
 */
class Flocage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="flocages")
     */
    private $team;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $flocage;

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

    public function getFlocage(): ?string
    {
        return $this->flocage;
    }

    public function setFlocage(?string $flocage): self
    {
        $this->flocage = $flocage;

        return $this;
    }
}
