@extends('frontend.template')

@section('css')
@endsection

@section('content')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1>Hubungi Kami</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li>Hubungi Kami</li>
                </ul>

            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container" id="contact">

        <section>

            <div class="row">
                <div class="col-md-12">
                    <section>
                        <div class="heading">
                            <h2>We are here to help you</h2>
                        </div>

                        <p class="lead">Hubungi customer service kami yang siap melayani anda selama 24 jam</p>
                    </section>
                </div>
            </div>

        </section>

        <section>

            <div class="row">
                <div class="col-md-4">
                    <div class="box-simple">
                        <div class="icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <h3>Alamat</h3>
                        <p>@if(count($address) > 0) {{ $address->value }} @endif
                            <br>@if(count($city) > 0) {{ $city->value }} @endif @if(count($zipcode) > 0) {{ $zipcode->value }} @endif
                            <br><strong>@if(count($state) > 0) {{ $state->value }} @endif</strong>
                        </p>
                    </div>
                    <!-- /.box-simple -->
                </div>


                <div class="col-md-4">

                    <div class="box-simple">
                        <div class="icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <h3>Call center</h3>
                        <strong>@if(count($phone) > 0) {{ $phone->value }} @endif / @if(count($hp) > 0) {{ $hp->value }} @endif</strong>
                    </div>
                    <!-- /.box-simple -->

                </div>

                <div class="col-md-4">

                    <div class="box-simple">
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <h3>Support Elektronik</h3>
                        <p class="text-muted">Kirimkan pesan ke email kami</p>
                        <ul class="list-style-none">
                            <li><strong><a href="mailto:">@if(count($email) > 0) {{ $email->value }} @endif</a></strong>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-simple -->
                </div>
            </div>

        </section>

        <section>

            <div class="row text-center">

                <div class="col-md-12">
                    <div class="heading">
                        <h2>Contact form</h2>
                    </div>
                </div>

                <div class="col-md-8 col-md-offset-2">
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" class="form-control" id="firstname">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" class="form-control" id="lastname">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" class="form-control" id="subject">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea id="message" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-template-main"><i class="fa fa-envelope-o"></i> Send message</button>

                            </div>
                        </div>
                        <!-- /.row -->
                    </form>



                </div>
            </div>
            <!-- /.row -->

        </section>


    </div>
    <!-- /#contact.container -->
</div>
<!-- /#content -->

<div id="map">

</div>
@endsection

@section('javascript')
@endsection

<!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+628117721882", // WhatsApp number
            call_to_action: "Message us", // Call to action
            position: "left", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->