<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'product_id' => 'PRD001',
            'name' => 'Momentum Internet',
            'description' => 'Program Momentum Internet',
            'date_from' => '2020-02-02',
            'date_to' => '2020-02-02',
            'time_from' => '00:00',
            'time_to' => '00:00',
            'offer_id' => 'OFF001'
        ]);
    }
}
