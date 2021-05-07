<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resumeCourt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="articles")
     */
    private $idCategorie;

    /**
     * @ORM\ManyToOne(targetEntity=Redacteurs::class, inversedBy="articles")
     */
    private $idRedacteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getResumeCourt(): ?string
    {
        return $this->resumeCourt;
    }

    public function setResumeCourt(?string $resumeCourt): self
    {
        $this->resumeCourt = $resumeCourt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIdCategorie(): ?Categories
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(?Categories $idCategorie): self
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    public function getIdRedacteur(): ?Redacteurs
    {
        return $this->idRedacteur;
    }

    public function setIdRedacteur(?Redacteurs $idRedacteur): self
    {
        $this->idRedacteur = $idRedacteur;

        return $this;
    }
}
