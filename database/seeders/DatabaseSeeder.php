<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\ProductItem;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Country;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        // ProductCategory::factory(10)->create();
        // Product::factory(5)->create();
        // ProductItem::factory(10)->create();
        // ProductImage::factory(10)->create();
        Country::factory(5)->create();

    }
}
