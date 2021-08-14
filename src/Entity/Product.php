<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ProductRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * 
 *  @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="product:list:read"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="product:item:read"}}},
 *     order={"name"="ASC"},
 *     paginationEnabled=false)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"product:list:read", "product:item:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"product:list:read", "product:item:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=1000)
     * @Groups({"product:list:read", "product:item:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Groups({"product:list:read", "product:item:read"})
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, unique=true)     * 
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
