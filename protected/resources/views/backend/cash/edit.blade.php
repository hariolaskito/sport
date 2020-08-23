@extends('backend.template')

@section('css')
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
                {{ Form::open(array('route' => array('cash.update', $cash->id), 'method' => 'patch', 'id' => 'formcategory', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'false')) }}
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal
                    </label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                      <input type="text" name="date" class="form-control" value="{{ date("d-m-Y",strtotime($cash->date)) }}" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Deskripsi
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <textarea name="description" class="form-control" rows="3">{{ $cash->description }}</textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Status*</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div id="status" class="btn-group" data-toggle="buttons">
                        <label title="pilih salah satu" class="btn btn-default @if($cash->amount >= 0) active @endif" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="type" value="1" @if($cash->amount >= 0) checked @endif required> Kas Masuk
                        </label>
                        <label title="pilih salah satu"class="btn btn-default @if($cash->amount < 0) active @endif" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="type" value="-1" @if($cash->amount < 0) checked @endif required> Kas Keluar
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Nominal
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="input-group">
                        <div class="input-group-addon">Rp</div>
                        <input type="text" name="amount" class="form-control" value="@if($cash->amount < 0) {{ ($cash->amount * (-1)) }} @else {{ $cash->amount }} @endif" required/>
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
<script src="{{ asset("/assets/backend/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js") }}"></script>
<script src="{{ asset("/assets/backend/build/js/autoNumeric.min.js")}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('input[name=amount]').autoNumeric('init', { mDec: '0', unSetOnSubmit: true});
    $('#formcash').parsley();
    $('input[name=date]').datetimepicker({ format : 'DD-MM-YYYY' });
  });
</script>
@endsection