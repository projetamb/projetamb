<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventsRepository")
 */
class Events
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $place;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min="10",minMessage="Description mini 10 caractères")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $subscribe_number;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\File(maxSize="5M",
     *      maxSizeMessage="Le fichier excède 5Mo.",
     *      mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/svg+xml", "image/gif"},
     *      mimeTypesMessage= "formats autorisés: png, jpeg, jpg, svg, gif")
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $organisator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $emailcontact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *@Assert\NotBlank()
     */
    private $phonecontact;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getSubscribeNumber(): ?int
    {
        return $this->subscribe_number;
    }

    public function setSubscribeNumber(?int $subscribe_number): self
    {
        $this->subscribe_number = $subscribe_number;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto( $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getOrganisator(): ?string
    {
        return $this->organisator;
    }

    public function setOrganisator(string $organisator): self
    {
        $this->organisator = $organisator;

        return $this;
    }

    public function getEmailContact(): ?string
    {
        return $this->emailcontact;
    }

    public function setEmailContact(?string $emailcontact): self
    {
        $this->emailcontact = $emailcontact;

        return $this;
    }

    public function getPhoneContact(): ?string
    {
        return $this->phonecontact;
    }

    public function setPhoneContact(?string $phonecontact): self
    {
        $this->phonecontact = $phonecontact;

        return $this;
    }
}
