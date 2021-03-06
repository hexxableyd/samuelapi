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
        .easyPaginateNav a {padding:5px; font-size: large;}
        .easyPaginateNav a.current {font-weight:bold;text-decoration:underline;}

        #creatorContent{
            padding: 0 10% 0 10%;
        }
        .overlay{
            opacity:0.8;
            background-color:#F9F9F9;
            position:fixed;
            width:100%;
            height:100%;
            top:0px;
            left:0px;
            z-index:1000;
        }

        table thead tr td{
            text-align:center;
            font-weight: bold;
        }
        table tbody tr td{
            text-align:center;
        }
    </style>
@endsection

@section('content')
<div id="result_page">
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <a href="{{ url('/linkifier') }}" class="logo">
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
                    <img class="img-sm" src="{{asset($creator['icon'])}}" alt="[[{{$type}} Icon]]">
                    <small><a href="{{$url_link}}">{{$creator['permalink']}}</a></small>
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
                                        @if(!empty($creator['img-url']))
                                            <img class="img-responsive pad" src="{{$creator['img-url']}}" alt="Photo">
                                        @endif
                                        @if($type === 'youtube')
                                            <object data="http://www.youtube.com/embed/{{$creator['embed']}}"
                                                    style="height: 315pt; width: 100%;"></object>
                                            <button id="showButton" type="button" class="btn btn-lg btn-default" onclick="showDescription()">Show Description</button>
                                            <br>
                                        @endif
                                        <p id="creatorContent">{{$creator['content']}}</p>
                                        <span class="pull-right text-muted">{{$creator['upvote']}} likes - {{count($replies)}} comments</span>
                                    </div>
                                    <div>
                                        <div class="box-footer box-comments" id="easyPaginate">
                                            @foreach($replies as $reply)
                                                <section class="box-comment">
                                                    <img class="img-circle img-sm" src="{{asset('/img/ico/user.png')}}" alt="User Image">
                                                    <div class="comment-text">
                                                        <span class="username">
                                                            {{$reply['author']}}
                                                            <span class="text-muted pull-right">{{$reply['date']}}</span>
                                                        </span>
                                                        {{$reply['content']}}
                                                    </div>
                                                </section>
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
                        {{--  TEXT CLASSIFICATION  --}}
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-success" id="box-classification">
                                        <div class="box-header with-border">
                                            <div class="user-block text-center">
                                                <h3>Text Classification</h3>
                                            </div>
                                            <div class="box-tools">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="box-body" style="white-space: pre-line" id="text-classification">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>POSITIVE</td>
                                                        <td>NEUTRAL</td>
                                                        <td>NEGATIVE</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="classification-table-body">
                                                </tbody>
                                            </table>
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
</div>

<div id="loading_page" class="overlay">
    <div style="margin-top:10%" class="row">
        <div class="col-md-12">
            <img class="center-block" src="{{ asset('img/gif/gears.gif') }}">
        </div>
    </div>
    <div class="row">
        <div style="text-align:center" class="col-md-12">
            <h1>PLEASE WAIT . . . &nbsp;<span id="progress"></span></h1>
            <h2>SAMUEL is analyzing the sentiments now.</h2>
        </div>
    </div>
</div>

