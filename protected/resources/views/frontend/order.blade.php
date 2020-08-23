@extends('frontend.template')

@section('css')
@endsection

@section('content')

        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">

                            <li><a href="#">Home</a>
                            </li>
                            <li>{{ $title }}</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div id="content">
            <div class="container">


                <div class="row">

                    <!-- *** LEFT COLUMN ***
             _________________________________________________________ -->

                    <div class="col-md-12" id="customer-orders">

                        <div class="box">

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No. Booking</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Telp</th>
                                            <th class="text-center">Total Jam</th>
                                            <th class="text-center">Total Harga</th>
                                            <th class="text-center">Tgl Booking</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bookings as $booking)
                                            <tr>
                                                <td class="text-center">{{ $booking->notrans }}</td>
                                                <td class="text-center">{{ $booking->name }}</td>
                                                <td class="text-center">{{ $booking->phone }}</td>
                                                <td class="text-center">{{ $booking->time_count }} jam</td>
                                                <td class="text-right">Rp {{ number_format($booking->price) }}</td>
                                                <td class="text-center">{{ date("d F H:i",strtotime($booking->created_at)) }}</td>
                                                <td class="text-center">@if($booking->total_payment >= $booking->price) <span class="label label-success">Lunas</span> @else <span class="label label-warning">Belum Lunas</span> @endif</td>
                                                <td class="text-center"><a href="{{ route('front.detail_order',$booking->id) }}" class="btn btn-template-main"><i class="fa fa-info"></i> Detail</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $bookings->links() }}
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.col-md-9 -->

                    <!-- *** LEFT COLUMN END *** -->

                </div>


            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

@endsection

@section('javascript')
@endsection        
