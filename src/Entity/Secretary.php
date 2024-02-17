<?php

namespace App\Entity;

use App\Repository\SecretaryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecretaryRepository::class)]
class Secretary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $yearExp = null;

    #[ORM\OneToMany(targetEntity: Appointment::class, mappedBy: 'secretary')]
    private Collection $Appointments;

    #[ORM\OneToOne(mappedBy: 'Secretary', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function __construct()
    {
        $this->Appointments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYearExp(): ?int
    {
        return $this->yearExp;
    }

    public function setYearExp(?int $yearExp): static
    {
        $this->yearExp = $yearExp;

        return $this;
    }

    /**
     * @return Collection<int, Appointment>
     */
    public function getAppointments(): Collection
    {
        return $this->Appointments;
    }

    public function addAppointment(Appointment $appointment): static
    {
        if (!$this->Appointments->contains($appointment)) {
            $this->Appointments->add($appointment);
            $appointment->setSecretary($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): static
    {
        if ($this->Appointments->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getSecretary() === $this) {
                $appointment->setSecretary(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setSecretary(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getSecretary() !== $this) {
            $user->setSecretary($this);
        }

        $this->user = $user;

        return $this;
    }
}
