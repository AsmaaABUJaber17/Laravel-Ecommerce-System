<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Product;

/**
 * Factory خاص بعناصر الطلب
 */
class OrderItemFactory extends Factory
{
    public function definition()
    {
        return [
            // ربط العنصر بطلب
            'order_id' => Order::factory(),

            // ربط العنصر بمنتج
            'product_id' => Product::factory(),

            // كمية المنتج
            'quantity' => $this->faker->numberBetween(1, 5),

            // سعر الوحدة
            'unit_price' => $this->faker->randomFloat(2, 10, 200),
        ];
    }
}
