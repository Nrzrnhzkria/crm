<?php

use Illuminate\Database\Seeder;
use App\Feature;

class FeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feature::create([
            'feat_id' => 'FID001',
            'name' => 'Features Package',
            'product_id' => 'PRD001',
            'package_id' => 'PKD001',
        ]);
    }
}
