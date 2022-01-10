<?php

use Illuminate\Database\Seeder;
use App\Ticket;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::create([
            'ticket_id' => 'TIK001',
            'ticket_type' => 'paid',
            'ic' => '912345678900',
            'product_id' => 'PRD001', 
            'package_id' => 'PKD001',
            'payment_id'=> 'OD001',
            'user_id' => 'UID001',
        ]);
    }
}
