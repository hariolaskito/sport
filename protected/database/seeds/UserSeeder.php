<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->delete();

        $user = new User();
        $user->id = 1;
        $user->fullname = 'Super Administrator';
        $user->username = 'superadmin';
        $user->phone = '085732304321';
        $user->isactive = '1';
        $user->isdefault = '1';
        $user->role = 'admin';
        $user->email = 'superadmin@gmail.com';
        $user->password = Hash::make("123456");
        $user->save();

        $role = Role::where('name',$user->role)->first();
        $user->roles()->attach($role->id);

        $user = new User();
        $user->id = 2;
        $user->fullname = 'Zlatan Ibrahimmovic';
        $user->username = 'zlatan';
        $user->phone = '085732301234';
        $user->isactive = '1';
        $user->isdefault = '0';
        $user->role = 'member';
        $user->email = 'zlatan@gmail.com';
        $user->password = Hash::make("123456");
        $user->save();
    }
}
