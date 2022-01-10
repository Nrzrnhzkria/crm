<?php

use Illuminate\Database\Seeder;
use App\Payment;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'payment_id' => 'OD001',
            'pay_price' => '999',
            'totalprice' => '999',
            'quantity' => '1',
            'status' => 'succeeded',
            'upgrade_count' => '1',
            'update_count' => '1',
            'pay_method' => 'FPX',
            'stud_id' => 'MI001',
            'product_id' => 'PRD001',
            'package_id' => 'PKD001',
            'offer_id' => 'OFF001',
            'stripe_id' => 'cus_001',
            'user_id' => 'UID001',
        ]);
    }
}
