@extends('backend.template')

@section('css')
    <!-- Datatables -->
    <link href="{{ asset("/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("/assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css") }}" rel="stylesheet">
@endsection

@section('content')
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>{{ $title }} <small>{{ $title_desc }}</small></h3>
    </div>
  </div>

  
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_content">
          <section class="content invoice">
            <!-- title row -->
            <div class="row">
              <div class="col-xs-6 invoice-header">
                <h1>@if($payment_total >= $booking_total) <span class="label label-success"><i class="fa fa-check"></i> Lunas</span>  @else <span class="label label-warning"><i class="fa fa-warning"></i> Belum Lunas</span> @endif</h1>
              </div>
              <div class="col-xs-6 invoice-header">
                <h1><small class="pull-right">Invoice: {{ $booking->notrans }}</small></h1>
              </div>
              <!-- /.col -->
            </div>
            <div class="row">
              <div class="col-xs-12">
                <h4><small class="pull-right">Dipesan oleh {{ $booking->username }} pada tanggal {{ date("d F Y H:i",strtotime($booking->created_at)) }}</small></h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info" style="margin-top: 50px;">
              <div class="col-sm-4 invoice-col">
                <span class='text' style="font-size: 17px;"><b>Customer</b></span>
                <address style="margin-top: 10px;font-size: 14px;">
                  <strong>{{ $booking->name }}</strong>
                  <br><i class="fa fa-phone"></i> {{ $booking->phone }}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-xs-12 table">
                <table class="table table-stripped">
                  <thead>
                    <tr>
                      <th class="text-center">Lapangan</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Waktu</th>
                      <th class="text-center">Harga</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($booking_detail as $detail)
                      <tr>
                        <td style="font-size: 14px;" class="text-center">{{ $booking->name_pitch }}</td>
                        <td style="font-size: 14px;" class="text-center"><i class="fa fa-calendar"></i> {{ date("d F Y",strtotime($detail->date)) }}</td>
                        <td style="font-size: 14px;" class="text-center"><i class="fa fa-clock-o"></i> @if($detail->time_number<10)0{{ $detail->time_number }}@else{{ $detail->time_number }}@endif:00</td>
                        <td style="font-size: 14px;" class="text-right">Rp {{ number_format($detail->price) }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <div class="col-xs-6">
              </div>
              <!-- /.col -->
              <div class="col-xs-6">
                <p class="lead">&nbsp;</p>
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th><h4><b>Grand Total:</b></h4></th>
                        <td class="text-right"><h4><b>Rp {{ number_format($booking_total) }}</b></h4></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </section>
          <div class="clearfix"></div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Detail Pembayaran</h3>
            </div>
            <div class="panel-body">
              @if($payment_total < $booking_total)
              <a class="btn btn-primary pull-right" href="{{ route("payment.create",array('id' => $booking->id)) }}"><i class="fa fa-plus-circle"></i> Input Pembayaran</a>
              @endif
              <table class="table table-stripped table-bordered" id="table-payment">
                <thead>
                  <tr>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Jenis Pembayaran</th>
                    <th class="text-center">Pembayar</th>
                    <th class="text-center">Nominal</th>
                    <th class="text-center">Status</th>
                    <th class="text-center"></th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($payments) > 0)
                    @foreach($payments as $payment)
                      <tr>
                        <td class="text-center">{{ date("d F Y",strtotime($payment->date)) }}</td>
                        <td class="text-center"><span class="label label-default">{{ ucwords(strtolower($payment->type)) }}</span></td>
                        <td class="text-center">{{ $payment->account_name }}</td>
                        <td class="text-right">Rp {{ number_format($payment->amount) }}</td>
                        <td class="text-center"><span class="label @if($payment->status == 1) label-success @else label-warning @endif">@if($payment->status == 1) Sudah Dikonfirmasi @else Belum Dikonfirmasi @endif</span></td>
                        <td class="text-center">
                          @if($payment_total < $booking_total)
                          <a class="btn btn-xs btn-primary" href="{{ route('payment.edit',array('id' => $payment->id, 'booking_id' => $payment->booking_id)) }}"><i class="fa fa-edit"></i> Edit</a> {!! Form::open(array('route' => array('payment.destroy','id' => $payment->id), 'method' => 'delete', 'style' => 'display:inline;')) !!} <button type="submit" onclick="confirm(\'Apakah anda ingin menghapus data ini?\')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</button> {!! Form::close() !!}
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td class="text-center" colspan="6">Tidak ada pembayaran</td>
                    </tr>
                  @endif
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="3" class="text-right text-success"><b>Total Pembayaran</b></th>
                    <th class="text-right text-success"><b>Rp {{ number_format($payment_total) }}</b></th>
                    <th></th>
                    <th></th>
                  </tr>
                  <tr>
                    <th colspan="3" class="text-right text-danger"><b>Sisa Pembayaran</b></th>
                    <th class="text-right text-danger"><b>Rp {{ number_format($booking_total - $payment_total) }}</b></th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
              <a class="btn btn-info" href="{{ route('booking.index') }}">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('javascript')
<!-- Datatables -->
    <script src="{{ asset("/assets/backend/vendors/datatables.net/js/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("/assets/backend/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>
    <script src="{{ asset("/assets/backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js") }}"></script>
    <script src="{{ asset("/assets/backend/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js") }}"></script>
    <script src="{{ asset("/assets/backend/vendors/datatables.net-buttons/js/buttons.flash.min.js") }}"></script>
    <script src="{{ asset("/assets/backend/vendors/datatables.net-buttons/js/buttons.html5.min.js") }}"></script>
    <script src="{{ asset("/assets/backend/vendors/datatables.net-buttons/js/buttons.print.min.js") }}"></script>
    <script src="{{ asset("/assets/backend/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js") }}"></script>
    <script src="{{ asset("/assets/backend/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js") }}"></script>
    <script src="{{ asset("/assets/backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js") }}"></script>
    <script src="{{ asset("/assets/backend/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js") }}"></script>
    <script src="{{ asset("/assets/backend/vendors/datatables.net-scroller/js/datatables.scroller.min.js") }}"></script>
    <script src="{{ asset("/assets/backend/vendors/jszip/dist/jszip.min.js") }}"></script>
    <script src="{{ asset("/assets/backend/vendors/pdfmake/build/pdfmake.min.js") }}"></script>
    <script src="{{ asset("/assets/backend/vendors/pdfmake/build/vfs_fonts.js") }}"></script>
    <script type="text/javascript">
        $('#table-report').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('booking.datatable') }}',
            columns: [
                {data: 'noinvoice', name: 'noinvoice'},
                {data: 'name_customer', name: 'trans_rentcar.name'},
                {data: 'name_vehicle', name: 'vehicle.name', className: ''},
                {data: 'date_start', name: 'date_start', className: 'text-center'},
                {data: 'username', name: 'username', className: ''},
                {data: 'id', name: 'action', orderable: false, searchable: false, className: 'text-center'}
            ]
        });
    </script>
@endsection