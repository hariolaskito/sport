<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>Administrator</h3>
    <ul class="nav side-menu">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-laptop"></i> Dashboard </a></li>
      @permission('user-*')
      <li><a><i class="fa fa-user"></i> User <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('user.index') }}">Data User</a></li>
          @permission('user-create')
          <li><a href="{{ route('user.create') }}">Tambah User</a></li>
          @endpermission
        </ul>
      </li>
      @endpermission
      @permission('article-*','category-*')
      <li><a><i class="fa fa-file-o"></i> Artikel <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          @permission('article-*')
          <li><a href="{{ route('article.index') }}">Data Artikel</a></li>
          @endpermission
          @permission('article-create')
          <li><a href="{{ route('article.create') }}">Tambah Artikel</a></li>
          @endpermission
          @permission('category-*')
          <li><a href="{{ route('article_category.index') }}">Kategori Artikel</a></li>
          @endpermission
        </ul>
      </li>
      @endpermission
      @permission('setting-edit')
      <li><a href="{{ route('setting.index') }}"><i class="fa fa-cog"></i> Setting Perusahaan </a></li>
      @endpermission
    </ul>
  </div>
  <div class="menu_section">
    <h3>Futsal Management</h3>
    <ul class="nav side-menu">
      <li><a><i class="fa fa-soccer-ball-o"></i> Lapangan <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('pitch.index') }}">Data Lapangan</a></li>
          <li><a href="{{ route('pitch.create') }}">Tambah Lapangan</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-sticky-note-o"></i> Booking<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('booking.index') }}">Data Transaksi Booking</a></li>
          <li><a href="{{ route('payment.index') }}">Validasi Pembayaran</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-money"></i> Kas<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('cash.index') }}">Data Transaksi</a></li>
          <li><a href="{{ route('cash.create') }}">Tambah Transaksi</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-file"></i> Report<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('report.payment') }}">Report Pembayaran</a></li>
          <li><a href="{{ route('report.laba') }}">Report Laba Rugi</a></li>
        </ul>
      </li>
      @permission('vehicle-*')
      <li><a><i class="fa fa-automobile"></i> Armada <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('vehicle.index') }}">Data Armada</a></li>
          @permission('vehicle-create')
          <li><a href="{{ route('vehicle.create') }}">Tambah Armada</a></li>
          @endpermission
        </ul>
      </li>
      @endpermission
      @permission('transtravel-*','route-*','trayek-*','schedule-*')
      <li><a><i class="fa fa-bus"></i> Travel Antar Kota <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          @permission('route-*')
          <li><a href="{{ route('route_map.index') }}">Route Map</a></li>
          @endpermission
          @permission('trayek-*')
          <li><a href="{{ route('trayek.index') }}">Trayek</a></li>
          @endpermission
          @permission('schedule-*')
          <li><a href="{{ route('schedule.index') }}">Jadwal</a></li>
          @endpermission
          @permission('transtravel-create')
          <li><a href="{{ route('trans_travel.create') }}">Buat Transaksi</a></li>
          @endpermission
          @permission('transtravel-report')
          <li><a href="{{ route('trans_travel.report') }}">Laporan Transaksi</a></li>
          @endpermission
        </ul>
      </li>
      @endpermission
      @permission('transrent-*','packrent-*')
      <li><a><i class="fa fa-subway"></i> Rental Mobil <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          @permission('packrent-*')
          <li><a href="{{ route('pack_rentcar.index') }}">Paket Rental</a></li>
          @endpermission
          @permission('transrent-create')
          <li><a href="{{ route('trans_rentcar.create') }}">Buat Transaksi</a></li>
          @endpermission
          @permission('transrent-report')
          <li><a href="{{ route('trans_rentcar.report') }}">Laporan Transaksi</a></li>
          @endpermission
        </ul>
      </li>
      @endpermission
    </ul>
  </div>

</div>
<!-- /sidebar menu -->