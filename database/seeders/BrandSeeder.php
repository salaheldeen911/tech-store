<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < count(Brand::BASE_BRANDS); $i++) {
            Brand::create([
                'name' => Brand::BASE_BRANDS[$i],
                'user_id' => 1
            ]);
        }
    }
}
