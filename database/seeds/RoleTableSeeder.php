<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role_id' => 'ROD001',
            'name' => 'Superadministrator',
            'description' => 'All access is granted',
        ]);
    }
}
