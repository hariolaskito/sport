<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(RoleSeeder::class);
    	$this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PitchSeeder::class);
        $this->call(SettingSeeder::class);
    }
}
