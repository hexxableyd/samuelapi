@extends('layouts.adminlte')

@section('css')
    <link rel="stylesheet" href="{{asset('/bower_components/morris.js/morris.css')}}">
    <style>
        #ldavis_el70603330337764279074628 path {
            fill: none;
            stroke: none;
        }

        #ldavis_el70603330337764279074628 .xaxis .tick.major {
            fill: black;
            stroke: black;
            stroke-width: 0.1;
            opacity: 0.7;
        }

        #ldavis_el70603330337764279074628 .slideraxis {
            fill: black;
            stroke: black;
            stroke-width: 0.4;
            opacity: 1;
        }

        #ldavis_el70603330337764279074628 text {
            font-family: sans-serif;
            font-size: 11px;
        }

        #ldavis_el70603330337764279074628-top > div {
            margin: 0 0 0 -0.5% !important;
            width: 60% !important;
            position: relative;
            float: left !important;
            background-color: transparent !important;
        }
        /* IPython Notebook CSS to allow visualization to fit */
        /* I'm open to a better way of accomplishing this goal... */
        #ldavis_el70603330337764279074628 .container { width:100% !important; }
        /* This is for nbviewer's benefit since the above wasn't enough... */
        #ldavis_el70603330337764279074628 .output_area { width:100% !important; }
        #ldavis_el70603330337764279074628 svg { height: 1560px !important;}
        #ldavis_el70603330337764279074628-leftpanel {
            -ms-transform: translate(100px, 100px); /* IE 9 */
            -webkit-transform: translate(100px, 100px); /* Safari */
            transform: translate(100px , 100px);
        }
        #ldavis_el70603330337764279074628-bar-freqs {
            -ms-transform: translate(100px, 100px); /* IE 9 */
            -webkit-transform: translate(100px, 100px); /* Safari */
            transform: translate(100px , 780px);
        }
        #corpus-dashboard {
            height: 1590px !important;
        }
    </style>
@endsection

@section('content')
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <a href="/linkifier" class="logo">
                    <span class="logo-lg"><span class="fa fa-arrow-circle-left"></span> Return to <b>LINKIFY</b></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        @guest
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('login') }}">Login</a></li>
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link js-scroll-trigger" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="nav-link js-scroll-trigger" href="{{ url('/home') }}">Home</a>
                                    </li>
                                    <li>
                                        <a class="nav-link js-scroll-trigger" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <img class="img-sm" src="{{asset('/img/ico/reddit.svg')}}" alt="Reddit.com">
                    <small>{{$creator['permalink']}}</small>
                </h1>
            </section>
            <section class="content">
                <div class="row">
                    {{--FIRST COLUMN--}}
                    <div class="col-md-6">
                        {{--POST TREAD--}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-widget">
                                    <div class="box-header with-border">
                                        <div class="user-block">
                                            <img class="img-circle" src="{{asset('/img/ico/user.png')}}" alt="User Image">
                                            <span class="username"><a href="{{$creator['author-link']}}">{{$creator['author']}}</a></span>
                                            <span class="description">{{$creator['date']}}</span>
                                        </div>
                                        <div class="box-tools">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body" style="white-space: pre-line">
                                        <h3>{{$creator['title']}}</h3>
                                        <p>{{$creator['content']}}</p>
                                        <span class="pull-right text-muted">{{$creator['upvote']}} likes - {{count($replies)}} comments</span>
                                    </div>
                                    <div>
                                        <div class="box-footer box-comments" id="paginate">
                                            @foreach($replies as $reply)
                                                <div class="box-comment">
                                                    <img class="img-circle img-sm" src="{{asset('/img/ico/user.png')}}" alt="User Image">
                                                    <div class="comment-text">
                                                <span class="username">
                                                    {{$reply['author']}}
                                                    <span class="text-muted pull-right">{{$reply['date']}}</span>
                                                </span>
                                                        {{$reply['content']}}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--NUMBER OF LIKES / COMMENTS--}}
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="info-box bg-green">
                                    <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Likes</span>
                                        <span class="info-box-number">{{$creator['upvote']}}</span>

                                        <div class="progress">
                                            <div class="progress-bar" style="width: 100%"></div>
                                        </div>
                                        <span class="progress-description">

                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="info-box bg-red">
                                    <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Comments</span>
                                        <span class="info-box-number">{{count($replies)}}</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 100%"></div>
                                        </div>
                                        <span class="progress-description">
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--SECOND COLUMN--}}
                    <div class="col-md-6">
                        {{--SUMMARIZATION--}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-success" id="box-summary">
                                    <div class="box-header with-border">
                                        <div class="user-block text-center">
                                            <h3>Summary of "<i>{{$creator['title']}}</i>"</h3>
                                        </div>
                                        <div class="box-tools">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body" style="white-space: pre-line">
                                        <p id="corpus-summary"></p>
                                    </div>
                                    <div>
                                        <div class="box-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--POLARITY--}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-success" id="box-polarity">
                                    <div class="box-header with-border text-center">
                                        <h3 class="box-title">"{{$creator['title']}}" is <span id="corpus-polarity">Loading....</span></h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body chart-responsive">
                                        <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--DASHBOARD--}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-success" id="box-dashboard">
                                    <div class="box-header with-border">
                                        <div class="user-block text-center">
                                            <h3>Topical Chart</h3>
                                        </div>
                                        <div class="box-tools">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body" style="white-space: pre-line" id="corpus-dashboard">
                                    </div>
                                    <div>
                                        <div class="box-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs" id="response-time">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Admin LTE</a>.</strong> All rights
            reserved.
        </footer>
    </div>
