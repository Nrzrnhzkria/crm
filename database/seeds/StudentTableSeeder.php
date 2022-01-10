<?php

use Illuminate\Database\Seeder;
use App\Student;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'stud_id' => 'MI001',
            'first_name' => 'Nurzarinah',
            'last_name' => 'Zakaria',
            'ic' => '912345678900',
            'email' => 'example@gmail.com',
            'phoneno' => '+60198765432',
            'membership_id' => 'MB001',
            'level_id' => 'MBL001',
            'status' => 'active'
        ]);
    }
}
