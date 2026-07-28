<?php

namespace App\Models;

class Product
{
    public int $id;
    public string $sku;
    public string $name;
    public string $category;
    public float $price;
    public int $stock;
    public string $specShort;
    public string $description;
    public array $specs;
    public string $image;

    public function __construct(array $data)
    {
        $this->id = (int) $data['id'];
        $this->sku = $data['sku'];
        $this->name = $data['name'];
        $this->category = $data['category'];
        $this->price = (float) $data['price'];
        $this->stock = (int) $data['stock'];
        $this->specShort = $data['specShort'];
        $this->description = $data['description'];
        $this->specs = $data['specs'];
        $this->image = $data['image'] ?? '';
    }

    /**
     * @return Product[]
     */
    public static function all(): array
    {
        $json = file_get_contents(resource_path('data/products.json'));
        $rows = json_decode($json, true) ?: [];

        return array_map(fn (array $row) => new self($row), $rows);
    }

    public static function find(int|string $id): ?self
    {
        foreach (self::all() as $product) {
            if ($product->id === (int) $id) {
                return $product;
            }
        }

        return null;
    }
}
