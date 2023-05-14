<?php

namespace Database\Seeders;

use App\Models\AdvertisingSection;
use Illuminate\Database\Seeder;

class AdvertisingSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = null;
        $brand = null;

        for ($i = 1; $i <= 7; $i++) {
            if ($i < 4) {
                $category = $i;
            } else {
                $category = null;
            }
            if ($i >= 4) {
                $brand = $i;
            } else {
                $brand = null;
            }
            AdvertisingSection::create([
                'brand_id' => $brand,
                'category_id' => $category,
                'brand_main_image_name' => 'brand_img_' . $i . '.png',
                'brand_main_image_path' => 'images/advertisingSections/brand_img_' . $i . '.png',
                'brand_lable_image_name' => 'brand_lable_' . $i . '.png',
                'brand_lable_image_path' => 'images/advertisingSections/brand_lable_' . $i . '.png',
                'brand_order' => $i,
            ]);
        }
    }
}
