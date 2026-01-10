<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * Factory خاص بإنشاء منتجات وهمية
 */
class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            // ربط المنتج بتصنيف
            'category_id' => Category::factory(),

            // اسم المنتج
            'name' => $this->faker->word(),

            // سعر المنتج
            'price' => $this->faker->randomFloat(2, 10, 500),

            // كمية المخزون
            'stock' => $this->faker->numberBetween(0, 50),
        ];
    }
}
