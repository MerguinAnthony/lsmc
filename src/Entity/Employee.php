<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $firstName = null;

    #[ORM\Column(length: 50)]
    private ?string $Grade = null;

    #[ORM\Column(length: 10)]
    private ?string $phone = null;

    #[ORM\Column(length: 50)]
    private ?string $affiliation = null;

    #[ORM\Column(length: 50)]
    private ?string $userName = null;

    #[ORM\Column(length: 50)]
    private ?string $services = null;

    #[ORM\Column(length: 50)]
    private ?string $lieu = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $vehicule = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $detail = null;

    #[ORM\Column]
    private ?bool $isService = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $start_at = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $tss = null;

    #[ORM\Column(nullable: true)]
    private ?int $lastTss = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalTss = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $faru = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $mtt = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $asg = null;

    #[ORM\Column]
    private ?bool $pss = null;

    #[ORM\Column]
    private ?bool $gos = null;

    #[ORM\Column]
    private ?bool $gss = null;

    #[ORM\Column]
    private ?bool $ams = null;

    #[ORM\Column]
    private ?bool $vms = null;

    #[ORM\Column]
    private ?bool $emt = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $ed = null;

    #[ORM\Column]
    private ?bool $dsi = null;

    #[ORM\Column]
    private ?bool $zd = null;

    #[ORM\Column]
    private ?bool $amf = null;

    #[ORM\Column]
    private ?bool $fpc = null;

    #[ORM\Column]
    private ?bool $techasg = null;

    #[ORM\Column]
    private ?bool $sf = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->Grade;
    }

    public function setGrade(string $Grade): static
    {
        $this->Grade = $Grade;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAffiliation(): ?string
    {
        return $this->affiliation;
    }

    public function setAffiliation(string $affiliation): static
    {
        $this->affiliation = $affiliation;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): static
    {
        $this->userName = $userName;

        return $this;
    }

    public function getServices(): ?string
    {
        return $this->services;
    }

    public function setServices(string $services): static
    {
        $this->services = $services;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getVehicule(): ?string
    {
        return $this->vehicule;
    }

    public function setVehicule(?string $vehicule): static
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): static
    {
        $this->detail = $detail;

        return $this;
    }

    public function isService(): ?bool
    {
        return $this->isService;
    }

    public function setService(bool $isService): static
    {
        $this->isService = $isService;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->start_at;
    }

    public function setStartAt(?\DateTimeInterface $start_at): static
    {
        $this->start_at = $start_at;

        return $this;
    }

    public function getTss(): ?int
    {
        return $this->tss;
    }

    public function setTss(?int $tss): static
    {
        $this->tss = $tss;
        return $this;
    }

    public function getLastTss(): ?int
    {
        return $this->lastTss;
    }

    public function setLastTss(?int $lastTss): static
    {
        $this->lastTss = $lastTss;

        return $this;
    }

    public function getTotalTss(): ?int
    {
        return $this->totalTss;
    }

    public function setTotalTss(?int $totalTss): static
    {
        $this->totalTss = $totalTss;

        return $this;
    }

    public function getFaru(): ?string
    {
        return $this->faru;
    }

    public function setFaru(?string $faru): static
    {
        $this->faru = $faru;

        return $this;
    }

    public function getMtt(): ?string
    {
        return $this->mtt;
    }

    public function setMtt(?string $mtt): static
    {
        $this->mtt = $mtt;

        return $this;
    }

    public function getAsg(): ?string
    {
        return $this->asg;
    }

    public function setAsg(?string $asg): static
    {
        $this->asg = $asg;

        return $this;
    }

    public function isPss(): ?bool
    {
        return $this->pss;
    }

    public function setPss(bool $pss): static
    {
        $this->pss = $pss;

        return $this;
    }

    public function isGos(): ?bool
    {
        return $this->gos;
    }

    public function setGos(bool $gos): static
    {
        $this->gos = $gos;

        return $this;
    }

    public function isGss(): ?bool
    {
        return $this->gss;
    }

    public function setGss(bool $gss): static
    {
        $this->gss = $gss;

        return $this;
    }

    public function isAms(): ?bool
    {
        return $this->ams;
    }

    public function setAms(bool $ams): static
    {
        $this->ams = $ams;

        return $this;
    }

    public function isVms(): ?bool
    {
        return $this->vms;
    }

    public function setVms(bool $vms): static
    {
        $this->vms = $vms;

        return $this;
    }

    public function isEmt(): ?bool
    {
        return $this->emt;
    }

    public function setEmt(bool $emt): static
    {
        $this->emt = $emt;

        return $this;
    }

    public function getEd(): ?string
    {
        return $this->ed;
    }

    public function setEd(?string $ed): static
    {
        $this->ed = $ed;

        return $this;
    }

    public function isDsi(): ?bool
    {
        return $this->dsi;
    }

    public function setDsi(bool $dsi): static
    {
        $this->dsi = $dsi;

        return $this;
    }

    public function isZd(): ?bool
    {
        return $this->zd;
    }

    public function setZd(bool $zd): static
    {
        $this->zd = $zd;

        return $this;
    }

    public function isAmf(): ?bool
    {
        return $this->amf;
    }

    public function setAmf(bool $amf): static
    {
        $this->amf = $amf;

        return $this;
    }

    public function isFpc(): ?bool
    {
        return $this->fpc;
    }

    public function setFpc(bool $fpc): static
    {
        $this->fpc = $fpc;

        return $this;
    }

    public function isTechasg(): ?bool
    {
        return $this->techasg;
    }

    public function setTechasg(bool $techasg): static
    {
        $this->techasg = $techasg;

        return $this;
    }

    public function isSf(): ?bool
    {
        return $this->sf;
    }

    public function setSf(bool $sf): static
    {
        $this->sf = $sf;

        return $this;
    }
}
