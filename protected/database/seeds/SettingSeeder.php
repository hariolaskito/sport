<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('setting')->delete();

        DB::table('setting')->insert(['code' => 'COMP_NAME','value' => 'Wahana Futsal']);
        DB::table('setting')->insert(['code' => 'COMP_ADDRESS','value' => 'Jln. Ki Hajar Dewantoro No. 53']);
        DB::table('setting')->insert(['code' => 'COMP_CITY','value' => 'Bandung']);
        DB::table('setting')->insert(['code' => 'COMP_ZIPCODE','value' => '61353']);
        DB::table('setting')->insert(['code' => 'COMP_STATE','value' => 'Jawa Barat']);
        DB::table('setting')->insert(['code' => 'COMP_PHONE','value' => '021-654321']);
        DB::table('setting')->insert(['code' => 'COMP_HP','value' => '081-254-256-789']);
        DB::table('setting')->insert(['code' => 'COMP_EMAIL','value' => 'wahanafutsal@gmail.com']);
        DB::table('setting')->insert(['code' => 'COMP_IMG','value' => 'logo.jpg']);
        DB::table('setting')->insert(['code' => 'SOC_FACEBOOK','value' => 'https://facebook.com']);
        DB::table('setting')->insert(['code' => 'SOC_TWITTER','value' => 'https://twitter.com']);
        DB::table('setting')->insert(['code' => 'SOC_INSTAGRAM','value' => 'https://instagram.com']);
        DB::table('setting')->insert(['code' => 'FTS_MINDP','value' => '50']);
        DB::table('setting')->insert(['code' => 'FTS_HOUR_BONUS','value' => '2']);
    }
}
