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
                {{ Form::open(array('route' => array('article.store'), 'method' => 'post', 'id' => 'formarticle', 'class' => '', 'autocomplete' => 'false')) }}
                  <div class="form-group">
                    <label class="control-label" for="first-name">Judul <span class="required">*</span>
                    </label>
                    <div>
                      <input type="text" name="title" class="form-control" required>
                    </div>
                  </div>
				  <div class="form-group">
                    <div>
                      <textarea name="content" id="content" class="form-control"></textarea>
                    </div>
                  </div>
				  <div class="form-group">
                    <label class="control-label" for="first-name">Kategori <span class="required">*</span></label>
                    <div>
					  <select name="article_category_id" class="form-control" required>
					  <option value="">Pilih Kategori...</option>
                      @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
					  </select>
                    </div>
                  </div>
				          <div class="form-group">
                    <label class="control-label">Status*</label>
                    <div>
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
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12">
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
<script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#formarticle').parsley();
    CKEDITOR.replace('content');
  });
</script>
@endsection