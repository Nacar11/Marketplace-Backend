<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Country;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CountryFactory extends Factory
{
    protected $model = Country::class;


    public function definition(): array
    {
        return [
            'name' => $this->faker->country,

        ];
    }

}
