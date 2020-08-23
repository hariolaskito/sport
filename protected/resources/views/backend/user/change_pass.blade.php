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
            @if(session()->has('response_status'))
              <div class="alert @if(session('response_status') == '1') alert-success @else alert-danger @endif alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                  {{ session('response_message') }}
              </div>
            @endif
            <div class="row">
                {{ Form::open(array('route' => array('user.update_pass'), 'method' => 'post', 'id' => 'formpass', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'false')) }}
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-4 col-xs-12" for="first-name">Password Lama <span class="required">*</span>
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <input type="password" name="oldpass" class="form-control" minlength="6" value="" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-4 col-xs-12" for="first-name">Password Baru <span class="required">*</span>
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <input type="password" id="newpass" name="newpass" class="form-control" placeholder="Minimal 6 karakter" value="" minlength="6" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-4 col-xs-12" for="first-name">Konfirmasi Password Baru <span class="required">*</span>
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <input type="password" name="conpass" class="form-control" minlength="6" placeholder="Minimal 6 karakter" value="" data-parsley-equalto="#newpass" required>
                    </div>
                  </div>
                  <span>* Jika proses ubah password berhasil akan otomatis akan diarahkan menuju halaman login untuk masuk dengan password baru</span>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
                    <button type="submit" class="btn btn-success">Ubah Password</button>
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
<script src="{{ asset("/assets/vendors/parsleyjs/dist/parsley.min.js")}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset("/assets/vendors/moment/moment.min.js")}}"></script>
<script src="{{ asset("/assets/vendors/datepicker/daterangepicker.js")}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#formpass').parsley();
  });
</script>
@endsection