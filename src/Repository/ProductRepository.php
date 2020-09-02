<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Product;
use App\Exception\Product\ProductNotFoundException;
use App\Exception\User\UserNotFoundException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class ProductRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Product::class;
    }

    public function findOneByIdOrFail(string $id): Product
    {
        if (null === $product = $this->objectRepository->findOneBy(['id' => $id, 'active' => true])) {
            throw ProductNotFoundException::fromId($id);
        }

        return $product;
    }

    public function findAllByCategoryOrFail(string $categoryId): array
    {
        if (null === $products = $this->objectRepository->findAll(['category_id' => $categoryId, 'active' => true])) {
            throw ProductNotFoundException::fromCategoryId($categoryId);
        }

        return $products;
    }

    public function findAllBySubCategoryOrFail(string $subcategoryId): array
    {
        if (null === $products = $this->objectRepository->findAll(['subcategory_id' => $subcategoryId, 'active' => true])) {
            throw ProductNotFoundException::fromSubCategoryId($subcategoryId);
        }

        return $products;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Product $product): void
    {
        $this->saveEntity($product);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Product $product): void
    {
        $this->removeEntity($product);
    }
}
