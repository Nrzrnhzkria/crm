<?php

use Illuminate\Database\Seeder;
use App\Package;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::create([
            'package_id' => 'PKD001',
            'name' => 'Momentum Internet',
            'price' => '999',
            'product_id' => 'PRD001',
        ]);
    }
}
