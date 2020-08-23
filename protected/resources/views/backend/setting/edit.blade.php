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
                {{ Form::open(array('route' => array('setting.store'), 'method' => 'post', 'id' => 'formcategory', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'false', 'files'=> true )) }}
                  <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="active">
                        <a href="#general" aria-controls="general" role="tab" data-toggle="tab"><i class="fa fa-building-o"></i> Info Perusahaan</a>
                      </li>
                      <li role="presentation">
                        <a href="#socmed" aria-controls="socmed" role="tab" data-toggle="tab"><i class="fa fa-facebook"></i> Social Media</a>
                      </li>
                      <li role="presentation">
                        <a href="#about" aria-controls="about" role="tab" data-toggle="tab"><i class="fa fa-file"></i> About Page</a>
                      </li>
                      <li role="presentation">
                        <a href="#futsal" aria-controls="futsal" role="tab" data-toggle="tab"><i class="fa fa-soccer-ball-o"></i> Futsal</a>
                      </li>
                    </ul>
                  
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="general">
                        <div style="margin-top: 20px;">
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-4 col-xs-12" for="first-name">Nama Perusahaan <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="text" name="name" class="form-control" value="@if(count($name) > 0){{$name->value}}@endif" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Alamat Perusahaan
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <textarea name="address" class="form-control" rows="3">@if(count($address) > 0){{$address->value}}@endif</textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Kota
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="text" name="city" class="form-control" value="@if(count($city) > 0){{$city->value}}@endif" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Provinsi
                            </label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <input type="text" name="state" class="form-control" value="@if(count($state) > 0){{$state->value}}@endif" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Kode Pos
                            </label>
                            <div class="col-md-1 col-sm-1 col-xs-12">
                              <input type="text" name="zipcode" class="form-control" value="@if(count($zipcode) > 0){{$zipcode->value}}@endif" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">No. Telepon
                            </label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <input type="text" name="phone" class="form-control" value="@if(count($phone) > 0){{$phone->value}}@endif" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">No. Handphone
                            </label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <input type="text" name="hp" class="form-control" value="@if(count($hp) > 0){{$hp->value}}@endif" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Email
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="text" name="email" class="form-control" value="@if(count($email)){{$email->value}} @endif" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Logo Perusahaan
                            </label>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                              @if(count($image) > 0)
                                <img src="{{ asset('/assets/images') }}/{{$image->value}}" height="100" />
                              @else
                                <img src="assets/images/noimage.png" height="100" />
                              @endif
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="file" name="image" class="form-control"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="socmed">
                        <div style="margin-top: 20px;">
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-4 col-xs-12" for="first-name">Facebook<span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="text" name="facebook" class="form-control" value="@if(count($facebook) > 0){{$facebook->value}}@endif">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-4 col-xs-12" for="first-name">Twitter<span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="text" name="twitter" class="form-control" value="@if(count($twitter) > 0){{$twitter->value}}@endif">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-4 col-xs-12" for="first-name">Instagram<span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="text" name="instagram" class="form-control" value="@if(count($instagram) > 0){{$instagram->value}}@endif">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="about">
                        <div style="margin-top: 20px;">
                          <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <textarea name="page_about" id="page_about" class="form-control">@if(count($page_about) > 0) {{ $page_about->value }} @endif</textarea>
                            </div>
                          </div>
                        </div>  
                      </div>
                      <div role="tabpanel" class="tab-pane" id="futsal">
                        <div style="margin-top: 20px;">
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-4 col-xs-12" for="first-name">Minimal DP<span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="input-group">
                                <input type="number" min="0" max="100" name="mindp" class="form-control" value="@if(count($mindp) > 0){{$mindp->value}}@endif" required>
                                <div class="input-group-addon">%</div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-4 col-xs-12" for="first-name">Total bonus jam<span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="input-group">
                                <input type="number" min="1" name="hour_bonus" class="form-control" value="@if(count($hour_bonus) > 0){{$hour_bonus->value}}@endif" required>
                                <div class="input-group-addon">jam</div>
                              </div>
                            </div>
                          </div>
                        </div>  
                      </div>
                  </div>
                  
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan Perubahan</button>
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
<script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#page_about').parsley();
    CKEDITOR.replace('page_about');
  });
</script>
@endsection