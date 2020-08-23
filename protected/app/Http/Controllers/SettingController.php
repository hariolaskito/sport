<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Setting;
use Validator;
use File;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Setting Perusahaan";
        $data['title_desc'] = "Ubah setting perusahaan";

        $data['name'] = Setting::where('code','COMP_NAME')->first();
        $data['address'] = Setting::where('code','COMP_ADDRESS')->first();
        $data['city'] = Setting::where('code','COMP_CITY')->first();
        $data['state'] = Setting::where('code','COMP_STATE')->first();
        $data['zipcode'] = Setting::where('code','COMP_ZIPCODE')->first();
        $data['phone'] = Setting::where('code','COMP_PHONE')->first();
        $data['hp'] = Setting::where('code','COMP_HP')->first();
        $data['email'] = Setting::where('code','COMP_EMAIL')->first();
        $data['image'] = Setting::where('code','COMP_IMG')->first();
        $data['facebook'] = Setting::where('code','SOC_FACEBOOK')->first();
        $data['twitter'] = Setting::where('code','SOC_TWITTER')->first();
        $data['instagram'] = Setting::where('code','SOC_INSTAGRAM')->first();
        $data['mindp'] = Setting::where('code','FTS_MINDP')->first();
        $data['hour_bonus'] = Setting::where('code','FTS_HOUR_BONUS')->first();

        $data['page_about'] = Setting::where('code','PAGE_ABOUT')->first();
        return view('backend.setting.edit')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'phone' => 'required',
            'hp' => 'required',
            'email' => 'required',
            'page_about' => 'required',
            'image' => 'mimes:jpg,jpeg,JPEG,png,gif,bmp|max:2024',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $set_name = Setting::where('code','COMP_NAME')->first();
        if(count($set_name)){
            Setting::where('code','COMP_NAME')->update(array('value' => $request->name));
        }else{
            $set_name = new Setting();
            $set_name->code = "COMP_NAME";
            $set_name->value = $request->name;
            $set_name->save();
        }
        $set_address = Setting::where('code','COMP_ADDRESS')->first();
        if(count($set_address)){
            Setting::where('code','COMP_ADDRESS')->update(array('value' => $request->address));
        }else{
            $set_address = new Setting();
            $set_address->code = "COMP_ADDRESS";
            $set_address->value = $request->address;
            $set_address->save();
        }
        $set_city = Setting::where('code','COMP_CITY')->first();
        if(count($set_city)){
            Setting::where('code','COMP_CITY')->update(array('value' => $request->city));
        }else{
            $set_city = new Setting();
            $set_city->code = "COMP_CITY";
            $set_city->value = $request->city;
            $set_city->save();
        }
        $set_state = Setting::where('code','COMP_STATE')->first();
        if(count($set_state)){
            Setting::where('code','COMP_STATE')->update(array('value' => $request->state));
        }else{
            $set_state = new Setting();
            $set_state->code = "COMP_STATE";
            $set_state->value = $request->state;
            $set_state->save();
        }
        $set_zipcode = Setting::where('code','COMP_ZIPCODE')->first();
        if(count($set_zipcode)){
            Setting::where('code','COMP_ZIPCODE')->update(array('value' => $request->zipcode));
        }else{
            $set_zipcode = new Setting();
            $set_zipcode->code = "COMP_ZIPCODE";
            $set_zipcode->value = $request->zipcode;
            $set_zipcode->save();
        }
        $set_phone = Setting::where('code','COMP_PHONE')->first();
        if(count($set_phone)){
            Setting::where('code','COMP_PHONE')->update(array('value' => $request->phone));
        }else{
            $set_phone = new Setting();
            $set_phone->code = "COMP_PHONE";
            $set_phone->value = $request->phone;
            $set_phone->save();
        }
        $set_hp = Setting::where('code','COMP_HP')->first();
        if(count($set_hp)){
            Setting::where('code','COMP_HP')->update(array('value' => $request->hp));
        }else{
            $set_hp = new Setting();
            $set_hp->code = "COMP_HP";
            $set_hp->value = $request->hp;
            $set_hp->save();
        }
        $set_email = Setting::where('code','COMP_EMAIL')->first();
        if(count($set_email)){
            Setting::where('code','COMP_EMAIL')->update(array('value' => $request->email));
        }else{
            $set_email = new Setting();
            $set_email->code = "COMP_EMAIL";
            $set_email->value = $request->email;
            $set_email->save();
        }
        if($request->image){
            $photo = date("YmdHis")."_".$request->file('image')->getClientOriginalName();
            $destination = 'assets/images';
            $request->file('image')->move($destination, $photo);
            $imageget = Setting::where('code','COMP_IMG')->first();
            File::delete('assets/images/' . $imageget->value);
            Setting::where('code','COMP_IMG')->update(array('value' => $photo));
        }
        $set_facebook = Setting::where('code','SOC_FACEBOOK')->first();
        if(count($set_facebook)){
            Setting::where('code','SOC_FACEBOOK')->update(array('value' => $request->facebook));
        }else{
            $set_facebook = new Setting();
            $set_facebook->code = "SOC_FACEBOOK";
            $set_facebook->value = $request->facebook;
            $set_facebook->save();
        }
        $set_twitter = Setting::where('code','SOC_TWITTER')->first();
        if(count($set_twitter)){
            Setting::where('code','SOC_TWITTER')->update(array('value' => $request->twitter));
        }else{
            $set_twitter = new Setting();
            $set_twitter->code = "SOC_TWITTER";
            $set_twitter->value = $request->twitter;
            $set_twitter->save();
        }
        $set_instagram = Setting::where('code','SOC_INSTAGRAM')->first();
        if(count($set_instagram)){
            Setting::where('code','SOC_INSTAGRAM')->update(array('value' => $request->instagram));
        }else{
            $set_instagram = new Setting();
            $set_instagram->code = "SOC_INSTAGRAM";
            $set_instagram->value = $request->instagram;
            $set_instagram->save();
        }

        $set_page_about = Setting::where('code','PAGE_ABOUT')->first();
        if(count($set_page_about)){
            Setting::where('code','PAGE_ABOUT')->update(array('value' => $request->page_about));
        }else{
            $set_page_about = new Setting();
            $set_page_about->code = "PAGE_ABOUT";
            $set_page_about->value = $request->page_about;
            $set_page_about->save();
        }

        $set_mindp = Setting::where('code','FTS_MINDP')->first();
        if(count($set_mindp)){
            Setting::where('code','FTS_MINDP')->update(array('value' => $request->mindp));
        }else{
            $set_mindp = new Setting();
            $set_mindp->code = "FTS_MINDP";
            $set_mindp->value = $request->mindp;
            $set_mindp->save();
        }

        $set_hour_bonus = Setting::where('code','FTS_HOUR_BONUS')->first();
        if(count($set_hour_bonus)){
            Setting::where('code','FTS_HOUR_BONUS')->update(array('value' => $request->hour_bonus));
        }else{
            $set_hour_bonus = new Setting();
            $set_hour_bonus->code = "FTS_HOUR_BONUS";
            $set_hour_bonus->value = $request->hour_bonus;
            $set_hour_bonus->save();
        }

        $data = array();
        $data['response_status'] = 1;
        $data['response_message'] = 'Artikel berhasil diupdate';
        return redirect()->route('setting.index')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
