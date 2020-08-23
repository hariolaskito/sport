@extends('backend.template')

@section('css')
    <!-- Datatables -->
    <link href="{{ asset("/assets/backend/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("/assets/backend/backend/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("/assets/backend/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css") }}" rel="stylesheet">
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
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
            @if(session()->has('response_status'))
              <div class="alert @if(session('response_status') == '1') alert-success @else alert-danger @endif alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                  {{ session('response_message') }}
              </div>
            @endif
            <div class="well well-sm">
              <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                  <label>Status</label>
                  <select class="form-control" id="status">
                    <option value="all">Semua Status</option>
                    <option value="lunas">Lunas</option>
                    <option value="belum">Belum lunas</option>
                  </select>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                  <label>Semua Periode</label>
                  <select class="form-control" id="periode">
                    <option value="all">Semua Periode</option>
                    <option value="selected">Pilih Periode</option>
                  </select>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 dis-date" style="display: none;">
                  <label>Tanggal Mulai</label>
                  <div class="input-group date date-input">
                    <input type="text" class="form-control" id="date_start" value="{{ "01-".date("m-Y") }}"/>
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 dis-date" style="display: none;">
                  <label>Tanggal Akhir</label>
                  <div class="input-group date date-input">
                    <input type="text" class="form-control" id="date_finish" value="{{ date("t")."-".date("m-Y") }}"/>
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <table id="table-user" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="text-center">No. Booking</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Telp</th>
                  <th class="text-center">Total Jam</th>
                  <th class="text-center">Total Harga</th>
                  <th class="text-center">Tgl Booking</th>
                  <th class="text-center">Status</th>
                  <th style="width:150px;">Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
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
    <script src="{{ asset("/assets/backend/vendors/moment/moment.min.js")}}"></script>
    <script src="{{ asset("/assets/backend/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js") }}"></script>
    <script type="text/javascript">
        $('.date-input').datetimepicker({ format : 'DD-MM-YYYY' });
        var oTable = $('#table-user').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("booking.datatable") }}',
                data: function (d) {
                    d.status = $('#status').val();
                    if($('#periode').val() == "selected"){
                      d.date_start = $('#date_start').val();
                      d.date_finish = $('#date_finish').val();
                    }
                }
            },
            columns: [
                {data: 'notrans', name: 'notrans', className: 'text-center'},
                {data: 'name', name: 'b.name', className: 'text-left'},
                {data: 'phone', name: 'b.phone', className: 'text-center'},
                {data: 'time_count', name: 'd.time_count', className: 'text-center'},
                {data: 'price', name: 'd.price', className: 'text-right'},
                {data: 'created_at', name: 'b.created_at', className: 'text-center'},
                {data: 'total_payment', name: 'py.total_payment', className: 'text-center'},
                {data: 'id', name: 'action', orderable: false, searchable: false, className: 'text-center'}
            ]
        });
        $('#status').on('change', function(){
          oTable.draw();
        });
        $('#periode').on('change',function(){
          if($(this).val() == "all"){
            $('.dis-date').hide();
          }else{
            $('.dis-date').show();
          }
          oTable.draw();
        });
        $('.date-input').on('dp.change', function(){
            oTable.draw();
        });
    </script>
@endsection