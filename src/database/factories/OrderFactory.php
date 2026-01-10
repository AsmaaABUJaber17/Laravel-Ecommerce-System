<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * Factory خاص بإنشاء طلبات وهمية
 */
class OrderFactory extends Factory
{
    public function definition()
    {
        return [
            // ربط الطلب بمستخدم
            'user_id' => User::factory(),

            // المجموع الكلي (يحسب لاحقاً)
            'total' => 0,

            // حالة الطلب
            'status' => $this->faker->randomElement([
                'pending',
                'paid',
                'cancelled'
            ]),
        ];
    }
}
