@extends('backend.template')

@section('css')
    <!-- Datatables -->
    <link href="{{ asset("/assets/backend/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("/assets/backend/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css") }}" rel="stylesheet">
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
            <a class="btn btn-primary" style="margin-bottom: 10px;" href="{{ route('article.create') }}"><i class="fa fa-plus-circle"></i> Tambah Artikel</a>
            <table id="table-article" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="text-center">Judul</th>
                  <th class="text-center">Author</th>
                  <th class="text-center">Dibuat Tanggal</th>
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
    <script type="text/javascript">
        $('#table-article').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("article.datatable") }}',
            columns: [
                {data: 'title', name: 'title'},
                {data: 'username', name: 'username', className: 'text-center'},
                {data: 'created_at', name: 'article.created_at', className: 'text-center'},
                {data: 'isactive', name: 'article.isactive', className: 'text-center'},
                {data: 'id', name: 'action', orderable: false, searchable: false, className: 'text-center'}
            ]
        });
    </script>
@endsection