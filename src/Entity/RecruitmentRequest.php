<?php

namespace App\Entity;

use App\Repository\RecruitmentRequestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecruitmentRequestRepository::class)]
class RecruitmentRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $hrpFirstName = null;

    #[ORM\Column]
    private ?int $hrpAge = null;

    #[ORM\Column]
    private ?int $idUniqueGame = null;

    #[ORM\Column(length: 100)]
    private ?string $pseudoDiscord = null;

    #[ORM\Column(length: 50)]
    private ?string $rpFirstName = null;

    #[ORM\Column(length: 50)]
    private ?string $rpLastName = null;

    #[ORM\Column(length: 255)]
    private ?string $rpSexe = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $rpBirthday = null;

    #[ORM\Column(length: 255)]
    private ?string $rpPhone = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Motivation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Disponibility = null;

    #[ORM\Column]
    private ?int $statusRec = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?bool $voiture = null;

    #[ORM\Column]
    private ?bool $moto = null;

    #[ORM\Column]
    private ?bool $avion = null;

    #[ORM\Column]
    private ?bool $helicoptere = null;

    #[ORM\Column]
    private ?bool $camion = null;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHrpFirstName(): ?string
    {
        return $this->hrpFirstName;
    }

    public function setHrpFirstName(string $hrpFirstName): static
    {
        $this->hrpFirstName = $hrpFirstName;

        return $this;
    }

    public function getHrpAge(): ?int
    {
        return $this->hrpAge;
    }

    public function setHrpAge(int $hrpAge): static
    {
        $this->hrpAge = $hrpAge;

        return $this;
    }

    public function getIdUniqueGame(): ?int
    {
        return $this->idUniqueGame;
    }

    public function setIdUniqueGame(int $idUniqueGame): static
    {
        $this->idUniqueGame = $idUniqueGame;

        return $this;
    }

    public function getPseudoDiscord(): ?string
    {
        return $this->pseudoDiscord;
    }

    public function setPseudoDiscord(string $pseudoDiscord): static
    {
        $this->pseudoDiscord = $pseudoDiscord;

        return $this;
    }

    public function getRpFirstName(): ?string
    {
        return $this->rpFirstName;
    }

    public function setRpFirstName(string $rpFirstName): static
    {
        $this->rpFirstName = $rpFirstName;

        return $this;
    }

    public function getRpLastName(): ?string
    {
        return $this->rpLastName;
    }

    public function setRpLastName(string $rpLastName): static
    {
        $this->rpLastName = $rpLastName;

        return $this;
    }

    public function getRpSexe(): ?string
    {
        return $this->rpSexe;
    }

    public function setRpSexe(string $rpSexe): static
    {
        $this->rpSexe = $rpSexe;

        return $this;
    }

    public function getRpBirthday(): ?\DateTimeInterface
    {
        return $this->rpBirthday;
    }

    public function setRpBirthday(\DateTimeInterface $rpBirthday): static
    {
        $this->rpBirthday = $rpBirthday;

        return $this;
    }

    public function getRpPhone(): ?string
    {
        return $this->rpPhone;
    }

    public function setRpPhone(string $rpPhone): static
    {
        $this->rpPhone = $rpPhone;

        return $this;
    }

    public function getMotivation(): ?string
    {
        return $this->Motivation;
    }

    public function setMotivation(string $Motivation): static
    {
        $this->Motivation = $Motivation;

        return $this;
    }

    public function getDisponibility(): ?string
    {
        return $this->Disponibility;
    }

    public function setDisponibility(string $Disponibility): static
    {
        $this->Disponibility = $Disponibility;

        return $this;
    }

    public function getStatusRec(): ?int
    {
        return $this->statusRec;
    }

    public function setStatusRec(int $statusRec): static
    {
        $this->statusRec = $statusRec;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function isVoiture(): ?bool
    {
        return $this->voiture;
    }

    public function setVoiture(bool $voiture): static
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function isMoto(): ?bool
    {
        return $this->moto;
    }

    public function setMoto(bool $moto): static
    {
        $this->moto = $moto;

        return $this;
    }

    public function isAvion(): ?bool
    {
        return $this->avion;
    }

    public function setAvion(bool $avion): static
    {
        $this->avion = $avion;

        return $this;
    }

    public function isHelicoptere(): ?bool
    {
        return $this->helicoptere;
    }

    public function setHelicoptere(bool $helicoptere): static
    {
        $this->helicoptere = $helicoptere;

        return $this;
    }

    public function isCamion(): ?bool
    {
        return $this->camion;
    }

    public function setCamion(bool $camion): static
    {
        $this->camion = $camion;

        return $this;
    }
}
