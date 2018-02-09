@extends('layouts.creative')

@section('css')
@endsection

@section('content')
    <header class="masthead text-center text-white d-flex">
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h1 class="text-uppercase">
                        <strong>SAMUEL API's very own LINKIFIER!</strong>
                    </h1>
                    <hr>
                </div>
                <div class="col-lg-8 mx-auto">
                    <p class="text-faded mb-5">With just a link of your favorite website, that is supported by our
                    linkifier of course, we will get all the sentiments and solve it so that you don't have to!</p>
                    <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
                </div>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-heading text-white">We've got everything that you need!</h2>
                    <hr class="light my-4">
                    <p class="text-faded mb-4">Samuel API's Linkifier has everything you need to make sense out of
                    a mess of a bag of statements. All we need is a link leading to the container of the website that
                    you want to pull statements from. After that, leave it to us! We will be back with the results, in a
                    jiffy!</p>
                    <a class="btn btn-light btn-xl js-scroll-trigger" href="#services">Get Started!</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Samuel API's Linkifier™</h2>
                    <hr class="my-4">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center" style="display: block;" id="linkify-div">
                    <form class="form-horizontal" id="link-url" method="POST" action="/linkify">
                        {{ csrf_field() }}
                        <br>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="linkifyurl" name="linkify-url" aria-describedby="urllink" placeholder="Enter website's URL">
                        </div>
                        <div class="form-check text-left">
                            <input type="checkbox" class="form-check-input" id="terms-conditions" name="terms-conditions" value=TRUE>
                            <label class="form-check-label" for="terms-conditions">I agree to Samuel API's terms and conditions.</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-xl">Linkify!</button>
                    </form>
                </div>
                <div class="col-md-12 text-center" style="display: none;" id="loading-div">
                    <br><br>
                    <img class="img-responsive" src="{{ asset("/img/ico/loading.gif") }}" alt="">
                    <h3>Please wait while we process your link.</h3>
                    <br><br>
                </div>
                <div class="col-md-12 text-center alert-danger" style="border-radius: 25px; display: none;" id="error-div">
                    <br><br>
                    <h3>Oops! There seems to be a problem. <span class="fa fa-warning"></span></h3>
                    <hr>
                    <h4 id="err-msg"></h4>
                    <button type="button" class="btn btn-danger btn-xl" onclick="tryAgain()">Try again!</button>
                    <br><br>
                </div>
                <div class="col-md-12 text-center alert-success" style="border-radius: 25px; display: none;" id="success-div">
                    <br><br>
                    <img id="success-img" class="img-responsive img-normalizer" src="{{asset("/img/ico/facebook.png")}}" style="height: 2cm" alt="Reddit Img">
                    <h3><span id="success-msg">It seems your link is a Reddit Link !</span> <span class="fa fa-check"></span></h3>
                    <hr>
                    <h4>Everything is ready! We would just like you to click the button below to process to a page containing all
                    the things we found from the link you gave. Thank you.</h4>
                    <form class="form-horizontal" id="link-data" method="POST" action="/linkifier/result">
                        {{ csrf_field() }}
                        <br>
                        <div class="form-group" style="display: none;">
                            <input type="text" name="url-data" id="url-data" class="">
                            <label for="url-data">URL DATA</label>
                        </div>
                        <button type="submit" class="btn btn-success btn-xl">Proceed!</button>
                    </form>
                    <br><br>
                </div>
            </div>
        </div>
    </section>

    <section class="p-0" id="portfolio">
        <div class="container-fluid p-0">
            <div class="row no-gutters popup-gallery">
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="{{asset('img/portfolio/fullsize/1.jpg')}}">
                        <img class="img-fluid" src="{{asset('img/portfolio/thumbnails/1.jpg')}}" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="{{asset('img/portfolio/fullsize/2.jpg')}}">
                        <img class="img-fluid" src="{{asset('img/portfolio/thumbnails/2.jpg')}}" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="{{asset('img/portfolio/fullsize/3.jpg')}}">
                        <img class="img-fluid" src="{{asset('img/portfolio/thumbnails/3.jpg')}}" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="{{asset('img/portfolio/fullsize/4.jpg')}}">
                        <img class="img-fluid" src="{{asset('img/portfolio/thumbnails/4.jpg')}}" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="{{asset('img/portfolio/fullsize/5.jpg')}}">
                        <img class="img-fluid" src="{{asset('img/portfolio/thumbnails/5.jpg')}}" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="{{asset('img/portfolio/fullsize/6.jpg')}}">
                        <img class="img-fluid" src="{{asset('img/portfolio/thumbnails/6.jpg')}}" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-dark text-white">
        <div class="container text-center">
            <h2 class="mb-4">Free Download at Start Bootstrap!</h2>
            <a class="btn btn-light btn-xl sr-button" href="http://startbootstrap.com/template-overviews/creative/">Download Now!</a>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $( document ).ready(function() {
            $('#link-url').on('submit', function(e){
                e.preventDefault();
                hideAll();
                $('#loading-div').show("fast","swing");
                $.ajax({
                    url:"/linkify",
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data) {
                        if(!data.success){
                            if(data.errors){
                                hideAll();
                                $('#error-div').show("fast","swing");
                                $("#err-msg").text(data.errors);
                            }
                        }else {
                            // console.log(data.object);
                            hideAll();
                            $('#success-div').show("fast","swing");
                            $('#success-msg').text(data.message);
                            if(data.website === 'reddit')
                            {
                                var link_data = {
                                    type: 'reddit',
                                    author: data.creator,
                                    replies: data.replies
                                };
                                // console.log(link_data);
                                console.log(data);
                                $('#url-data').val(JSON.stringify(link_data));
                                $("#success-img").attr("src","{{asset('/img/ico/reddit.svg')}}");
                            }
                            author = data.creator;
                            replies = data.replies;
                        }
                    }
                });
            });
        });
        function tryAgain() {
            hideAll();
            $('#linkify-div').show("fast","swing");
        }
        function hideAll() {
            $('#linkify-div').hide();
            $('#loading-div').hide();
            $('#error-div').hide();
            $('#success-div').hide();
        }
        function showResult() {
            console.log(author);
            console.log(replies);
        }
    </script>
@endsection