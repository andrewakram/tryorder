<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();
        $category = Category::first();
        for($i=1 ; $i < 31 ;$i++){
            Product::create([
                "title" => "Product_title_".$i,
                "user_id" => isset($user) ? $user->id : null,
                "category_id" => isset($category) ? $category->id : null,
                "body" => "Product_body_".$i,
                "image" => null,
            ]);
        }
    }
}
