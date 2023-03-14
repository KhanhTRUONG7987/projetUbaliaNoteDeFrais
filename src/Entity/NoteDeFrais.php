<?php

namespace App\Entity;

use App\Entity\Trait\DateTimeCreationTrait;
use App\Repository\NoteDeFraisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteDeFraisRepository::class)]
class NoteDeFrais
{
    use DateTimeCreationTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEvenement = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $motif = null;

    #[ORM\Column]
    private ?float $peageParking = 0;

    #[ORM\Column]
    private ?float $transportsPublics = 0;

    #[ORM\Column]
    private ?float $carburant = 0;

    #[ORM\Column]
    private ?float $restoDejeuner = 0;

    #[ORM\Column]
    private ?float $restoDiner = 0;

    #[ORM\Column]
    private ?float $hebergement = 0;

    #[ORM\Column]
    private ?float $kmParcourus = 0;

    #[ORM\Column]
    private ?float $indemnites = 0;

    #[ORM\Column]
    private ?float $divers = 0;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $infoNote = null;

    #[ORM\Column]
    private ?float $totaux = null;

    #[ORM\Column(length: 255)]
    private ?string $fichier = null;

    #[ORM\ManyToOne(inversedBy: 'noteDeFraisCreeParUser')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userCreeNoteDeFrais = null;

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getDateEvenement(): ?\DateTimeInterface
    {
        return $this->dateEvenement;
    }

    public function setDateEvenement(\DateTimeInterface $dateEvenement): self
    {
        $this->dateEvenement = $dateEvenement;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getPeageParking(): ?float
    {
        return $this->peageParking;
    }

    public function setPeageParking(float $peageParking): self
    {
        $this->peageParking = $peageParking;

        return $this;
    }

    public function getTransportsPublics(): ?float
    {
        return $this->transportsPublics;
    }

    public function setTransportsPublics(float $transportsPublics): self
    {
        $this->transportsPublics = $transportsPublics;

        return $this;
    }

    public function getCarburant(): ?float
    {
        return $this->carburant;
    }

    public function setCarburant(float $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getRestoDejeuner(): ?float
    {
        return $this->restoDejeuner;
    }

    public function setRestoDejeuner(float $restoDejeuner): self
    {
        $this->restoDejeuner = $restoDejeuner;

        return $this;
    }

    public function getRestoDiner(): ?float
    {
        return $this->restoDiner;
    }

    public function setRestoDiner(float $restoDiner): self
    {
        $this->restoDiner = $restoDiner;

        return $this;
    }

    public function getHebergement(): ?float
    {
        return $this->hebergement;
    }

    public function setHebergement(float $hebergement): self
    {
        $this->hebergement = $hebergement;

        return $this;
    }

    public function getKmParcourus(): ?float
    {
        return $this->kmParcourus;
    }

    public function setKmParcourus(float $kmParcourus): self
    {
        $this->kmParcourus = $kmParcourus;

        return $this;
    }

    public function getIndemnites(): ?float
    {
        return $this->indemnites;
    }

    public function setIndemnites(float $indemnites): self
    {
        $this->indemnites = $indemnites;

        return $this;
    }

    public function getDivers(): ?float
    {
        return $this->divers;
    }

    public function setDivers(float $divers): self
    {
        $this->divers = $divers;

        return $this;
    }

    public function getInfoNote(): ?string
    {
        return $this->infoNote;
    }

    public function setInfoNote(string $infoNote): self
    {
        $this->infoNote = $infoNote;

        return $this;
    }

    public function getTotaux(): ?float
    {
        return $this->totaux;
    }

    public function setTotaux(float $totaux): self
    {
        $this->totaux = $totaux;

        return $this;
    }

    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(string $fichier): self
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function getUserCreeNoteDeFrais(): ?User
    {
        return $this->userCreeNoteDeFrais;
    }

    public function setUserCreeNoteDeFrais(?User $userCreeNoteDeFrais): self
    {
        $this->userCreeNoteDeFrais = $userCreeNoteDeFrais;

        return $this;
    }
}
