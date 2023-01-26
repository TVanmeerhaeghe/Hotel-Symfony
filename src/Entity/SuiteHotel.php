<?php

namespace App\Entity;

use App\Repository\SuiteHotelRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuiteHotelRepository::class)]
class SuiteHotel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $img_gallerie = null;

    #[ORM\ManyToOne(inversedBy: 'suites')]
    private ?EtablissementHotel $etablissementHotel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImgGallerie(): ?string
    {
        return $this->img_gallerie;
    }

    public function setImgGallerie(string $img_gallerie): self
    {
        $this->img_gallerie = $img_gallerie;

        return $this;
    }

    public function getEtablissementHotel(): ?EtablissementHotel
    {
        return $this->etablissementHotel;
    }

    public function setEtablissementHotel(?EtablissementHotel $etablissementHotel): self
    {
        $this->etablissementHotel = $etablissementHotel;

        return $this;
    }
}
