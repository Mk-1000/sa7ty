<?php

namespace App\Entity;

use App\Repository\AvilibilityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvilibilityRepository::class)]
class Avilibility
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    #[ORM\OneToOne(inversedBy: 'avilibility', cascade: ['persist', 'remove'])]
    private ?Doctor $doctor = null;

    #[ORM\ManyToMany(targetEntity: Day::class, inversedBy: 'avilibilities')]
    private Collection $Days;

    public function __construct()
    {
        $this->Days = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDoctor(): ?Doctor
    {
        return $this->doctor;
    }

    public function setDoctor(?Doctor $doctor): static
    {
        $this->doctor = $doctor;

        return $this;
    }

    /**
     * @return Collection<int, Day>
     */
    public function getDays(): Collection
    {
        return $this->Days;
    }

    public function addDay(Day $day): static
    {
        if (!$this->Days->contains($day)) {
            $this->Days->add($day);
        }

        return $this;
    }

    public function removeDay(Day $day): static
    {
        $this->Days->removeElement($day);

        return $this;
    }
}
