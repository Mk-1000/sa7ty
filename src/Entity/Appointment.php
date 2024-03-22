<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppointmentRepository::class)]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $patientStatus = null;

    #[ORM\Column(length: 255)]
    private ?string $progress = null;

    #[ORM\ManyToOne(inversedBy: 'Appointments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patient $patient = null;

    #[ORM\OneToOne(inversedBy: 'appointment', cascade: ['persist', 'remove'])]

    #[ORM\ManyToOne(inversedBy: 'appointments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Doctor $Doctor = null;

    #[ORM\OneToMany(targetEntity: Analyse::class, mappedBy: 'Appointment', orphanRemoval: true)]
    private Collection $analyses;

    #[ORM\OneToMany(targetEntity: Prescription::class, mappedBy: 'appointment')]
    private Collection $prescriptions;

    #[ORM\ManyToOne(inversedBy: 'appointments')]
    private ?Hour $hour = null;

    public function __construct()
    {
        $this->analyses = new ArrayCollection();
        $this->prescriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPatientStatus(): ?bool
    {
        return $this->patientStatus;
    }

    public function setPatientStatus(?bool $patientStatus): static
    {
        $this->patientStatus = $patientStatus;

        return $this;
    }

    public function getProgress(): ?string
    {
        return $this->progress;
    }

    public function setProgress(string $progress): static
    {
        $this->progress = $progress;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): static
    {
        $this->patient = $patient;

        return $this;
    }

    public function getDoctor(): ?Doctor
    {
        return $this->Doctor;
    }

    public function setDoctor(?Doctor $Doctor): static
    {
        $this->Doctor = $Doctor;

        return $this;
    }
    
    /**
     * @return Collection<int, Analyse>
     */
    public function getAnalyses(): Collection
    {
        return $this->analyses;
    }

    public function addAnalysis(Analyse $analysis): static
    {
        if (!$this->analyses->contains($analysis)) {
            $this->analyses->add($analysis);
            $analysis->setAppointment($this);
        }

        return $this;
    }

    public function removeAnalysis(Analyse $analysis): static
    {
        if ($this->analyses->removeElement($analysis)) {
            // set the owning side to null (unless already changed)
            if ($analysis->getAppointment() === $this) {
                $analysis->setAppointment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Prescription>
     */
    public function getPrescriptions(): Collection
    {
        return $this->prescriptions;
    }

    public function addPrescription(Prescription $prescription): static
    {
        if (!$this->prescriptions->contains($prescription)) {
            $this->prescriptions->add($prescription);
            $prescription->setAppointment($this);
        }

        return $this;
    }

    public function removePrescription(Prescription $prescription): static
    {
        if ($this->prescriptions->removeElement($prescription)) {
            // set the owning side to null (unless already changed)
            if ($prescription->getAppointment() === $this) {
                $prescription->setAppointment(null);
            }
        }

        return $this;
    }

    public function getHour(): ?Hour
    {
        return $this->hour;
    }

    public function setHour(?Hour $hour): static
    {
        $this->hour = $hour;

        return $this;
    }
}
