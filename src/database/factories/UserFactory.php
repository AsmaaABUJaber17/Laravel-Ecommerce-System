<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * Factory خاص بإنشاء مستخدمين وهميين
 */
class UserFactory extends Factory
{
    /**
     * كلمة مرور ثابتة (اختياري)
     */
    protected static ?string $password;

    /**
     * تعريف القيم الافتراضية للمستخدم
     */
    public function definition()
    {
        return [
            // اسم المستخدم
            'name' => $this->faker->name(),

            // بريد إلكتروني فريد
            'email' => $this->faker->unique()->safeEmail(),

            // تأكيد البريد الإلكتروني
            'email_verified_at' => now(),

            // تشفير كلمة المرور
            'password' => Hash::make('password'),
        ];
    }

    /**
     * إنشاء مستخدم بدون تفعيل البريد
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
