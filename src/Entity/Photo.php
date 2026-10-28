<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $datePriseVue = null;

    #[ORM\Column(length: 255)]
    private ?string $nomFichier = null;

    #[ORM\Column(length: 255)]
    private ?string $etatOeuvre = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Oeuvre $ooeuvre = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $benevole = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePriseVue(): ?\DateTimeImmutable
    {
        return $this->datePriseVue;
    }

    public function setDatePriseVue(\DateTimeImmutable $datePriseVue): static
    {
        $this->datePriseVue = $datePriseVue;

        return $this;
    }

    public function getNomFichier(): ?string
    {
        return $this->nomFichier;
    }

    public function setNomFichier(string $nomFichier): static
    {
        $this->nomFichier = $nomFichier;

        return $this;
    }

    public function getEtatOeuvre(): ?string
    {
        return $this->etatOeuvre;
    }

    public function setEtatOeuvre(string $etatOeuvre): static
    {
        $this->etatOeuvre = $etatOeuvre;

        return $this;
    }

    public function getOoeuvre(): ?Oeuvre
    {
        return $this->ooeuvre;
    }

    public function setOoeuvre(?Oeuvre $ooeuvre): static
    {
        $this->ooeuvre = $ooeuvre;

        return $this;
    }

    public function getBenevole(): ?User
    {
        return $this->benevole;
    }

    public function setBenevole(?User $benevole): static
    {
        $this->benevole = $benevole;

        return $this;
    }
}
