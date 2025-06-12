<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{

    public function run()
    {
        Category::create(['name' => 'Elektronik']);
        Category::create(['name' => 'Perkakas']);
        Category::create(['name' => 'Makanan']);
    }
}
