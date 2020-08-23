       <!-- *** FOOTER ***
_________________________________________________________ -->

        <footer id="footer">
            <div class="container">
                <div class="col-md-3 col-sm-6">
                    <h4>Tentang Kami</h4>

                    <p>Kami Melayani penyewaan lapangan futsal,terpercaya dan nyaman tempatnya</p>

                    <hr>

                    <!--<h4>Join our monthly newsletter</h4>

                    <form>
                        <div class="input-group">

                            <input type="text" class="form-control">

                            <span class="input-group-btn">

                        <button class="btn btn-default" type="button"><i class="fa fa-send"></i></button>

                    </span>

                        </div>
                        <!-- /input-group -->
                    </form>

                    <hr class="hidden-md hidden-lg hidden-sm">

                </div>
                <!-- /.col-md-3 -->

                <div class="col-md-3 col-sm-6">

                    <h4>Berita</h4>

                    <div class="blog-entries">
                        @foreach($last_articles as $article)
                        <div class="item same-height-row clearfix">
                            <div class="name same-height-always">
                                <h5><a href="#">{{ $article->title }}</a></h5>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <hr class="hidden-md hidden-lg">

                </div>
                <!-- /.col-md-3 -->

                <div class="col-md-3 col-sm-6">

                    <h4>Hubungi Kami</h4>

                    <p><strong>@if(count($name) > 0) {{ $name->value }} @endif</strong>
                        <br>@if(count($address) > 0) {{ $address->value }} @endif
                        <br>@if(count($city) > 0) {{ $city->value }} @endif @if(count($zipcode) > 0) {{ $zipcode->value }} @endif
                        <strong>@if(count($state) > 0) {{ $state->value }} @endif</strong>
                    </p>

                    <a href="{{ route('front.contact') }}" class="btn btn-small btn-template-main">Ke Halaman Kontak</a>

                    <hr class="hidden-md hidden-lg hidden-sm">

                </div>
                <!-- /.col-md-3 -->



                <div class="col-md-3 col-sm-6">

                    <h4>Member Baru</h4>

                    <!--/<div class="photostream">
                        <div>
                            <a href="#">
                                <img src="{{ asset("/assets/front/img/detailsquare.jpg") }}" class="img-responsive" alt="#">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{{ asset("/assets/front/img/detailsquare2.jpg") }}" class="img-responsive" alt="#">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{{ asset("/assets/front/img/detailsquare3.jpg") }}" class="img-responsive" alt="#">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{{ asset("/assets/front/img/detailsquare3.jpg") }}" class="img-responsive" alt="#">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{{ asset("/assets/front/img/detailsquare2.jpg") }}" class="img-responsive" alt="#">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="{{ asset("/assets/front/img/detailsquare.jpg") }}" class="img-responsive" alt="#">
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /.col-md-3 -->
            </div>
            <!-- /.container -->
        </footer>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->

        <!-- *** COPYRIGHT ***
_________________________________________________________ -->

        <div id="copyright">
            <div class="container">
                <div class="col-md-12">
                    <p class="pull-left">&copy; {{ date("Y") }}. @if(count($name) > 0) {{ $name->value }} @endif</p>
                </div>
            </div>
        </div>
        <!-- /#copyright -->

        <!-- *** COPYRIGHT END *** -->