<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory خاص بإنشاء بيانات وهمية لجدول tags
 */
class TagFactory extends Factory
{
    /**
     * تعريف القيم الافتراضية للـ Tag
     */
    public function definition()
    {
        return [
            // اسم وسم عشوائي
            'name' => $this->faker->word(),
        ];
    }
}
