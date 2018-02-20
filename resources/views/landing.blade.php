@extends('layouts.rubino')

@section('content')

<header>
    <div id="leftHalf">
        <div class="intro">
            <h1 class="animated fadeInUp"><span style="color:#46d264">S A M U E</span></h1>
            <h2 class="animated fadeInUp">Sentiments are hard,</h2>
        </div>
    </div>
    <div id="rightHalf">
        <div class="intro">
            <h1 class="animated fadeInUp left"><span style="color:#FF4747">L</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A P I</h1>
            <h2 class="animated fadeInUp left">SAMUEL makes it easy</h2>
        </div>
    </div>
    <div id="scrollDown">
        <a href="#aboutMe" id="button" class="page-scroll">
            <i class="fa fa-angle-double-down"></i>
        </a>
    </div>
</header>

<div class="site-inner">
    <section id="aboutMe">
        <div class="container">
            <div class="row">
                <div class="center-block text-center">
                    <h2 class="sectionTitle pretty"><span>ONE API, TWO TARGETS</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 introduction">
                    <h3 class="introTitle text-center" style="color:#FF4747">NORMAL CONSUMERS</h3>
                    <p class="text-justify">
                        &nbsp;&nbsp;&nbsp;Comprehensive, easy-to-use, and utter bug-free! With just a
                        link from one of your favorite supported websites, SAMUEL API can parse and get only
                        the statements ( provided that it has one ) which will be the variables for
                        it to analyze. Simple than counting from 1 to 100!
                    </p>
                    <div class="containerIntro" style="margin-top:2em">
                        <h4 class="introSub">Supported Websites:</h4>
                        <ul class="list-inline text-center">
                            {{--TODO : INSTRUCTIONS--}}
                            <li class="icon-list-width">
                                <a href="#redditModal" class="my-work" data-toggle="modal">
                                    <img src="{{asset('img/ico/reddit.svg')}}" class="img-responsive icon-list img-normalizer" alt="Reddit">
                                </a>
                            </li>
                            <li class="icon-list-width">
                                <a href="#forumModal" class="my-work" data-toggle="modal">
                                    <img src="{{asset('img/ico/forum.png')}}" class="img-responsive icon-list img-normalizer" alt="Forums">
                                </a>
                            </li>
                            <li class="icon-list-width">
                                <a href="#twitterModal" class="my-work" data-toggle="modal">
                                    <img src="{{asset('img/ico/twitter.png')}}" class="img-responsive icon-list img-normalizer" alt="Twitter">
                                </a>
                            </li>
                            <li class="icon-list-width">
                                <a href="#youtubeModal" class="my-work" data-toggle="modal">
                                    <img src="{{asset('img/ico/youtube.png')}}" class="img-responsive icon-list img-normalizer" alt="Youtube">
                                </a>
                            </li>
                            <br>
                            <li>AND MORE! Click on the icon to see their respective usage instructions!</li>
                        </ul>
                    </div>
                    <a class="btn-danger btn center-block" href="{{url('/linkifier')}}">TRY IT NOW !</a>
                </div>
                <div class="col-md-2 midimage">
                    <img class="img-responsive hidden-sm img-normalizer" src="{{asset('img/mid-img.jpg')}}" alt="">
                    <div class="overlay"></div>
                </div>
                <div class="col-md-5 introduction">
                    <h3 class="introTitle text-center" style="color:#46d264">DEVELOPERS</h3>
                    <p class="text-justify">
                        &nbsp;&nbsp;&nbsp;Simple, modular, and modifiable to your heart's content!
                        Can be used as a package if you don't want the tedious procedures of using
                        the modules one by one. And deconstructed out of the box for meticulous devs
                        out there that wants to customize every modules to fit their needs!
                    </p>
                    <div class="containerIntro" style="margin-top:2em">
                        <h4 class="introSub blue">Alpha Testing available today !</h4>
                        <p>&nbsp;&nbsp;&nbsp;Use our API for free today until production date! Free of charge, all we
                        will ask are feedbacks and performance notes!</p>
                        @guest
                            <a class="btn-success btn center-block" href="{{url('/register')}}">GET STARTED NOW</a>
                        @else
                            <a class="btn-success btn center-block" href="{{url('/home')}}">YOU ARE ALREADY LOGGED IN! CLICK TO GO HOME.</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section><!--About section end-->

    <!-- Skills section -->
    {{--<section class="skills">--}}
        {{--<div class="skills-content">--}}
            {{--<div class="container">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-lg-4 col-md-4 col-sm-6 text-center">--}}
						{{--<span class="fa-stack fa-lg">--}}
						  {{--<i class="fa fa-circle fa-stack-2x"></i>--}}
						  {{--<i class="fa fa-pencil fa-stack-1x"  style="color:#38a1d2"></i>--}}
						{{--</span>--}}
                        {{--<h3>Some skill</h3>--}}
                        {{--<p>And tell me you love me, come back and haunt me,--}}
                            {{--Oh and I rush to the start.--}}
                            {{--Running in circles, chasing tails,--}}
                            {{--And coming back as we are.--}}
                        {{--</p>--}}
                    {{--</div>--}}
                    {{--<div class="col-lg-4 col-md-4 col-sm-6 text-center">--}}
						{{--<span class="fa-stack fa-lg">--}}
						  {{--<i class="fa fa-circle fa-stack-2x"></i>--}}
						  {{--<i class="fa fa-code fa-stack-1x"  style="color:#38a1d2"></i>--}}
						{{--</span>--}}
                        {{--<h3>Some other skill</h3>--}}
                        {{--<p>Nobody said it was easy,--}}
                            {{--oh its such a shame for us to part.--}}
                            {{--Nobody said it was easy,--}}
                            {{--No-one ever said it would be so hard.--}}
                        {{--</p>--}}
                    {{--</div>--}}
                    {{--<div class="col-lg-4 col-md-4 col-sm-6 text-center">--}}
						{{--<span class="fa-stack fa-lg">--}}
						  {{--<i class="fa fa-circle fa-stack-2x"></i>--}}
						  {{--<i class="fa fa-camera fa-stack-1x"  style="color:#38a1d2"></i>--}}
						{{--</span>--}}
                        {{--<h3>Oh look, one more skill</h3>--}}
                        {{--<p>Now there's just the "ooh-ohh" part, so here's some lorem ipsum: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper euismod nisl eu rutrum.--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}

    <!--Contact section-->

    <!-- Contact section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="center-block text-center">
                    <h2 class="sectionTitle pretty"><span>Contact</span></h2>
                </div>
                <!--Contact form start-->
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-send">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4 col-sm-12 col-xs-12 text-center">
                    <div class="social-icons">
                        <a href="#" title="Facebook" target="_blank"><div class="social-icon" id="fb"></div></a>
                        <a href="#" title="Twitter" target="_blank"><div class="social-icon" id="twitter"></div></a>
                        <a href="#" title="Google+" target="_blank"><div class="social-icon" id="gp"></div></a>
                        <a href="#" title="LinkedIn" target="_blank"><div class="social-icon" id="linkedin"></div></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Quote section-->
    {{--<section class="quote">--}}
        {{--<div class="quote-content">--}}
            {{--<p>In the last 2 years, my life has completely changed.<br> I always think I am very lucky to have discovered my true talents.</p>--}}
        {{--</div>--}}
    {{--</section><!--Quote section end-->--}}


    {{--REDDIT MODAL--}}
    <div class="portfolio-modal modal fade" id="redditModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="modal-body">
                                <h2 class="red">Reddit</h2>
                                <p class="item-intro text-muted">Usage instruction and guide:</p>

                                <ol class="text-left">
                                    <li>
                                        <p>Find your subreddit post.</p>
                                        <img src="{{asset('img/instructions/reddit_instruction_1.png')}}" class="img-responsive img-normalizer" alt="Reddit Link">
                                    </li>
                                    <li>
                                        <p>Enter your subreddit post's link then the number of samples to be taken, tick agree to terms and conditions then click "Linkify!".</p>
                                        <img src="{{asset('img/instructions/reddit_instruction_2.png')}}" class="img-responsive img-normalizer" alt="Reddit Link to Linkify">
                                    </li>
                                    <li>
                                        <p>Wait your link to be processed.</p>
                                        <img src="{{asset('img/instructions/reddit_instruction_3.png')}}" class="img-responsive img-normalizer" alt="Processing">
                                    </li>
                                    <li>
                                        <p>Click the "PROCEED!" button</p>
                                        <img src="{{asset('img/instructions/reddit_instruction_4.png')}}" class="img-responsive img-normalizer" alt="Proceed">
                                    </li>
                                </ol>

                                <span class="btn-launch-red"><a href="{{url('/linkifier')}}" title="Linkify" target="_blank"><i class="fa fa-share-square-o"></i> Try it now!</a></span>
                                <span class="btn-close-red" data-dismiss="modal"><i class="fa fa-times"></i> Close</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--YOUTUBE MODAL--}}
    <div class="portfolio-modal modal fade" id="youtubeModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="modal-body">
                                <h2 class="red">YouTube</h2>
                                <p class="item-intro text-muted">Usage instruction and guide:</p>

                                <ol class="text-left">
                                    <li>
                                        <p>Pick the YouTube video that you want to "Linkify".</p>
                                        <img src="{{asset('img/instructions/youtube_instruction_1.png')}}" class="img-responsive img-normalizer" alt="Youtube Video">
                                    </li>
                                    <li>
                                        <p>Enter your YouTube video's URL then the number of samples to be taken, tick agree to terms and conditions then click "Linkify!".</p>
                                        <img src="{{asset('img/instructions/youtube_instruction_2.png')}}" class="img-responsive img-normalizer" alt="Youtube link to Linkify">
                                    </li>
                                    <li>
                                        <p>Wait your link to be processed.</p>
                                        <img src="{{asset('img/instructions/youtube_instruction_3.png')}}" class="img-responsive img-normalizer" alt="Processing">
                                    </li>
                                    <li>
                                        <p>Click the "PROCEED!" button</p>
                                        <img src="{{asset('img/instructions/youtube_instruction_4.png')}}" class="img-responsive img-normalizer" alt="Proceed">
                                    </li>
                                </ol>

                                <span class="btn-launch-red"><a href="{{url('/linkifier')}}" title="Linkify" target="_blank"><i class="fa fa-share-square-o"></i> Try it now!</a></span>
                                <span class="btn-close-red" data-dismiss="modal"><i class="fa fa-times"></i> Close</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--TWITTER MODAL--}}
    <div class="portfolio-modal modal fade" id="twitterModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="modal-body">
                                <h2 class="red">Twitter</h2>
                                <p class="item-intro text-muted">Usage instruction and guide:</p>

                                <ol class="text-left">
                                    <li>
                                        <p>Search on Twitter and copy the Link of what you've searched.</p>
                                        <img src="{{asset('img/instructions/twitter_instruction_1.png')}}" class="img-responsive img-normalizer" alt="Twitter Query">
                                    </li>
                                    <li>
                                        <p>Enter your Twitter searched query's URL then the number of samples to be taken, tick agree to terms and conditions then click "Linkify!".</p>
                                        <img src="{{asset('img/instructions/twitter_instruction_2.png')}}" class="img-responsive img-normalizer" alt="Twitter link to Linkify">
                                    </li>
                                    <li>
                                        <p>Wait your link to be processed.</p>
                                        <img src="{{asset('img/instructions/twitter_instruction_3.png')}}" class="img-responsive img-normalizer" alt="Processing">
                                    </li>
                                    <li>
                                        <p>Click the "PROCEED!" button</p>
                                        <img src="{{asset('img/instructions/twitter_instruction_4.png')}}" class="img-responsive img-normalizer" alt="Proceed">
                                    </li>
                                </ol>

                                <span class="btn-launch-red"><a href="{{url('/linkifier')}}" title="Linkify" target="_blank"><i class="fa fa-share-square-o"></i> Try it now!</a></span>
                                <span class="btn-close-red" data-dismiss="modal"><i class="fa fa-times"></i> Close</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--FORUM MODAL--}}
    <div class="portfolio-modal modal fade" id="forumModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="modal-body">
                                <h2 class="red">Forums</h2>
                                <p class="item-intro text-muted">Usage instruction and guide:</p>

                                <ol class="text-left">
                                    <li>
                                        <p>Pick a forum subject and copy the link of your selected forum.</p>
                                        <img src="{{asset('img/instructions/forum_instruction_1.png')}}" class="img-responsive img-normalizer" alt="Forum Pick">
                                    </li>
                                    <li>
                                        <p>Enter your Forum Discussion's URL then the number of samples to be taken, tick agree to terms and conditions then click "Linkify!".</p>
                                        <img src="{{asset('img/instructions/forum_instruction_2.png')}}" class="img-responsive img-normalizer" alt="Forum link to Linkify">
                                    </li>
                                    <li>
                                        <p>Wait your link to be processed.</p>
                                        <img src="{{asset('img/instructions/forum_instruction_3.png')}}" class="img-responsive img-normalizer" alt="Processing">
                                    </li>
                                    <li>
                                        <p>Click the "PROCEED!" button</p>
                                        <img src="{{asset('img/instructions/forum_instruction_4.png')}}" class="img-responsive img-normalizer" alt="Proceed">
                                    </li>
                                </ol>

                                <span class="btn-launch-red"><a href="{{url('/linkifier')}}" title="Linkify" target="_blank"><i class="fa fa-share-square-o"></i> Try it now!</a></span>
                                <span class="btn-close-red" data-dismiss="modal"><i class="fa fa-times"></i> Close</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2018 SAMUEL API - All rights reserved | Developed by SAMUEL API Team</p>
    </footer>

</div>
@endsection