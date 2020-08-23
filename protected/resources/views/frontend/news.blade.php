@extends('frontend.template')

@section('css')
@endsection

@section('content')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Berita</h1>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li>Berita</li>
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

            <div class="col-md-12" id="blog-listing-big">
                @foreach($articles as $article)
                <section class="post">
                    <h2><a href="#">{{ $article->title }}</a></h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="author-category">By <a href="#">{{ $article->fullname }}</a> in <a href="#">{{ $article->name }}</a>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="date-comments">
                                <a href="#"><i class="fa fa-calendar-o"></i> {{ date("d F Y",strtotime($article->created_at)) }}</a>
                            </p>
                        </div>
                    </div>
                    <p class="intro">{!! $article->content !!}</p>
                </section>
                @endforeach

                {{ $articles->links() }}


            </div>
            <!-- /.col-md-9 -->

            <!-- *** LEFT COLUMN END *** -->

            <!-- *** RIGHT COLUMN ***
     _________________________________________________________ -->

        

            <!-- *** RIGHT COLUMN END *** -->

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
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