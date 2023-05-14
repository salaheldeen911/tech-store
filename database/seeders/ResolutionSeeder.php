<?php

namespace Database\Seeders;

use App\Models\Resolution;
use Illuminate\Database\Seeder;

class ResolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < count(Resolution::BASE_RESOLUTION); $i++) {
            Resolution::create([
                'name' => Resolution::BASE_RESOLUTION[$i],
                'user_id' => 1
            ]);
        }
    }
}
