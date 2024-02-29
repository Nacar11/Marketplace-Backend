<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PaymentType;

class PaymentTypeFactory extends Factory
{
    protected $model = PaymentType::class;
    
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'code' => $this->faker->unique()->word,
            'product_image' => $this->faker->imageUrl(), 
        ];
    }
}