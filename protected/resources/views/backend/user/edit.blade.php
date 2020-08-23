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
                {{ Form::open(array('route' => array('user.update', $user->id), 'method' => 'patch', 'id' => 'formuser', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'false')) }}
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Tipe User</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div id="role" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default @if($user->role == 'admin') active @endif" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="role" value="admin" required="" @if($user->role == 'admin') checked  @endif >Administrator
                        </label>
                        <label class="btn btn-default @if($user->role == 'agent') active @endif" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="role" value="agent" @if($user->role == 'agent') checked @endif> Agent
                        </label>
                        <label class="btn btn-default @if($user->role == 'member') active @endif" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="role" value="member" @if($user->role == 'member') checked @endif> Member
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-4 col-xs-12" for="first-name">Nama Lengkap <span class="required">*</span>
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <input type="text" name="fullname" class="form-control" value="{{ $user->fullname }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Username <span class="required">*</span></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <input class="form-control" type="text" name="username" placeholder="Min. 4 characters" data-parsley-minlength="4" data-parsley-trigger="keyup" value="{{ $user->username }}" readonly required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Email <span class="required">*</span></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <input class="form-control" type="email" name="email" placeholder="ex: example@admin.com" value="{{ $user->email }}" readonly required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">No. Telepon
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <input name="phone" class="form-control" placeholder="ex: 08564632xxx" type="text" value="{{ $user->phone }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Status
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div id="status" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default @if($user->isactive == '1') active @endif" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="isactive" value="1" @if($user->isactive == '1') checked @endif required> Aktif
                        </label>
                        <label class="btn btn-default @if($user->isactive == '0') active @endif" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="isactive" @if($user->isactive == '0') checked @endif value="0"> Non Aktif
                        </label>
                      </div>
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
<script src="{{ asset("/assets/vendors/parsleyjs/dist/parsley.min.js")}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset("/assets/vendors/moment/moment.min.js")}}"></script>
<script src="{{ asset("/assets/vendors/datepicker/daterangepicker.js")}}"></script>
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