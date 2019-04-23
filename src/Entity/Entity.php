<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $Adress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $Directorname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(pattern="/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/")
     */
    private $Directorphone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $Directoremail;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File( maxSize = "5M")
     */
    private $Logo;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min="10",minMessage="Description mini 10 caractères")
     * @Assert\NotBlank()
     */
    private $Descriptive;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $Color;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $Linkmap;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $Postalcity;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $Facebook;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File( maxSize = "5M")
     */
    private $Logopage;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File( maxSize = "5M")
     */
    private $Photobandeau;

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

    public function getLogo()
    {
        return $this->Logo;
    }

    public function setLogo($Logo): self
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

    public function getLogopage()
    {
        return $this->Logopage;
    }

    public function setLogopage($Logopage): self
    {
        $this->Logopage = $Logopage;

        return $this;
    }

    public function getPhotobandeau()
    {
        return $this->Photobandeau;
    }

    public function setPhotobandeau($Photobandeau): self
    {
        $this->Photobandeau = $Photobandeau;

        return $this;
    }
}
