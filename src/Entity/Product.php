<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Exception;
use Ramsey\Uuid\Uuid;

class Product
{
    private string $id;
    private string $name;
    private float $price;
    private float $cost;
    private string $description;
    private ?int $stock = 0;
    private bool $isActive;
    private bool $isHighlighted = false;
    private bool $onCover = false;
    private string $image;
    private int $width;
    private int $height;
    private float $ratio;

    private Category $category;

    private ?SubCategory $subcategory = null;

    private ?Status $saleStatus = null;

    /** @var Collection|Wishlist[] */
    private Collection $wishlists;

    /** @var Collection|ShoppingCart[]  */
    private Collection $shoppingCarts;

    /** @var Collection|Image[]  */
    private Collection $images;

    /** @var Collection|Tag[]  */
    private Collection $tags;

    private ?\DateTime $createdAt = null;

    private ?\DateTime $updatedAt = null;

    private string $mediaPath;

    /**
     * @throws Exception
     */
    public function __construct(
        string $name,
        float $cost,
        string $description = '',
        string $image = '',
        bool $isActive = true,
        bool $isHighlighted = false,
        bool $onCover = false,
        int $height = 0,
        int $width = 0,
        float $ratio = 0,
        string $id = null,
        string $mediaPath = '1.5')
    {
        $this->id = $id ?? Uuid::uuid4()->toString();
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->cost = $cost;
        $this->price = $cost * floatval($mediaPath);
        $this->isActive = $isActive;
        $this->isHighlighted = $isHighlighted;
        $this->onCover = $onCover;
        $this->height = $height;
        $this->width = $width;
        $this->ratio = $ratio;
        $this->wishlists = new ArrayCollection();
        $this->shoppingCarts = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->markAsUpdated();
        $this->mediaPath = $mediaPath;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float|int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float|int $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     */
    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getStock(): ?int
    {
        return $this->stock;
    }

    /**
     * @param int|null $stock
     */
    public function setStock(?int $stock): void
    {
        $this->stock = $stock;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return bool
     */
    public function isHighlighted(): bool
    {
        return $this->isHighlighted;
    }

    /**
     * @param bool $isHighlighted
     */
    public function setIsHighlighted(bool $isHighlighted): void
    {
        $this->isHighlighted = $isHighlighted;
    }

    /**
     * @return bool
     */
    public function isOnCover(): bool
    {
        return $this->onCover;
    }

    /**
     * @param bool $onCover
     */
    public function setOnCover(bool $onCover): void
    {
        $this->onCover = $onCover;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return float
     */
    public function getRatio(): float
    {
        return $this->ratio;
    }

    /**
     * @param float $ratio
     */
    public function setRatio(float $ratio): void
    {
        $this->ratio = $ratio;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return SubCategory
     */
    public function getSubcategory(): SubCategory
    {
        return $this->subcategory;
    }

    /**
     * @param SubCategory $subcategory
     */
    public function setSubcategory(SubCategory $subcategory): void
    {
        $this->subcategory = $subcategory;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return Status
     */
    public function getSaleStatus(): Status
    {
        return $this->saleStatus;
    }

    /**
     * @param Status $saleStatus
     */
    public function setSaleStatus(Status $saleStatus): void
    {
        $this->saleStatus = $saleStatus;
    }

    /**
     * @return Collection|Wishlist[]
     */
    public function getWishlists(): Collection
    {
        return $this->wishlists;
    }

    public function addWishlist(Wishlist $wishlist): self
    {
        if (!$this->wishlists->contains($wishlist)) {
            $this->wishlists[] = $wishlist;
            $wishlist->setProduct($this);
        }

        return $this;
    }

    public function removeWishlist(Wishlist $wishlist): self
    {
        if ($this->wishlists->contains($wishlist)) {
            $this->wishlists->removeElement($wishlist);
            // set the owning side to null (unless already changed)
            if ($wishlist->getProduct() === $this) {
                $wishlist->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ShoppingCart[]
     */
    public function getShoppingCarts(): Collection
    {
        return $this->shoppingCarts;
    }

    public function addShoppingCart(ShoppingCart $shoppingCart): self
    {
        if (!$this->shoppingCarts->contains($shoppingCart)) {
            $this->shoppingCarts[] = $shoppingCart;
            $shoppingCart->setProduct($this);
        }

        return $this;
    }

    public function removeShoppingCart(ShoppingCart $shoppingCart): self
    {
        if ($this->shoppingCarts->contains($shoppingCart)) {
            $this->shoppingCarts->removeElement($shoppingCart);
            // set the owning side to null (unless already changed)
            if ($shoppingCart->getProduct() === $this) {
                $shoppingCart->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProduct($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getProduct() === $this) {
                $image->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new \DateTime();
    }

    // public function isOwnedBy(User $user): bool
    // {
    //     if (null !== $this->getUser()) {
    //         return $this->getUser()->getId() === $user->getId();
    //     }

    //     return false;
    // }

//    public function isOwnedByBuilding(Building $building): bool
//    {
//        if (null !== $this->getBuilding()) {
//            return $this->getBuilding()->getId() === $building->getId();
//        }
//
//        return false;
//    }
}
