<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->category_name = 'Nhạc trẻ';
        $category->save();
        $category = new Category();
        $category->category_name = 'Nhạc không lời';
        $category->save();
        $category = new Category();
        $category->category_name = 'Nhạc vàng';
        $category->save();
        $category = new Category();
        $category->category_name = 'Nhạc thiếu nhi';
        $category->save();
        $category = new Category();
        $category->category_name = 'Nhạc Việt';
        $category->save();
        $category = new Category();
        $category->category_name = 'Nhạc nước ngoài';
        $category->save();

    }
}
