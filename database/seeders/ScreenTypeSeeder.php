<?php

namespace Database\Seeders;

use App\Models\ScreenType;
use Illuminate\Database\Seeder;

class ScreenTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < count(ScreenType::BASE_SCREEN_TYPE); $i++) {
            ScreenType::create([
                'name' => ScreenType::BASE_SCREEN_TYPE[$i],
                'user_id' => 1
            ]);
        }
    }
}
