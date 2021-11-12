<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->role_name = "admin";
        $role_admin->save();

        $role_super_admin = new Role();
        $role_super_admin->role_name = "super_admin";
        $role_super_admin->save();

    }
}
