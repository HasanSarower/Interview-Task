<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('role_name','admin')->first();
        $role_super_admin = Role::where('role_name','super_admin')->first();

        $admin = new User();
        $admin->name = "Admin Name";
        $admin->email = "admin@gmail.com";
        $admin->password = "123456";
        $admin->save();
        $admin->roles()->attach($role_admin);

        $super_admin = new User();
        $super_admin->name = "Super Admin Name";
        $super_admin->email = "super@gmail.com";
        $super_admin->password = "123456";
        $super_admin->save();
        $super_admin->roles()->attach($role_super_admin);

    }
}
