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
                {{ Form::open(array('route' => array('pitch.store'), 'method' => 'post', 'id' => 'formcategory', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'false')) }}
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-4 col-xs-12" for="first-name">Nama Lapangan <span class="required">*</span>
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <input type="text" name="name" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Deskripsi
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Status*</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div id="status" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="isactive" value="1" required> Aktif
                        </label>
                        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="isactive" value="0"> Non Aktif
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <table class="table table-stripped">
                      <thead>
                        <tr>
                          <th class="text-center">Jam</th>
                          <th class="text-center">Harga</th>
                        </tr>
                      </thead>
                      <tbody>
                        @for($i = 0; $i < 24; $i++)
                          <tr>
                            <td class="text-center">@if($i<10)0{{ $i }}@else{{ $i }}@endif:00</td>
                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">Rp</div>
                                <input type="number" name="price[]" min="0" class="form-control" value="0" required/>
                              </div>
                            </td>
                          </tr>
                        @endfor
                      </tbody>
                    </table>
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
    $('#formcategory').parsley();
  });
</script>
@endsection