<header>

            <!-- *** TOP ***
_________________________________________________________ -->
            <div id="top">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-5 contact">
                            <p class="hidden-sm hidden-xs">Hubungi kami di @if(count($phone) > 0) {{ $phone->value }} @endif @if(count($hp) > 0) / {{ $hp->value }} @endif @if(count($email)>0) atau {{ $email->value }} @endif</p>
                            <p class="hidden-md hidden-lg"><a href="#" data-animate-hover="pulse"><i class="fa fa-phone"></i></a>  <a href="#" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                            </p>
                        </div>
                        <div class="col-xs-7">
                            <div class="social">
                                <a href="@if(count($facebook) > 0) {{ $facebook->value }} @endif" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                                <a href="@if(count($instagram) > 0) {{ $instagram->value }} @endif" class="external instagram" data-animate-hover="pulse"><i class="fa fa-instagram"></i></a>
                                <a href="@if(count($twitter) > 0) {{ $twitter->value }} @endif" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                                <a href="@if(count($email) > 0) {{ $email->value }} @endif" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                            </div>

                            <div class="login">
                                @if(!Auth::check() or Auth::user()->role != 'member')
                                <a href="{{ route('front.login') }}"><i class="fa fa-sign-in"></i> <span class="hidden-xs text-uppercase">Login</span></a>
                                <a href="{{ route('front.register') }}"><i class="fa fa-user"></i> <span class="hidden-xs text-uppercase">Daftar</span></a>
                                @endif
                                @if(Auth::check() and Auth::user()->role == 'member')
                                <a href="{{ route('front.order') }}"><i class="fa fa-user"></i> <span class="hidden-xs text-uppercase">{{ Auth::user()->username }}</span></a>
                                <a href="{{ route('front.logout') }}"><i class="fa fa-sign-in"></i> <span class="hidden-xs text-uppercase">Logout</span></a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- *** TOP END *** -->

            <!-- *** NAVBAR ***
    _________________________________________________________ -->

            <div class="navbar-affixed-top" data-spy="affix" data-offset-top="200">

                <div class="navbar navbar-default yamm" role="navigation" id="navbar">

                    <div class="container">
                        <div class="navbar-header">

                    
                                  <h1> SPORT HILL FUTSAL BATAM</h1>
                              
                            </a>
                            <div class="navbar-buttons">
                                <button type="button" class="navbar-toggle btn-template-main" data-toggle="collapse" data-target="#navigation">
                                    <span class="sr-only">Toggle navigation</span>
                                    <i class="fa fa-align-justify"></i>
                                </button>
                            </div>
                        </div>
                        <!--/.navbar-header -->

                        <div class="navbar-collapse collapse" id="navigation">

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="{{ route('front.home') }}">Home</a>
                                </li>
                                <li class="">
                                    <a href="{{ route('front.about') }}">Tentang Kami</a>
                                </li>
                                <li class="">
                                    <a href="{{ route('front.news') }}">Berita</a>
                                </li>
                                <li class="">
                                    <a href="{{ route('front.contact') }}">Kontak</a>
                                </li>
                            </ul>

                        </div>
                        <!--/.nav-collapse -->



                        <div class="collapse clearfix" id="search">

                            <form class="navbar-form" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <span class="input-group-btn">

                    <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button>

                </span>
                                </div>
                            </form>

                        </div>
                        <!--/.nav-collapse -->

                    </div>


                </div>
                <!-- /#navbar -->

            </div>

            <!-- *** NAVBAR END *** -->

        </header>