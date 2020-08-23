@extends('frontend.template')

@section('css')
<link href="{{ asset("/assets/front/css/owl.carousel.css") }}" rel="stylesheet">
<link href="{{ asset("/assets/front/css/owl.theme.css") }}" rel="stylesheet">
<link href="{{ asset("/assets/backend/vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") }}" rel="stylesheet">
@endsection

@section('content')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1>{{ $pitch->name }}</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb">
                    <li><a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li><a href="portfolio-2.html">Lapangan</a>
                    </li>
                    <li>{{ $pitch->name }}</li>
                </ul>

            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">

        <section>
            <div class="project owl-carousel">
                <div class="item">
                    <img src="{{ asset("/assets/front/img/main-slider1.jpg") }}" alt="" class="img-responsive">
                </div>
            </div>
            <!-- /.project owl-slider -->
        </section>

        <section>
            <div class="row portfolio-project">
                <div class="col-md-12">
                    <div class="heading">
                        <h3>Deskripsi Lapangan</h3>
                    </div>

                    {!! $pitch->description !!}

                </div>
            </div>
        </section>
        {{ Form::open(array('route' => array('front.checkout'), 'method' => 'post', 'id' => 'formcheckout', 'autocomplete' => 'false')) }}
        <section>
            <div class="row portfolio-project">
                <div class="col-md-12">
                    <div class="heading">
                        <h3>Jadwal Ketersediaan</h3>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="row" align="center" style="margin-bottom:15px;">
                                <div class="input-group" style="width:200px;">
                                    <input type="text" id="date" class="form-control" value="{{ date("d-m-Y") }}">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <table class="table table-stripped table-bordered" id="table-timesheet">
                                <thead>
                                    <tr>
                                        <th class="text-center">Waktu</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="row" align="center" style="margin-bottom:15px;">
                                <h5>List Booking</h5>
                            </div>
                            <table class="table table-stripped table-bordered" id="table-checkout">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:150px">Tanggal</th>
                                        <th class="text-center">Waktu</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section>
            <div class="row portfolio-project">
                <div class="col-md-12">
                    <div class="heading">
                        <h3>Informasi Pemesan</h3>
                    </div>

                    <div class="row">
                        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                            <input type="hidden" name="pitch_id" value="{{ $pitch->id }}"/>
                            <div class="form-group">
                                <span class="control-label">Nama Lengkap</span>
                                <input type="text" name="name" placeholder="Nama Lengkap" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <span class="control-label">No Telepon/HP</span>
                                <input type="text" name="phone" placeholder="No Telepon / HP" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-template-main"><i class="fa fa-cart"></i> Konfirmasi Booking</button>
                            </div>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr class="total">
                                            <td style="font-size:20px;">Total</td>
                                            <th style="font-size:20px;">Rp <span class="input-money" id="label-grand-total">0</span></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{ Form::close() }}
    </div>
    <!-- /.container -->


</div>
<!-- /#content -->
@endsection

