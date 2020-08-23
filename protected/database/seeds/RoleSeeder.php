<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->delete();

        $admin = new Role();
        $admin->id = '1';
		$admin->name         = 'admin';
		$admin->display_name = 'Administrator';
		$admin->save();

		$operator = new Role();
		$operator->id = '2';
		$operator->name = 'operator';
		$operator->display_name = 'Operator';
		$operator->save();

		$member = new Role();
		$member->id = '3';
		$member->name = 'member';
		$member->display_name = 'Member';
		$member->save();
    }
}
