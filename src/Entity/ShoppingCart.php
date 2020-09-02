<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Exception;
use Ramsey\Uuid\Uuid;


class ShoppingCart
{
    private string $id;
    private int $quantity;

    private User $user;
    private Product $product;

    private ?\DateTime $createdAt = null;
    private ?\DateTime $updatedAt = null;

    /**
     * @throws Exception
     */
    public function __construct(User $user, Product $product, int $quantity, string $id = null)
    {
        $this->id = $id ?? Uuid::uuid4()->toString();
        $this->user = $user;
        $this->product = $product;
        $this->quantity = $quantity;
        $this->createdAt = new \DateTime();
        $this->markAsUpdated();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new \DateTime();
    }

    public function isOwnedBy(User $user): bool
    {
        if (null !== $this->getUser()) {
            return $this->getUser()->getId() === $user->getId();
        }

        return false;
    }
}
