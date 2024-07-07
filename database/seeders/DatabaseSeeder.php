<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::query()->delete();
        // \App\Models\Category::query()->delete();
        // \App\Models\Shipping::query()->delete();
        // \App\Models\Order::query()->delete();
        // \App\Models\Product::query()->delete();
        // \App\Models\Cart::query()->delete();
        // \App\Models\OrderItems::query()->delete();
        // \App\Models\Payment::query()->delete();
        // \App\Models\Review::query()->delete();

        //  \App\Models\ProductImages::query()->delete();

        //  \App\Models\User::factory(200)->create();
        // \App\Models\Category::factory(15)->create();
        //  \App\Models\Product::factory(1000)->create();
        // \App\Models\Cart::factory(10)->create();
        // \App\Models\Shipping::factory(200)->create();
        //   \App\Models\Order::factory(220)->create();
    //  \App\Models\Payment::factory(220)->create();
    //      \App\Models\OrderItems::factory(300)->create();
    //     \App\Models\WishList::factory(10)->create();
    //     \App\Models\ProductImages::factory(100)->create();
    //      \App\Models\Review::factory(30)->create();
        // \App\Models\Comment::factory(20)->create();
        \App\Models\Invoice::factory(200)->create();
       \App\Models\Sell::factory(350)->create();










        // $this->call([
        //     CategorySeeder::class,
        //     ProductSeeder::class,
        //     // Other seeders...
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
