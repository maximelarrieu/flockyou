<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeaguesRepository")
 */
class Leagues
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
    private $league_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $league_image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Teams", mappedBy="league")
     */
    private $team_name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Teams", mappedBy="league")
     */
    private $teams;

    public function __construct()
    {
        $this->team_name = new ArrayCollection();
        $this->teams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeagueName(): ?string
    {
        return $this->league_name;
    }

    public function setLeagueName(string $league_name): self
    {
        $this->league_name = $league_name;

        return $this;
    }

    public function getLeagueImage(): ?string
    {
        return $this->league_image;
    }

    public function setLeagueImage(?string $league_image): self
    {
        $this->league_image = $league_image;

        return $this;
    }

    /**
     * @return Collection|Teams[]
     */
    public function getTeamName(): Collection
    {
        return $this->team_name;
    }

    public function addTeamName(Teams $teamName): self
    {
        if (!$this->team_name->contains($teamName)) {
            $this->team_name[] = $teamName;
            $teamName->setLeague($this);
        }

        return $this;
    }

    public function removeTeamName(Teams $teamName): self
    {
        if ($this->team_name->contains($teamName)) {
            $this->team_name->removeElement($teamName);
            // set the owning side to null (unless already changed)
            if ($teamName->getLeague() === $this) {
                $teamName->setLeague(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Teams[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Teams $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->setLeague($this);
        }

        return $this;
    }

    public function removeTeam(Teams $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            // set the owning side to null (unless already changed)
            if ($team->getLeague() === $this) {
                $team->setLeague(null);
            }
        }

        return $this;
    }
}
