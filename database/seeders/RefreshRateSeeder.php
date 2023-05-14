<?php

namespace Database\Seeders;

use App\Models\RefreshRate;
use Illuminate\Database\Seeder;

class RefreshRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < count(RefreshRate::BASE_REFRESH_RATE); $i++) {
            RefreshRate::create([
                'name' => RefreshRate::BASE_REFRESH_RATE[$i],
                'user_id' => 1
            ]);
        }
    }
}
