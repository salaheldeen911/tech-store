<?php

namespace Database\Seeders;

use App\Models\Network;
use Illuminate\Database\Seeder;

class NetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < count(Network::BASE_NETWORK); $i++) {
            Network::create([
                'name' => Network::BASE_NETWORK[$i],
                'user_id' => 1
            ]);
        }
    }
}
