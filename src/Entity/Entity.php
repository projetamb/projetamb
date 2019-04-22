<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntityRepository")
 */
class Entity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Directorname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Directorphone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Directoremail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Logo;

    /**
     * @ORM\Column(type="text")
     */
    private $Descriptive;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Color;

    /**
     * @ORM\Column(type="text")
     */
    private $Linkmap;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Postalcity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Facebook;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->Adress;
    }

    public function setAdress(string $Adress): self
    {
        $this->Adress = $Adress;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getDirectorName(): ?string
    {
        return $this->Directorname;
    }

    public function setDirectorName(string $Directorname): self
    {
        $this->Directorname = $Directorname;

        return $this;
    }

    public function getDirectorPhone(): ?string
    {
        return $this->Directorphone;
    }

    public function setDirectorPhone(string $Directorphone): self
    {
        $this->Directorphone = $Directorphone;

        return $this;
    }

    public function getDirectorEmail(): ?string
    {
        return $this->Directoremail;
    }

    public function setDirectorEmail(string $Directoremail): self
    {
        $this->Directoremail = $Directoremail;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->Logo;
    }

    public function setLogo(string $Logo): self
    {
        $this->Logo = $Logo;

        return $this;
    }

    public function getDescriptive(): ?string
    {
        return $this->Descriptive;
    }

    public function setDescriptive(string $Descriptive): self
    {
        $this->Descriptive = $Descriptive;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->Color;
    }

    public function setColor(string $Color): self
    {
        $this->Color = $Color;

        return $this;
    }

    public function getLinkMap(): ?string
    {
        return $this->Linkmap;
    }

    public function setLinkMap(string $Linkmap): self
    {
        $this->Linkmap = $Linkmap;

        return $this;
    }

    public function getPostalCity(): ?string
    {
        return $this->Postalcity;
    }

    public function setPostalCity(string $Postalcity): self
    {
        $this->Postalcity = $Postalcity;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->Facebook;
    }

    public function setFacebook(string $Facebook): self
    {
        $this->Facebook = $Facebook;

        return $this;
    }
}
