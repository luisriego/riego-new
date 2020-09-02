<?php


namespace App\Entity;


use Exception;
use Ramsey\Uuid\Uuid;

class Image
{
    private string $id;
    private string $url;
    private int $width;
    private int $height;
    private float $ratio;
    private string $alt;

    private Product $product;

    private ?\DateTime $createdAt = null;
    private ?\DateTime $updatedAt = null;

//    /**
//     * @ORM\Column(type="string", length=100, nullable=true)
//     */
//    private string $type;


    /** @throws Exception */
    public function __construct(Product $product,
                                string $url,
                                string $id = null,
                                int $width = 0,
                                int $height = 0,
                                float $ratio = 0.0,
                                string $alt = '')
    {
        $this->id = $id ?? Uuid::uuid4()->toString();
        $this->product = $product;
        $this->url = $url;
        $this->width = $width;
        $this->height = $height;
        $this->ratio = $ratio;
        $this->alt = $alt;
        $this->createdAt = new \DateTime();
        $this->markAsUpdated();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return float
     */
    public function getRatio(): float
    {
        return $this->ratio;
    }

    /**
     * @return string
     */
    public function getAlt(): string
    {
        return $this->alt;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @param float $ratio
     */
    public function setRatio(float $ratio): void
    {
        $this->ratio = $ratio;
    }

    /**
     * @param string $alt
     */
    public function setAlt(string $alt): void
    {
        $this->alt = $alt;
    }


    public function markAsUpdated(): void
    {
        $this->updatedAt = new \DateTime();
    }
}