@endsection

@section('js')
    <script src="{{asset('/bower_components/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('/bower_components/morris.js/morris.min.js')}}"></script>
    <script>
        {{--TODO:PAGINATE PUTANGINA !!!!!--}}
        $(document).ready(function(){
            $('#box-polarity').boxWidget('toggle');
            $('#box-dashboard').boxWidget('toggle');
            $('#box-summary').boxWidget('toggle');
        //     $('#paginate').pajinate({
        //         items_per_page : 5,
        //         item_container_id : '.alt_content',
        //         nav_panel_id : '.alt_page_navigation'
        //
        //     });
        });

    //   TODO: GG result ng samuel
        var Samuel = [];
        var start_time = new Date().getTime();
        $.ajax("http://192.168.1.14:63342/samuel_init?KEY=YOUR_API_KEY", {
            success: function(data) {
                console.log("{{$creator['title']}}");console.log("{{$corpus}}");
                Samuel = data;
                data = {
                    'text':"{{$corpus}}",
                    'summary_length':8,
                    'visualize': true,
                    'query': "{{$creator['title']}}",
                    'KEY':Samuel.KEY,
                    'verbose': true
                };
                $.ajax({
                    url: "http://192.168.1.14:63342/samuel_api",
                    type: 'POST',
                    data: JSON.stringify(data),
                    contentType:"application/json",
                    success:function(samuel) {
                        // console.log(samuel);

                        // REQUEST TIME
                        var request_time = new Date().getTime() - start_time;
                        $('#response-time').html("It took <b>"+(request_time/1000)+"<b> seconds to process your request.");
                        // console.log(request_time)1;

                        // CORPUS SUMMARY
                        $("#corpus-summary").html(samuel.summarized_text);
                        $('#box-summary').boxWidget('toggle');

                        // DASHBOARD
                        // console.log(samuel.dashboard);
                        $("#corpus-dashboard").html(samuel.dashboard);
                        // PERCENT SHIT
                        $('#box-polarity').boxWidget('toggle');
                        var varpositive = parseInt(samuel.percentage.positive.replace(/\D/g,''))/10.0;
                        var varnegative = parseInt(samuel.percentage.negative.replace(/\D/g,''))/10.0;
                        // TODO: SA NGAYON WALA PANG NEUTRAL
                        var varneutral = parseInt(samuel.percentage.neutral.replace(/\D/g,''))/10.0;
                        var donut = new Morris.Donut({
                            element: 'sales-chart',
                            resize: true,
                            colors: ["#12cc4a", "#cc1212", "#595959"],
                            data: [
                                {label: "Positive Percentage", value: varpositive},
                                {label: "Negative Percentage", value: varnegative}
                                // {label: "Neutral Percentage", value: varneutral}
                            ],
                            hideHover: 'auto'
                        });
                        if (samuel.polarity==="positive") {
                            $("#corpus-polarity").html("&nbsp;"+samuel.percentage.positive+"&nbsp;<i class='fa fa-smile-o' aria-hidden='true'></i> &nbsp;Positive").addClass("text text-success");
                        }
                        else if(samuel.polarity==="negative"){
                            $("#corpus-polarity").html("&nbsp;"+samuel.percentage.negative+"&nbsp;<i class='fa fa-frown-o' aria-hidden='true'></i> &nbsp;Negative").addClass("text text-danger");
                        }
                        else{
                            $("#corpus-polarity").html("&nbsp;"+samuel.percentage.neutral+"&nbsp;<i class='fa fa-meh-o' aria-hidden='true'></i> &nbsp;Neutral").addClass("text text-primary");
                        }
                    }
                });
            }
        });
    </script>
@endsection