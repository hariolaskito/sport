@extends('frontend.template')

@section('css')
@endsection

@section('content')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1>Tentang Kami</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li>Tentang</li>
                </ul>

            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">

        <section>
            <div class="row">
                <div class="col-md-12">

                    <div class="heading">
                        <h2>Tentang @if(count($name) > 0) {{ $name->value }} @endif</h2>
                    </div>

                    @if(count($page_about) > 0) {!! $page_about->value !!} @endif

                </div>
            </div>
        </section>

    </div>
    <!-- /#contact.container -->

</div>
<!-- /#content -->
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