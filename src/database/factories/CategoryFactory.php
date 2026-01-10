<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory خاص بإنشاء تصنيفات وهمية
 */
class CategoryFactory extends Factory
{
    /**
     * تعريف القيم الافتراضية للتصنيف
     */
    public function definition()
    {
        return [
            // اسم التصنيف
            'name' => $this->faker->word(),

            // وصف التصنيف
            'description' => $this->faker->sentence(),
        ];
    }
}
