<?php

namespace Database\Seeders;

use App\Models\OperatingSystem;
use Illuminate\Database\Seeder;

class OperatingSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < count(OperatingSystem::BASE_OPERATING_SYSTEM); $i++) {
            OperatingSystem::create([
                'name' => OperatingSystem::BASE_OPERATING_SYSTEM[$i],
                'user_id' => 1
            ]);
        }
    }
}
