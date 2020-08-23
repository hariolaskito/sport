<?php

use Illuminate\Database\Seeder;
use App\Pitch;
use App\PitchPrice;

class PitchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pitch')->delete();

        $pitch = new Pitch();
        $pitch->name = "Lapangan 1";
        $pitch->description = "1";
        $pitch->isactive = "1";
        $pitch->image = "";
        $pitch->user_id = 1;
        $pitch->save();

        for($i = 0; $i < 24; $i++){
        	$pitchprice = new PitchPrice();
        	$pitchprice->pitch_id = $pitch->id;
        	$pitchprice->time_number = $i;
        	$pitchprice->price = 100000;
        	$pitchprice->save();
        }

        $pitch = new Pitch();
        $pitch->name = "Lapangan 2";
        $pitch->description = "2";
        $pitch->isactive = "1";
        $pitch->image = "";
        $pitch->user_id = 1;
        $pitch->save();

        for($i = 0; $i < 24; $i++){
        	$pitchprice = new PitchPrice();
        	$pitchprice->pitch_id = $pitch->id;
        	$pitchprice->time_number = $i;
        	$pitchprice->price = 150000;
        	$pitchprice->save();
        }

        $pitch = new Pitch();
        $pitch->name = "Lapangan 3";
        $pitch->description = "3";
        $pitch->isactive = "1";
        $pitch->image = "";
        $pitch->user_id = 1;
        $pitch->save();

        for($i = 0; $i < 24; $i++){
        	$pitchprice = new PitchPrice();
        	$pitchprice->pitch_id = $pitch->id;
        	$pitchprice->time_number = $i;
        	$pitchprice->price = 120000;
        	$pitchprice->save();
        }

        $pitch = new Pitch();
        $pitch->name = "Lapangan 4";
        $pitch->description = "4";
        $pitch->isactive = "1";
        $pitch->image = "";
        $pitch->user_id = 1;
        $pitch->save();

        for($i = 0; $i < 24; $i++){
        	$pitchprice = new PitchPrice();
        	$pitchprice->pitch_id = $pitch->id;
        	$pitchprice->time_number = $i;
        	$pitchprice->price = 80000;
        	$pitchprice->save();
        }
    }
}
