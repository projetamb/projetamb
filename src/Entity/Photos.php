<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotosRepository")
 */
class Photos
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
    private $event_title;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(maxSize="3M",
     *      maxSizeMessage="Le fichier excède 3Mo.",
     *      mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/svg+xml", "image/gif"},
     *      mimeTypesMessage= "formats autorisés: png, jpeg, jpg, svg, gif")
     */
    private $photo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventTitle(): ?string
    {
        return $this->event_title;
    }

    public function setEventTitle(string $event_title): self
    {
        $this->event_title = $event_title;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

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
}
