<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء مستخدمين مع ملفاتهم الشخصية
        User::factory(10)->create()->each(function ($user) {
            Profile::factory()->create([
                'user_id' => $user->id
            ]);
        });

        // إنشاء تصنيفات ووسوم
        Category::factory(5)->create();
        Tag::factory(8)->create();

        // إنشاء منتجات وربطها مع الوسوم
        Product::factory(20)->create()->each(function ($product) {
            $tags = Tag::inRandomOrder()->take(rand(1,3))->pluck('id');
            $product->tags()->attach($tags, ['notes' => 'auto seeded']);
        });

        // إنشاء طلبات مع عناصر الطلب
        Order::factory(10)->create()->each(function ($order) {
            OrderItem::factory(rand(1,3))->create([
                'order_id' => $order->id,
                'product_id' => Product::inRandomOrder()->first()->id,
            ]);
        });
    }
}
