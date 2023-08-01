<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductItemFactory extends Factory
{
    protected $model = ProductItem::class;

    public function definition()
    {
        $productId = Product::pluck('id')->random();
        $userId = User::pluck('id')->random();
        return [
            'product_id' => $productId,
            'SKU' => $this->faker->unique()->bothify('??-########'),
            'qty_in_stock' => $this->faker->numberBetween(10, 100),
            'product_image' => $this->faker->imageUrl(640, 480),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'user_id' => $userId,
        ];
    }
}
