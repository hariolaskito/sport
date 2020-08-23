@extends('frontend.template')

@section('css')
<link href="{{ asset("/assets/backend/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css") }}" rel="stylesheet">
@endsection

@section('content')

        <!-- *** LOGIN MODAL END *** -->

        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>Order: {{ $booking->notrans }}</h1>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">

                            <li><a href="{{ route('front.home') }}">Home</a>
                            </li>
                            <li><a href="customer-orders.html">Booking Saya</a>
                            </li>
                            <li>Detail</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div id="content">
            <div class="container">

                <div class="row">

                    <!-- *** LEFT COLUMN ***
			 _________________________________________________________ -->

                    <div class="col-md-6 clearfix" id="customer-order">

                        <div class="box">
                            <div class="row addresses">
                                <div class="col-sm-12">
                                    <h3 class="text-uppercase">Informasi Booking</h3>
                                    <p>{{ $booking->name }}
                                        <br><i class="fa fa-phone"></i> {{ $booking->phone }}</p>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($booking_detail as $detail)
                                            <tr>
                                                <td>{{ date("d F Y",strtotime($detail->date)) }}</td>
                                                <td>@if($detail->time_number<10)0{{ $detail->time_number }}@else{{ $detail->time_number }}@endif:00</td>
                                                <td>Rp {{ number_format($detail->price) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" class="text-right">Total</th>
                                            <th>Rp {{ number_format($booking_total) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <!-- /.table-responsive -->
                            <a class="btn btn-template-main" href="{{ route('front.order') }}">Kembali Ke List Booking</a>
                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.col-md-9 -->

                    <!-- *** LEFT COLUMN END *** -->

                    <div class="col-md-1 clearfix" id="customer-order">
                    </div>

                    <!-- *** RIGHT COLUMN ***
			 _________________________________________________________ -->

                    <div class="col-md-5" id="customer-order">
                        <div class="box">
                        <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->

                            <div class="row addresses">
                                <div class="col-sm-12">
                                    <h3 class="text-uppercase">Histori Pembayaran</h3>
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Jenis</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($payments) > 0)
                                            @foreach($payments as $payment)
                                                <tr>
                                                    <td class="text-center">{{ date("d F Y",strtotime($payment->date)) }}</td>
                                                    <td class="text-center"><span class="label label-default">{{ $payment->type }}</span></td>
                                                    <td class="text-center">
                                                        @if($payment->status == 1)
                                                            <span class="label label-success">Dikonfirmasi</span>
                                                        @else
                                                            <span class="label label-warning">Belum Dikonfirmasi</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-right">Rp {{ number_format($payment->amount) }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <td class="text-center" colspan="4">Tidak Ada Pembayaran</td>
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" class="text-right">Total Pembayaran</th>
                                            <th colspan="2" class="text-success text-right"><b>Rp {{ number_format($payment_total_confirm) }}</b></th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-right">Sisa Pembayaran</th>
                                            <th colspan="2" class="text-warning text-right"><b>Rp {{ number_format($booking_total - $payment_total_confirm) }}</b></th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            @if($count_transfer == 0 and $payment_total < $booking_total)
                            <div class="row addresses">
                                <div class="col-sm-12">
                                    <h3 class="text-uppercase">Konfirmasi Pembayaran</h3>
                                </div>
                            </div>

                            <div class="row addresses">
                                <div class="col-sm-12">
                                    <h4 class="text-uppercase">No Rekening</h4>
                                </div>
                            </div>

                            <div class="table-responsive">
                                {{ Form::open(array('route' => array('front.confirm'), 'method' => 'post', 'id' => 'formconfirm', 'class' => '', 'autocomplete' => 'false')) }}
                                    <input type="hidden" name="booking_id" value="{{ $booking->id }}"/>
                                    <div class="form-group">
                                        <label class="label-control">Type Pembayaran</label>
                                        <select class="form-control" name="type" required>
                                            <option value="transfer">Transfer</option>
                                            @if(count($payments) == 0)
                                            <option value="coupon">Kupon Bonus</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group dis-coupon" style="display:none;">
                                        <label class="label-control">Jam Kupon</label>
                                        <select class="form-control" name="total_coupon">
                                            @for($i = 1; $i <= $count_coupon; $i++)
                                                @if($i <= $booking_count)
                                                    <option value="{{ $i }}">{{ $i }} jam</option>
                                                @else
                                                    <option value="{{ $i }}" disabled>{{ $i }} jam</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group dis-transfer">
                                        <label class="label-control">Tanggal Transfer</label>
                                        <div class="input-group">
                                            <input type="text" name="date" class="form-control" value="{{ date("d-m-Y") }}" required />
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group dis-transfer">
                                        <label class="label-control">Nama Pemilik Rekening</label>
                                        <input type="text" name="account_name" class="form-control" required/>
                                    </div>
                                    <div class="form-group dis-transfer">
                                        <label class="label-control">Nominal</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp</div>
                                            <input type="text" data-v-min="{{ $mindp }}" name="amount" class="form-control" value="{{ $mindp }}" required/>
                                        </div>
                                        <span class="text text-info">Minimal DP adalah Rp {{ number_format($mindp) }}</span>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-template-main">Konfirmasi Pembayaran</button>
                                    </div>
                                {{ Form::close() }}
                            </div>
                            @endif
                        </div>

                        <!-- *** CUSTOMER MENU END *** -->
                    </div>

                    <!-- *** RIGHT COLUMN END *** -->

                </div>
                <!-- /.row -->


            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

@endsection

@section('javascript')
<!-- Parsley -->
<script src="{{ asset("/assets/backend/vendors/parsleyjs/dist/parsley.min.js")}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset("/assets/backend/vendors/moment/moment.min.js")}}"></script>
<script src="{{ asset("/assets/backend/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js") }}"></script>
<script src="{{ asset("/assets/backend/build/js/autoNumeric.min.js")}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('input[name=amount]').autoNumeric('init', { mDec: '0', unSetOnSubmit: true});
    $('#formconfirm').parsley();
    $('input[name=date]').datetimepicker({ format : 'DD-MM-YYYY' });
    $('select[name=type]').on('change', function(){
        if($(this).val() == "transfer"){
            $('.dis-transfer').show();
            $('.dis-coupon').hide();
            $("input[name=date]").prop('required',true);
            $("input[name=account_name]").prop('required',true);
            $("input[name=amount]").prop('required',true);
            $("input[name=count_coupon]").removeAttr('required');
        }else{
            $('.dis-transfer').hide();
            $('.dis-coupon').show();
            $("input[name=date]").removeAttr('required');
            $("input[name=account_name]").removeAttr('required');
            $("input[name=amount]").removeAttr('required');
            $("input[name=count_coupon]").prop('required',true);
        }
    });
  });
</script>
@endsection        

<!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+628117721882", // WhatsApp number
            call_to_action: "Message us", // Call to action
            position: "left", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->