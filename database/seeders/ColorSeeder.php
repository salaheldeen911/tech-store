<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < count(Color::BASE_COLORS); $i++) {
            Color::create([
                'name' => Color::BASE_COLORS[$i],
                'user_id' => 1
            ]);
        }
    }
}
