<?php

declare(strict_types=1);

namespace App\Exception\Product;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductNotFoundException extends NotFoundHttpException
{
    private const MESSAGE = 'Product with id %s not found';

    public static function fromId(string $id): self
    {
        throw new self(\sprintf(self::MESSAGE, $id));
    }

    public static function fromCategoryId(string $categoryId): self
    {
        throw new self(\sprintf('Nenhuma Categoria com o id %s foi encontrada', $categoryId));
    }

    public static function fromSubCategoryId(string $subcategoryId): self
    {
        throw new self(\sprintf('Nenhuma Subcategoria com o id %s foi encontrada', $subcategoryId));
    }
}
