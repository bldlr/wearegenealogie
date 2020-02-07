<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParentsRepository")
 */
class Parents
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $mere;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $pere;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMere(): ?user
    {
        return $this->mere;
    }

    public function setMere(?user $mere): self
    {
        $this->mere = $mere;

        return $this;
    }

    public function getPere(): ?user
    {
        return $this->pere;
    }

    public function setPere(?user $pere): self
    {
        $this->pere = $pere;

        return $this;
    }
}