<div style="display:none" id="error_page" class="overlay">
    <div style="margin-top:5%" class="row">
        <div style="text-align:center" class="col-md-12">
            <img width="30%" class="center-block" src="{{ asset('img/robot-msg-error.png') }}">
            <h1>Something went wrong. Please try again.</h1>
            <br>
            <button onclick="goBack()" class="btn btn-success btn-lg"><b>Go Back To Linkifier</b></button>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{asset('/bower_components/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('/bower_components/morris.js/morris.min.js')}}"></script>
    <script src="{{asset('/js/jquery.easyPaginate.js')}}"></script>
    <script>
        $(function(){
            $('#box-polarity').boxWidget('toggle');
            $('#box-dashboard').boxWidget('toggle');
            $('#box-summary').boxWidget('toggle');
            $('#box-classification').boxWidget('toggle');
            var count = parseInt({{count($replies)}})/10;
            if( count < 10 )
            {
                count = 10;
            }
            else if( count > 30)
            {
                count /= 2;
            }
            $('#easyPaginate').easyPaginate({
                paginateElement: 'section',
                elementsPerPage: count,
                effect: 'default'
            });
        });

        @if($type === 'youtube')
            var showCounter = false;
            showDescription();
            function showDescription(){
                if(showCounter)
                {
                    $("#creatorContent").show();
                    $("#showButton").text('Hide Description');
                    showCounter = false;
                }
                else
                {
                    $("#creatorContent").hide();
                    $("#showButton").text('Show Description');
                    showCounter = true;
                }
            }
        @endif
        console.log("{{$corpus}}");
        var start_time = new Date().getTime();
        data = {
            'text':"{{$corpus}}",
            'query':"{{$creator['title']}}",
            'summary_length':8,
            'visualize': false,
            'dashboard_style': false
        };
        $.ajax({
            url: "{{ config('app.samuel_core') }}" + "?KEY={{ config('app.samuel_api_key') }}",
            type: 'POST',
            data: JSON.stringify(data),
            contentType:"application/json",
            success:function(samuel) {
                // REQUEST TIME
                var request_time = new Date().getTime() - start_time;
                $('#response-time').html("It took <b>"+(request_time/1000)+"<b> seconds to process your request.");

                console.log(samuel);

                // CORPUS SUMMARY
                $("#corpus-summary").html(samuel.summarized_text);
                $('#box-summary').boxWidget('toggle');
                
                // PERCENT SHIT
                $('#box-polarity').boxWidget('toggle');
                console.log(samuel);
                var varpositive = samuel.total_score.percentage.positive;
                var varnegative = samuel.total_score.percentage.negative;

                var totalPosNeg = varpositive + varnegative;
                var finalPos = ((varpositive/totalPosNeg)*100).toFixed(2);
                var finalNeg = ((varnegative/totalPosNeg)*100).toFixed(2);

                new Morris.Donut({
                    element: 'sales-chart',
                    resize: true,
                    colors: ["#12cc4a", "#cc1212", "#595959"],
                    data: [
                        {label: "Positive Percentage", value: finalPos},
                        {label: "Negative Percentage", value: finalNeg}
                    ],
                    hideHover: 'auto'
                });

                if(finalPos>finalNeg){
                    $("#corpus-polarity").html("&nbsp;"+finalPos+"&nbsp;%<i class='fa fa-smile-o' aria-hidden='true'></i> &nbsp;Positive").addClass("text text-success");
                }
                else{
                    $("#corpus-polarity").html("&nbsp;"+finalNeg+"&nbsp;%<i class='fa fa-frown-o' aria-hidden='true'></i> &nbsp;Negative").addClass("text text-danger");
                }

                // DASHBOARD
                $("#corpus-dashboard").html(samuel.dashboard);
                
                // TEXT CLASSIFICATION
                $('#box-classification').boxWidget('toggle');
                var classificationTable = "";
                for(var i = 0 ; i<samuel.score.length ; i++){
                    posDescriptors ="";
                    samuel.descriptors[i].pos.forEach(function(word) {
                        posDescriptors += word +", ";
                    });
                    neuDescriptors ="";
                    samuel.descriptors[i].neu.forEach(function(word) {
                        neuDescriptors += word +", ";
                    });
                    negDescriptors ="";
                    samuel.descriptors[i].neg.forEach(function(word) {
                        negDescriptors += word +", ";
                    });
                    
                    classificationTable += ""
                    +"<tr>"
                    +"<td><b>"+samuel.score[i].pos.toFixed(2)+"</b><br>"+posDescriptors+"</td>"
                    +"<td><b>"+samuel.score[i].neu.toFixed(2)+"</b><br>"+neuDescriptors+"</td>"
                    +"<td><b>"+samuel.score[i].neg.toFixed(2)+"</b><br>"+negDescriptors+"</td>"
                    +"</tr>";
                }
                $("#classification-table-body").html(classificationTable)


                clearInterval(interval);
                $("#loading_page").fadeOut();
            },
            error: function(xmlhttprequest, textstatus, message) {
                clearInterval(interval);
                $("#loading_page").hide();
                $("#error_page").fadeIn();
            }
        });

        getProgress();
        var interval = setInterval(getProgress,1000);
        function getProgress(){
            $.ajax({
                url: "{{ config('app.samuel_core_progress') }}",
                success: function(progress){
                    console.log(progress);
                    $("#progress").text(progress+" %")
                }
            });
        }

        function goBack(){
            window.history.back();
        }
    </script>
@endsection