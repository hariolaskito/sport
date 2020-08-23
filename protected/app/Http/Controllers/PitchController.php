<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pitch;
use App\PitchPrice;
use Validator;
use DB;
use Auth;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Form;

class PitchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Data Lapangan";
        $data['title_desc'] = "Menampilkan semua lapangan";
        return view('backend.pitch.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Tambah Lapangan Baru";
        $data['title_desc'] = "";
        return view('backend.pitch.create')->with($data);
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
            'description' => 'required',
            'isactive' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $pitch = new Pitch();
            $pitch->name = $request->name;
            $pitch->isactive = $request->isactive;
            $pitch->image = "";
            $pitch->description = $request->description;
            $pitch->user_id = Auth::user()->id;
            $pitch->save();

            $arrprice = $request->price;
            for ($i=0; $i < count($arrprice); $i++) { 
                $pitchprice = new PitchPrice();
                $pitchprice->pitch_id = $pitch->id;
                $pitchprice->time_number = $i;
                $pitchprice->price = $arrprice[$i];
                $pitchprice->save();
            }

            $data['response_status'] = 1;
            $data['response_message'] = 'Lapangan berhasil dibuat';
            return redirect()->route('pitch.index')->with($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $pitches = DB::table('pitch')->select('pitch.name','user.username','pitch.created_at','pitch.isactive','pitch.id')
        ->leftJoin('user','pitch.user_id','=','user.id');
        return Datatables::of($pitches)
            ->editColumn('created_at', function ($pitch) {
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $pitch->created_at);
                $date->setTimezone('Asia/Jakarta');
                $txdate = date('d F Y H:i', strtotime($date));
                return $txdate;
            })
            ->editColumn('isactive', function ($pitch) {
                $html = "";
                if($pitch->isactive == 1){
                    $html = "<span class='label label-success'>Active</span>";
                }else{
                    $html = "<span class='label label-danger'>Non Aktif</span>";
                }
                return $html;
            })
            ->editColumn('id', function ($pitch) {
                $html = '<a href="'.route('pitch.edit', ['id' => $pitch->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>';
                $html.= Form::open(array('route' => array('pitch.destroy','id' => $pitch->id), 'method' => 'delete', 'style' => 'display:inline;'));
                $html.='<button type="submit" onclick="confirm(\'Apakah anda ingin menghapus data ini?\')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</button>';
                $html.= Form::close();
                return $html;
            })
            ->setRowId('id')
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Edit Lapangan";
        $data['title_desc'] = "";
        $data['pitch'] = Pitch::where('id',$id)->first();
        $data['pitch_prices'] = PitchPrice::where('pitch_id',$id)->get();
        return view('backend.pitch.edit')->with($data);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'isactive' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            Pitch::where('id',$id)->update(
                array('name' => $request->name, 
                'isactive' => $request->isactive, 
                'description' => $request->description)
            );

            $arrprice = $request->price;
            for ($i=0; $i < count($arrprice); $i++) { 
               PitchPrice::where('pitch_id',$id)->where('time_number',$i)->update(
                    array('price' => $arrprice[$i])
                );
            }

            $data['response_status'] = 1;
            $data['response_message'] = 'Lapangan berhasil diupdate';
            return redirect()->route('pitch.index')->with($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pitch = Pitch::where('id',$id)->first();
        $pitch->delete();

        $data['response_status'] = 1;
        $data['response_message'] = 'Lapangan berhasil dihapus';
        return redirect()->route('pitch.index')->with($data);
    }
}
