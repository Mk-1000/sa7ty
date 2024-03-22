<?php

namespace App\Entity;

use App\Repository\AnalyseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnalyseRepository::class)]
class Analyse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $analyseType = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $result = null;

    #[ORM\ManyToOne(inversedBy: 'analyses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Appointment $appointment = null;

    #[ORM\ManyToOne(inversedBy: 'Analyses')]

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnalyseType(): ?string
    {
        return $this->analyseType;
    }

    public function setAnalyseType(string $analyseType): static
    {
        $this->analyseType = $analyseType;

        return $this;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setResult($result): static
    {
        $this->result = $result;

        return $this;
    }

    public function getAppointment(): ?Appointment
    {
        return $this->appointment;
    }

    public function setAppointment(?Appointment $appointment): static
    {
        $this->appointment = $appointment;

        return $this;
    }

}
