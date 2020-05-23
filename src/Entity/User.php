<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $villeNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $paysNaissance;


        /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDeces;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $villeDeces;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $paysDeces;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sexe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getVilleNaissance(): ?string
    {
        return $this->villeNaissance;
    }

    public function setVilleNaissance(?string $villeNaissance): self
    {
        $this->villeNaissance = $villeNaissance;

        return $this;
    }

    public function getPaysNaissance(): ?string
    {
        return $this->paysNaissance;
    }

    public function setPaysNaissance(?string $paysNaissance): self
    {
        $this->paysNaissance = $paysNaissance;

        return $this;
    }


    public function getDateDeces(): ?\DateTimeInterface
    {
        return $this->dateDeces;
    }

    public function setDateDeces(?\DateTimeInterface $dateDeces): self
    {
        $this->dateDeces = $dateDeces;

        return $this;
    }

    public function getVilleDeces(): ?string
    {
        return $this->villeDeces;
    }

    public function setVilleDeces(?string $villeDeces): self
    {
        $this->villeDeces = $villeDeces;

        return $this;
    }

    public function getPaysDeces(): ?string
    {
        return $this->paysDeces;
    }

    public function setPaysDeces(?string $paysDeces): self
    {
        $this->paysDeces = $paysDeces;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function __toString()
    {
        return $this->getPrenom() . ' ' . $this->getNom();
    }
}
