<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @UniqueEntity("title")
 */
class Product
{
    const CAT = [
        0 => 'kitchen',
        1 => 'garden',
        2 => 'diverse',
        3 => 'bathroom',
        4 => 'upcycling'
    ];

    const CAT_NAME = [
        0 => 'Pour la cuisine',
        1 => 'Jardin et plantes',
        2 => 'Objets en tout genre',
        3 => 'Salle de bain & WC',
        4 => 'Surcyclage - objets recyclés / déco'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $detail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $detail_picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture_extension;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $detail_picture_extension;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCatType()
    {
        return self::CAT[$this->category];
    }

    public function getCatName() 
    {
        return self::CAT_NAME[$this->category];
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDetailPicture(): ?string
    {
        return $this->detail_picture;
    }

    public function setDetailPicture(string $detail_picture): self
    {
        $this->detail_picture = $detail_picture;

        return $this;
    }

    public function getPictureExtension(): ?string
    {
        return $this->picture_extension;
    }

    public function setPictureExtension(string $picture_extension): self
    {
        $this->picture_extension = $picture_extension;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDetailPictureExtension(): ?string
    {
        return $this->detail_picture_extension;
    }

    public function setDetailPictureExtension(string $detail_picture_extension): self
    {
        $this->detail_picture_extension = $detail_picture_extension;

        return $this;
    }
}
