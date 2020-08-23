<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\BookingDetail;
use DB;
use Validator;
use Auth;
use Yajra\Datatables\Datatables;
use Form;
use App\Setting;
use App\Coupon;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Validasi Pembayaran";
        $data['title_desc'] = "";
        return view('backend.payment.view')->with($data);
    }

    public function confirm($id){
        Payment::where('id',$id)->update(array('status' => '1', 'confirmer_id' => Auth::user()->id));
        $data['response_status'] = 1;
        $data['response_message'] = "Pembayaran berhasil divalidasi";

        $databooking = DB::table('payment as p')->join('booking as b','b.id','=','p.booking_id')
                      ->where('p.id',$id)->select('b.id','b.user_id')->first();

        $payment_total = Payment::where('booking_id',$databooking->id)->where('status','1')->sum('amount');
        $booking_total = BookingDetail::where('booking_id',$databooking->id)->sum('price');
        if($payment_total >= $booking_total){
            $maxbooking = intval(DB::table('coupon')->where('user_id',$databooking->user_id)->max('booking_detail_id'));
            $hour_bonus = Setting::where('code','FTS_HOUR_BONUS')->first()->value;
            $total_hour = DB::table('booking_detail as d')
                            ->join('booking as b','b.id','=','d.booking_id')
                            ->where('b.user_id',$databooking->user_id)
                            ->where('d.id','>',$maxbooking)->count();
            $datadetail = DB::table('booking_detail as d')
                            ->join('booking as b','b.id','=','d.booking_id')
                            ->where('b.user_id',$databooking->user_id)
                            ->where('d.id','>',$maxbooking)->select('d.id')->limit(intval($total_hour/$hour_bonus))->orderBy('d.id','desc')->get();                
            if(intval($total_hour/$hour_bonus) > 0){
                for ($i=0; $i < intval($total_hour/$hour_bonus); $i++) { 
                    $coupon = new Coupon();
                    $coupon->booking_detail_id = $datadetail[$i]->id;
                    $coupon->user_id = $databooking->user_id;
                    $coupon->save();
                }
            }
        }

        return redirect()->route('payment.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['title'] = "Input Pembayaran";
        $data['title_desc'] = "";
        $data['booking_id'] = $id;
        return view('backend.payment.create')->with($data);
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
            'booking_id' => 'required',
            'account_name' => 'required',
            'type' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $payment = new Payment();
            $payment->booking_id = $request->booking_id;
            $payment->date = date("Y-m-d",strtotime($request->date));
            $payment->account_name = $request->account_name;
            $payment->user_id = Auth::user()->id;
            $payment->confirmer_id = Auth::user()->id;
            $payment->status = 1;
            $payment->coupon_id = 0;
            $payment->amount = $request->amount;
            $payment->save();

            $databooking = DB::table('payment as p')->join('booking as b','b.id','=','p.booking_id')
                      ->where('p.id',$payment->id)->select('b.id','b.user_id')->first();

            $payment_total = Payment::where('booking_id',$request->booking_id)->where('status','1')->sum('amount');
            $booking_total = BookingDetail::where('booking_id',$request->booking_id)->sum('price');
            if($payment_total >= $booking_total){
                $maxbooking = intval(DB::table('coupon')->where('user_id',Auth::user()->id)->max('booking_detail_id'));
                $hour_bonus = Setting::where('code','FTS_HOUR_BONUS')->first()->value;
                $total_hour = DB::table('booking_detail as d')
                                ->join('booking as b','b.id','=','d.booking_id')
                                ->where('b.user_id',$databooking->user_id)
                                ->where('d.id','>',$maxbooking)->count();
                $datadetail = DB::table('booking_detail as d')
                                ->join('booking as b','b.id','=','d.booking_id')
                                ->where('b.user_id', $databooking->user_id)
                                ->where('d.id','>',$maxbooking)->select('d.id')->limit(intval($total_hour/$hour_bonus))->orderBy('d.id','desc')->get();                
                if(intval($total_hour/$hour_bonus) > 0){
                    for ($i=0; $i < intval($total_hour/$hour_bonus); $i++) { 
                        $coupon = new Coupon();
                        $coupon->booking_detail_id = $datadetail[$i]->id;
                        $coupon->user_id = $databooking->user_id;
                        $coupon->save();
                    }
                }
            }

            $data['response_status'] = 1;
            $data['response_message'] = "Pembayaran berhasil ditambahkan";
        }
        return redirect()->route('booking.detail',$request->booking_id)->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $payments = DB::table('payment as p')
                            ->leftJoin('user as u','u.id','=','p.user_id')
                            ->leftJoin('user as c','c.id','=','p.confirmer_id')
                            ->join('booking as b','b.id','=','p.booking_id')
                            ->select('b.notrans','p.date','p.type','p.status','p.account_name','p.amount','p.created_at','u.username','c.username','p.id','p.booking_id')
                            ->where('status',0);
        return Datatables::of($payments)
            ->editColumn('date', function ($payment) {
                $html = date("d F Y",strtotime($payment->date));
                return $html;
            })
            ->editColumn('type', function ($payment) {
                $html = "<span class='label label-default'>".ucwords(strtolower($payment->type))."</span>";
                return $html;
            })
            ->editColumn('amount', function ($payment) {
                $html = "Rp ".number_format($payment->amount);
                return $html;
            })
            ->editColumn('id', function ($payment) {
                $html = Form::open(array('route' => array('payment.confirm','id' => $payment->id), 'method' => 'patch', 'style' => 'display:inline;'));
                $html.='<button type="submit" onclick="confirm(\'Apakah anda ingin validasi pembayaran ini?\')" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Validasi</button>';
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
    public function edit($booking_id,$id)
    {
        $data['title'] = "Edit Pembayaran";
        $data['title_desc'] = "";
        $data['payment'] = Payment::where('id',$id)->first();
        return view('backend.payment.edit')->with($data);
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
            'account_name' => 'required',
            'type' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            Payment::where('id',$id)
            ->update(array(
                'account_name' => $request->account_name,
                'type' =>$request->type, 
                'amount' =>$request->amount, 
                ));

            $data['response_status'] = 1;
            $data['response_message'] = "Pembayaran berhasil diubah";
        }
        $payment = Payment::where('id',$id)->first();
        return redirect()->route('booking.detail',$payment->booking_id)->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::where('id',$id);
        $booking_id = $payment->first()->booking_id;
        $payment->delete();

        $data['response_status'] = 1;
        $data['response_message'] = 'Pembayaran berhasil dihapus';
        return redirect()->route('booking.detail',$booking_id)->with($data);
    }

    public function view_report_payment()
    {
        $data['title'] = "Report Pembayaran";
        $data['title_desc'] = "Tampilkan report pembayaran per periode tertentu";
        return view('backend.report.payment')->with($data);
    }

    public function report_payment(Request $request)
    {
        $reports = DB::table('payment as p')->join('booking as b','b.id','=','p.booking_id')
        ->where('p.type','<>','coupon')->where('p.status','1')
        ->select('p.date','b.notrans','p.type','p.account_name','p.amount');
        return Datatables::of($reports)
            ->editColumn('date', function ($report) {
                $date = Carbon::createFromFormat('Y-m-d', $report->date);
                $date->setTimezone('Asia/Jakarta');
                $txdate = date('d F Y', strtotime($date));
                return $txdate;
            })
            ->editColumn('type', function ($report) {
                $html = "";
                if($report->type == 'cash'){
                    $html = "<span class='label label-default'>Cash</span>";
                }elseif($report->type == 'transfer'){
                    $html = "<span class='label label-default'>Transfer</span>";
                }
                return $html;
            })
            ->addColumn('amount', function ($report) {
                $html = "Rp ".number_format($report->amount);
                return $html;
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('date_start')) {
                    $query->where('date','>=',date("Y-m-d",strtotime($request->date_start)));
                }
                if ($request->has('date_finish')) {
                    $query->where('date','<=',date("Y-m-d",strtotime($request->date_finish)));
                }
            })
            ->make(true);
    }
}
