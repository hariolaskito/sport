<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use Auth;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Form;
use App\Booking;
use App\BookingDetail;
use App\Payment;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Transaksi Booking";
        $data['title_desc'] = "Tampilkan Semua Transaksi Booking";
        return view('backend.booking.view')->with($data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $sql = "select booking_id, sum(price) as price, count(booking_id) as time_count from booking_detail group by booking_id ";
        $sqlpayment = "select booking_id, sum(amount) as total_payment from payment where status = '1' group by booking_id ";
        $bookings = DB::table('booking as b')
                    ->join(DB::raw('('.$sql.') as d '),'d.booking_id','=','b.id')
                    ->leftJoin(DB::raw('('.$sqlpayment.') as py '),'py.booking_id','=','b.id')
                    ->leftJoin('user as u','u.id','=','b.user_id')
                    ->select('b.notrans','b.name','b.phone','d.price','total_payment','d.time_count','b.created_at','u.username','b.id');
        return Datatables::of($bookings)
            ->editColumn('created_at', function ($booking) {
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $booking->created_at);
                $date->setTimezone('Asia/Jakarta');
                $txdate = date('d F Y H:i', strtotime($date));
                return $txdate;
            })
            ->editColumn('price', function ($booking) {
                $html = "Rp ".number_format($booking->price);
                return $html;
            })
            ->editColumn('time_count', function ($booking) {
                $html = number_format($booking->time_count)." jam";
                return $html;
            })
            ->editColumn('total_payment', function ($booking) {
                $html = "";
                if($booking->total_payment < $booking->price){
                    $html = "<span class='label label-warning'>Belum Lunas</span>";
                }else{
                    $html = "<span class='label label-success'>Lunas</span>";
                }
                return $html;
            })
            ->editColumn('id', function ($booking) {
                $html = '<a href="'.route('booking.detail', ['id' => $booking->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-info"></i> Detail</a>';
                $html.= Form::open(array('route' => array('booking.destroy','id' => $booking->id), 'method' => 'delete', 'style' => 'display:inline;'));
                $html.='<button type="submit" onclick="confirm(\'Apakah anda ingin menghapus data ini?\')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</button>';
                $html.= Form::close();
                return $html;
            })
            ->filter(function ($query) use ($request) {
                if($request->has('status')){
                    switch ($request->status) {
                        case 'lunas':
                            $query->where('total_payment','>=','price');
                            break;
                        case 'belum':
                            $query->where('total_payment','<','price');
                            break;    
                        default:
                            # code...
                            break;
                    }
                }
                if ($request->has('date_start')) {
                    $query->where(DB::raw("(DATE_FORMAT(b.created_at,'%Y-%m-%d'))"),'>=',date("Y-m-d",strtotime($request->date_start)));
                }
                if ($request->has('date_finish')) {
                    $query->where(DB::raw("(DATE_FORMAT(b.created_at,'%Y-%m-%d'))"),'<=',date("Y-m-d",strtotime($request->date_finish)));
                }
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
    public function detail($id)
    {
        $data['title'] = "Detail Booking";
        $data['title_desc'] = "Tampilkan detail transaksi booking";
        $data['booking'] = DB::table('booking as b')->leftJoin('user as u','u.id','=','b.user_id')
                            ->leftJoin('pitch as p','p.id','=','b.pitch_id')
                            ->select('b.id','b.notrans','b.name','b.phone','u.username','p.name as name_pitch','b.created_at')
                            ->where('b.id',$id)
                            ->first();
        $data['booking_detail'] = BookingDetail::where('booking_id',$id)->get();
        $data['booking_total'] = BookingDetail::where('booking_id',$id)->sum('price');
        $data['payments'] = DB::table('payment as p')
                            ->leftJoin('user as u','u.id','=','p.user_id')
                            ->leftJoin('user as c','c.id','=','p.confirmer_id')
                            ->select('p.date','p.type','p.status','p.account_name','p.amount','p.created_at','u.username','c.username','p.id','p.booking_id')
                            ->where('booking_id',$id)->get();
        $data['payment_total'] = Payment::where('booking_id',$id)->where('status','1')->sum('amount');
        return view('backend.booking.detail')->with($data);
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
        $booking = Booking::where('id',$id);
        $booking->delete();

        $data['response_status'] = 1;
        $data['response_message'] = 'Transaksi booking berhasil dihapus';
        return redirect()->route('booking.index')->with($data);
    }

    public function view_laba()
    {
        $data['title'] = "Report Laba";
        $data['title_desc'] = "Tampilkan report laba per perioder tertentu";
        return view('backend.report.laba')->with($data);
    }

    public function report_laba(Request $request)
    {
        $sql = "SELECT p.date, CONCAT('Pembayaran oleh ',account_name,' via ',type,' untuk transaksi no. ',b.notrans) AS description, 'Pembayaran' AS type, p.amount FROM payment p INNER JOIN booking b ON b.id = p.booking_id WHERE type = 'transfer' OR type = 'cash' UNION SELECT date, description, 'Kas' AS type, amount FROM cash";
        $reports = DB::table(DB::raw("($sql) report"));
        return Datatables::of($reports)
            ->editColumn('date', function ($report) {
                $date = Carbon::createFromFormat('Y-m-d', $report->date);
                $date->setTimezone('Asia/Jakarta');
                $txdate = date('d F Y', strtotime($date));
                return $txdate;
            })
            ->addColumn('debit', function ($report) {
                $html = "";
                if($report->amount >= 0){
                    $html = "Rp ".number_format($report->amount);
                }
                return $html;
            })
            ->addColumn('credit', function ($report) {
                $html = "";
                if($report->amount < 0){
                    $html = "Rp ".number_format($report->amount * (-1));
                }
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
