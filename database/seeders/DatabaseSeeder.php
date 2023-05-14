<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RolesAndPermissionsSeeder::class]);
        $this->call([UserSeeder::class]);
        $this->call([CategorySeeder::class]);
        $this->call([BrandSeeder::class]);
        $this->call([AdvertisingSectionSeeder::class]);
        $this->call([SliderSeeder::class]);
        $this->call([ColorSeeder::class]);
        $this->call([OperatingSystemSeeder::class]);
        $this->call([ProcessorSeeder::class]);
        $this->call([ResolutionSeeder::class]);
        $this->call([ScreenTypeSeeder::class]);
        $this->call([NetworkSeeder::class]);
        $this->call([RefreshRateSeeder::class]);
    }
}
