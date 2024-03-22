<?php

namespace App\Entity;

use App\Repository\DayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DayRepository::class)]
class Day
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $day = null;

    #[ORM\ManyToMany(targetEntity: Avilibility::class, mappedBy: 'Days')]
    private Collection $avilibilities;

    #[ORM\ManyToMany(targetEntity: Hour::class, inversedBy: 'days')]
    private Collection $hours;

    public function __construct()
    {
        $this->avilibilities = new ArrayCollection();
        $this->hours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(int $day): static
    {
        $this->day = $day;

        return $this;
    }

    /**
     * @return Collection<int, Avilibility>
     */
    public function getAvilibilities(): Collection
    {
        return $this->avilibilities;
    }

    public function addAvilibility(Avilibility $avilibility): static
    {
        if (!$this->avilibilities->contains($avilibility)) {
            $this->avilibilities->add($avilibility);
            $avilibility->addDay($this);
        }

        return $this;
    }

    public function removeAvilibility(Avilibility $avilibility): static
    {
        if ($this->avilibilities->removeElement($avilibility)) {
            $avilibility->removeDay($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Hour>
     */
    public function getHours(): Collection
    {
        return $this->hours;
    }

    public function addHour(Hour $hour): static
    {
        if (!$this->hours->contains($hour)) {
            $this->hours->add($hour);
        }

        return $this;
    }

    public function removeHour(Hour $hour): static
    {
        $this->hours->removeElement($hour);

        return $this;
    }

}
