<?php

use Illuminate\Database\Seeder;

class RoletableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new \App\Models\Role();
        $role_user->name = 'User';
        $role_user->description = 'A normal user';
        $role_user->save();

        $role_admin = new \App\Models\Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'The Admin';
        $role_admin->save();
    }
}