@section('javascript')
<script src="{{ asset("/assets/front/js/owl.carousel.min.js") }}"></script>
<script src="{{ asset("/assets/backend/vendors/datatables.net/js/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("/assets/backend/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>
<script src="{{ asset("/assets/backend/vendors/moment/moment.min.js")}}"></script>
<script src="{{ asset("/assets/backend/vendors/moment/moment.min.js")}}"></script>
<script src="{{ asset("/assets/backend/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js") }}"></script>
<script src="{{ asset("/assets/backend/build/js/autoNumeric.min.js")}}"></script>
<script src="{{ asset("/assets/backend/build/js/autoNumeric.min.js")}}"></script>
<script src="{{ asset("/assets/backend/vendors/parsleyjs/dist/parsley.min.js")}}"></script>
<script type="text/javascript">
    var datatable = $('#table-timesheet').DataTable();
    function loadData(datenow){
        datatable = $('#table-timesheet').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            bPaginate: false,
            bLengthChange: false,
            bInfo: false,
            bDestroy: true,
            ajax: {
                url: "/webfutsal/pitch/timesheet/{{ $pitch->id }}/date/"+datenow,
                data: function (d) {
                    /*d.time_number = [];
                    $('#table-checkout').find('tbody').find('tr').each(function(index, el) {
                        if($(this).find('td').eq(0).text() == $('#date').val()){
                            d.time_number.push($(this).find('td').eq(1).text());
                        }    
                    });*/
                }
            },
            columns: [
                {data: 'time_number', name: 'time_number', className: 'text-center'},
                {
                    data: 'price', 
                    name: 'price', 
                    className: 'text-center', 
                    render: function ( data, type, row ) {
                        var html = "Rp <span class=''>"+row.price+"</span>";
                        return html;
                    }
                },
                {
                    data: 'user_id', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false, 
                    className: 'text-center', 
                    render: function ( data, type, row ) {
                        var ketemu = false;
                        $('#table-checkout').find('tbody').find('tr').each(function(index, el) {
                            //console.log($(this).find('td').eq(0).text()+" - "+$('#date').val()+" - "+$(this).find('td').eq(1).text()+" - "+row.time_number);
                            if($(this).find('td').eq(0).text() == $('#date').val() && $(this).find('td').eq(1).text() == row.time_number){
                                ketemu = true;
                            }    
                        });
                        var html = row.user_id;
                        if(ketemu){
                            html = "<button class='btn btn-success btn-xs btn-add' disabled='disabled'><i class='fa fa-plus-circle'></i> Pesan</button>";
                        }
                        return html;
                    }
                }
            ],
            initComplete: function( settings, json ) {
            }
        });
    }
    $(function(){
        //$('#formcheckout').parsley();
        loadData($('#date').val());
        $('.input-money').autoNumeric('init', { mDec: '0', unSetOnSubmit: true});
        $('#date').datetimepicker({ format : 'DD-MM-YYYY', minDate: "{{ date('Y-m-d') }}" });
        $("#date").on("dp.change", function (e) {
            datenow = $('#date').val();
            loadData($('#date').val());
        });

        $('#table-checkout').DataTable({
            searching: false,
            bPaginate: false,
            bLengthChange: false,
            bInfo: false
        });
        $('#table-timesheet').on('click','.btn-add', function(e){
            e.preventDefault();
            $('#table-checkout').DataTable().destroy();
            var content = "<tr>"+
                            "<td class='text-center'><input type='hidden' name='date[]' value='"+$('#date').val()+"'/>"+$('#date').val()+"</td>"+
                            "<td class='text-center'><input type='hidden' name='time_number[]' value='"+$(this).closest('tr').find('td').eq(0).text()+"'/>"+$(this).closest('tr').find('td').eq(0).text()+"</td>"+
                            "<td class='text-center'>Rp <span class='input-money'>"+$(this).closest('tr').find('td').eq(1).find('span').text().replace(',','')+"</span></td>"+
                            "<td class='text-center'><button class='btn btn-xs btn-danger btn-delete'><i class='fa fa-times-circle'></i> Hapus</button></td>"+
                          "</tr>";
            $('#table-checkout').find('tbody').append(content);
            $('#table-checkout').find('tbody').find('tr').last().find('.input-money').autoNumeric('init', { mDec: '0', unSetOnSubmit: true});              
            $('#table-checkout').DataTable({
                searching: false,
                bPaginate: false,
                bLengthChange: false,
                bInfo: false
            });   
            loadData($('#date').val());
            calculate();
        });
        $('#table-checkout').on('click','.btn-delete',function(e){
            e.preventDefault();
            $('#table-checkout').DataTable().destroy();
            $(this).closest('tr').remove();             
            $('#table-checkout').DataTable({
                searching: false,
                bPaginate: false,
                bLengthChange: false,
                bInfo: false
            });
            loadData($('#date').val());
            calculate();
        });
    });
    function calculate(){
        var total = 0;
        $('#table-checkout').find('tbody').find('.input-money').each(function(index, el) {
            total = parseFloat(total) + parseFloat($(this).autoNumeric('get'));
        });
        $('#label-grand-total').autoNumeric('set',total);
    }
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