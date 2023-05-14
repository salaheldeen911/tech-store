<?php

namespace Database\Seeders;

use App\Models\Processor;
use Illuminate\Database\Seeder;

class ProcessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < count(Processor::BASE_PROCESSOR); $i++) {
            Processor::create([
                'name' => Processor::BASE_PROCESSOR[$i],
                'user_id' => 1
            ]);
        }
    }
}
