<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * Factory خاص بملف المستخدم الشخصي
 */
class ProfileFactory extends Factory
{
    public function definition()
    {
        return [
            // ربط البروفايل بمستخدم
            'user_id' => User::factory(),

            // عنوان وهمي
            'address' => $this->faker->address(),

            // رقم هاتف وهمي
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
