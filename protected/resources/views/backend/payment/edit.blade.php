@extends('backend.template')

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
            <div class="row">
                @if(count($errors) > 0)
                  <div class="alert alert-warning alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                      <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                  </div>
                @endif
                {{ Form::open(array('route' => array('payment.update', $payment->id), 'method' => 'patch', 'id' => 'formcategory', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'false')) }}
                  <div class="form-group">
                    <input type="hidden" name="booking_id" value="{{ $payment->booking_id }}">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal
                    </label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                      <div class="input-group">
                        <input type="text" name="date" class="form-control" value="{{ date('d-m-Y',strtotime($payment->date)) }}" required/>
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Pembayaran*</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div id="status" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default @if($payment->type == 'cash') active @endif" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="type" value="cash" @if($payment->type == 'cash') checked @endif required> Cash
                        </label>
                        <label class="btn btn-default @if($payment->type == 'transfer') active @endif" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="type" value="transfer" @if($payment->type == 'transfer') checked @endif required> Transfer
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Pembayar/Pemilik Rekening
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <input name="account_name" class="form-control" value="{{ $payment->account_name }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nominal
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="input-group">
                        <div class="input-group-addon">Rp</div>
                        <input type="text" name="amount" class="form-control" value="{{ $payment->amount }}" required/>
                      </div>
                    </div>
                  </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Submit</button>
                    <a type="button" class="btn btn-warning" href="{{ URL::previous() }}"><i class="fa fa-times-circle"></i> Cancel</a>
                  </div>
                </div>
              {{ Form::close() }}
              <style type="text/css">
                select.monthselect, select.yearselect{
                  color: #000;  
                }
              </style>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('javascript')
<!-- Parsley -->
<script src="{{ asset("/assets/backend/vendors/parsleyjs/dist/parsley.min.js")}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset("/assets/backend/vendors/moment/moment.min.js")}}"></script>
<script src="{{ asset("/assets/backend/vendors/datepicker/daterangepicker.js")}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#formuser').parsley();
      $('#birthdate').daterangepicker({
        locale: {
          format: 'YYYY-DD-MM'
        },
        showDropdowns: true,
        singleDatePicker: true,
        calender_style: "picker_1"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
  });
</script>
@endsection