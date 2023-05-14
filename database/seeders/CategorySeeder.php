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
        for ($i = 0; $i < count(Category::BASE_CATEGORIES); $i++) {
            Category::create([
                'name' => Category::BASE_CATEGORIES[$i],
            ]);
        }
    }
}
