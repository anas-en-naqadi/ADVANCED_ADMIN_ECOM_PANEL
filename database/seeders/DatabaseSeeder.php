<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
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
        \App\Models\Shipping::factory(200)->create();
    //       \App\Models\Order::factory(220)->create();
    //  \App\Models\Payment::factory(220)->create();
    //      \App\Models\OrderItems::factory(300)->create();
    //      \App\Models\ProductImages::factory(100)->create();

    //    \App\Models\Sell::factory(350)->create();










        // $this->call([
        //     CategorySeeder::class,
        //     ProductSeeder::class,
        //     // Other seeders...
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Ans Enq',
        //     'email' => 'anas@admin.com',
        //     'password' => Hash::make("anas@admin.com"),
        //     'is_admin' => true
        // ]);
    }
}
