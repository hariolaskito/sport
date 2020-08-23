<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use Auth;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Form;
use App\Cash;

class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Data Kas";
        $data['title_desc'] = "Menampilkan semua transaksi kas";
        return view('backend.cash.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Tambah Transaksi Kas Baru";
        $data['title_desc'] = "";
        return view('backend.cash.create')->with($data);
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
            'date' => 'required',
            'description' => 'required',
            'type' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $cash = new Cash();
            $cash->date = date("Y-m-d",strtotime($request->date));
            $cash->description = $request->description;
            $cash->user_id = Auth::user()->id;
            $cash->amount = $request->type * $request->amount;
            $cash->save();


            $data['response_status'] = 1;
            $data['response_message'] = "Transaksi berhasil ditambahkan";
        }
        return redirect()->route('cash.index')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $cashes = DB::table('cash')->select('cash.date','cash.description','user.username','cash.amount','cash.id')
        ->leftJoin('user','cash.user_id','=','user.id');
        return Datatables::of($cashes)
            ->editColumn('date', function ($cash) {
                $date = Carbon::createFromFormat('Y-m-d', $cash->date);
                $date->setTimezone('Asia/Jakarta');
                $txdate = date('d F Y', strtotime($date));
                return $txdate;
            })
            ->editColumn('id', function ($cash) {
                $html = '<a href="'.route('cash.edit', ['id' => $cash->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>';
                $html.= Form::open(array('route' => array('cash.destroy','id' => $cash->id), 'method' => 'delete', 'style' => 'display:inline;'));
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
        $data['title'] = "Edit Transaksi Kas";
        $data['title_desc'] = "";
        $data['cash'] = Cash::where('id',$id)->first();
        return view('backend.cash.edit')->with($data);
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
            'date' => 'required',
            'description' => 'required',
            'type' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            Cash::where('id',$id)->update(array(
                'date' => date("Y-m-d",strtotime($request->date)),
                'description' => $request->description,
                'amount' => $request->type * $request->amount,
                ));

            $data['response_status'] = 1;
            $data['response_message'] = "Transaksi berhasil diubah";
        }
        return redirect()->route('cash.index')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cash = Cash::where('id',$id)->first();
        $cash->delete();

        $data['response_status'] = 1;
        $data['response_message'] = 'Transaksi kas berhasil dihapus';
        return redirect()->route('cash.index')->with($data);
    }
}
