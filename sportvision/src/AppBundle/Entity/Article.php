<?php

namespace AppBundle\Entity;

/**
 * Article
 */
class Article implements \JsonSerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $imageUrl;

    /**
     * @var int
     */
    private $price;

    /**
     * @var int
     */
    private $discount;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $type;

    /** @var array */
    private $sizes;

    /** @var  \DateTime */
    private $updatedAt;


    /**
     * @var string
     */
    private $sport;


    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setCode(string $code)
    {
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    public function getDiscount(): int
    {
        return $this->discount;
    }

    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    public function getSizes(): array
    {
        return $this->sizes;
    }

    public function setSizes(array $sizes)
    {
        $this->sizes = $sizes;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function setSport(string $sport)
    {
        $this->sport = $sport;
    }

    public function getSport(): string
    {
        return $this->sport;
    }

   /* public function isOutlet(): bool
    {
        return $this->outlet;
    }

    public function setOutlet(bool $outlet)
    {
        $this->outlet = $outlet;
    } */
    function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this-> name,
            'code' => $this->code,
            'image' => $this->imageUrl,
            'price' => $this->price,
            'discount' => $this->discount,
            'gender' => $this->gender,
            'type' => $this->type,
            'sizes' => $this->sizes,
            'updatedAt' => $this->updatedAt,
            'sport' => $this->sport,
        ];
    }

}
