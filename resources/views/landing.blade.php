@extends('layouts.rubino')

@section('content')

<header>
    <!--Left half of the hero image-->
    <div id="leftHalf">
        <div class="intro">
            <h1 class="animated fadeInUp"><span style="color:#46d264">S A M U E</span></h1>
            <h2 class="animated fadeInUp">Sentiments are hard,</h2>
        </div>
    </div>

    <!--Right half of the hero image-->
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
    <!--end hero image-->
</header>

<!--Website content-->
<div class="site-inner">
    {{--CHECKPOINT--}}
    <!-- About section -->
    <section id="aboutMe">
        <div class="container">
            <div class="row">
                <div class="center-block text-center">
                    <h2 class="sectionTitle pretty"><span>ONE API, TWO TARGETS</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 introduction">
                    <h3 class="introTitle text-center" style="color:#FF4747">NON-DEVELOPERS</h3>
                    <p class="text-justify">
                        &nbsp;&nbsp;&nbsp;Comprehensive, easy-to-use, and utter bug-free! With just a
                        link from one of your favorite supported websites, SAMUEL API can parse and get only
                        the statements ( provided that it has one ) which will be the variables for
                        it to analyze. Simple than counting from 1 to 100!
                    </p>
                    <div class="containerIntro" style="margin-top:2em">
                        <h4 class="introSub">Supported Websites:</h4>
                        <ul class="list-inline text-center">
                            <li class="icon-list-width">
                                <img src="{{asset('img/ico/reddit.svg')}}" class="img-responsive icon-list img-normalizer" alt="Reddit">
                            </li>
                            <li class="icon-list-width">
                                <img src="{{asset('img/ico/facebook.png')}}" class="img-responsive icon-list img-normalizer" alt="Facebook">
                            </li>
                            <li class="icon-list-width">
                                <img src="{{asset('img/ico/twitter.png')}}" class="img-responsive icon-list img-normalizer" alt="Twitter">
                            </li>
                            <li class="icon-list-width">
                                <img src="{{asset('img/ico/youtube.png')}}" class="img-responsive icon-list img-normalizer" alt="Youtube">
                            </li>
                            <br>
                            <li>MORE COMING OUT SOON !</li>
                        </ul>
                    </div>
                    <a class="btn-danger btn center-block" href="/linkifier">TRY IT NOW !</a>
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
                            <a class="btn-success btn center-block" href="/register">GET STARTED NOW</a>
                        @else
                            <a class="btn-success btn center-block" href="/home">YOU ARE ALREADY LOGGED IN! CLICK TO GO HOME.</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section><!--About section end-->

    <!-- Skills section -->
    <section class="skills">
        <div class="skills-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 text-center">
						<span class="fa-stack fa-lg">
						  <i class="fa fa-circle fa-stack-2x"></i>
						  <i class="fa fa-pencil fa-stack-1x"  style="color:#38a1d2"></i>
						</span>
                        <h3>Some skill</h3>
                        <p>And tell me you love me, come back and haunt me,
                            Oh and I rush to the start.
                            Running in circles, chasing tails,
                            And coming back as we are.
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 text-center">
						<span class="fa-stack fa-lg">
						  <i class="fa fa-circle fa-stack-2x"></i>
						  <i class="fa fa-code fa-stack-1x"  style="color:#38a1d2"></i>
						</span>
                        <h3>Some other skill</h3>
                        <p>Nobody said it was easy,
                            oh its such a shame for us to part.
                            Nobody said it was easy,
                            No-one ever said it would be so hard.
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 text-center">
						<span class="fa-stack fa-lg">
						  <i class="fa fa-circle fa-stack-2x"></i>
						  <i class="fa fa-camera fa-stack-1x"  style="color:#38a1d2"></i>
						</span>
                        <h3>Oh look, one more skill</h3>
                        <p>Now there's just the "ooh-ohh" part, so here's some lorem ipsum: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper euismod nisl eu rutrum.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Work section-->
    <section id="work">
        <div class="container">
            <div class="row">
                <div class="center-block text-center">
                    <h2 class="sectionTitle pretty"><span>My work</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Work tiles start here -->
            <div class="col-lg-3 col-md-3 col-sm-6 work">
                <div class="work-image"></div>
                <div class="work-hover">
                    <div class="work-hover-title">
                        <h3>My awesome project</h3>
                        <div class="link-inner">
                            <a href="#" target="_blank"><div class="btn-hover"></div></a><!--Link to your work-->
                            <a href="#workModal1" class="my-work" data-toggle="modal"><div class="btn-more"></div></a><!--Link to modal-->
                        </div>
                    </div>
                </div>
                <img src="{{asset('img/work/5small.jpg')}}" class="img-responsive" alt="">
            </div><!-- work tile end -->
            <div class="col-lg-3 col-md-3 col-sm-6 work">
                <div class="work-image"></div>
                <div class="work-hover">
                    <div class="work-hover-title">
                        <h3>My awesome project</h3>
                        <div class="link-inner">
                            <a href="#" target="_blank"><div class="btn-hover"></div></a><!--Link to your work-->
                            <a href="#workModal2" class="my-work" data-toggle="modal"><div class="btn-more"></div></a><!--Link to modal-->
                        </div>
                    </div>
                </div>
                <img src="{{asset('img/work/6small.jpg')}}" class="img-responsive" alt="">
            </div><!-- work tile end -->
            <div class="col-lg-3 col-md-3 col-sm-6 work">
                <div class="work-image"></div>
                <div class="work-hover blue">
                    <div class="work-hover-title">
                        <h3>My awesome project</h3>
                        <div class="link-inner">
                            <a href="#" target="_blank"><div class="btn-hover"></div></a><!--Link to your work-->
                            <a href="#workModal3" class="my-work" data-toggle="modal"><div class="btn-more"></div></a><!--Link to modal-->
                        </div>
                    </div>
                </div>
                <img src="{{asset('img/work/1small.jpg')}}" class="img-responsive" alt="">
            </div><!-- work tile end -->
            <div class="col-lg-3 col-md-3 col-sm-6 work">
                <div class="work-image"></div>
                <div class="work-hover blue">
                    <div class="work-hover-title">
                        <h3>My awesome project</h3>
                        <div class="link-inner">
                            <a href="#" target="_blank"><div class="btn-hover"></div></a><!--Link to your work-->
                            <a href="#workModal4" class="my-work" data-toggle="modal"><div class="btn-more"></div></a><!--Link to modal-->
                        </div>
                    </div>
                </div>
                <img src="{{asset('img/work/2small.jpg')}}" class="img-responsive" alt="">
            </div><!-- work tile end -->
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 work">
                <div class="work-image"></div>
                <div class="work-hover">
                    <div class="work-hover-title">
                        <h3>My awesome project</h3>
                        <div class="link-inner">
                            <a href="#" target="_blank"><div class="btn-hover"></div></a><!--Link to your work-->
                            <a href="#workModal5" class="my-work" data-toggle="modal"><div class="btn-more"></div></a><!--Link to modal-->
                        </div>
                    </div>
                </div>
                <img src="{{asset('img/work/7small.jpg')}}" class="img-responsive" alt="">
            </div><!-- work tile end -->
            <div class="col-lg-3 col-md-3 col-sm-6 work">
                <div class="work-image"></div>
                <div class="work-hover">
                    <div class="work-hover-title">
                        <h3>My awesome project</h3>
                        <div class="link-inner">
                            <a href="#" target="_blank"><div class="btn-hover"></div></a><!--Link to your work-->
                            <a href="#workModal6" class="my-work" data-toggle="modal"><div class="btn-more"></div></a><!--Link to modal-->
                        </div>
                    </div>
                </div>
                <img src="{{asset('img/work/8small.jpg')}}" class="img-responsive" alt="">
            </div><!-- work tile end -->
            <div class="col-lg-3 col-md-3 col-sm-6 work">
                <div class="work-image"></div>
                <div class="work-hover blue">
                    <div class="work-hover-title">
                        <h3>My awesome project</h3>
                        <div class="link-inner">
                            <a href="#" target="_blank"><div class="btn-hover"></div></a><!--Link to your work-->
                            <a href="#workModal7" class="my-work" data-toggle="modal"><div class="btn-more"></div></a><!--Link to modal-->
                        </div>
                    </div>
                </div>
                <img src="{{asset('img/work/3small.jpg')}}" class="img-responsive" alt="">
            </div><!-- work tile end -->
            <div class="col-lg-3 col-md-3 col-sm-6 work">
                <div class="work-image"></div>
                <div class="work-hover blue">
                    <div class="work-hover-title">
                        <h3>My awesome project</h3>
                        <div class="link-inner">
                            <a href="#" target="_blank"><div class="btn-hover"></div></a><!--Link to your work-->
                            <a href="#workModal8" class="my-work" data-toggle="modal"><div class="btn-more"></div></a><!--Link to modal-->
                        </div>
                    </div>
                </div>
                <img src="{{asset('img/work/4small.jpg')}}" class="img-responsive" alt="">
            </div><!-- work tile end -->
        </div>
    </section>

    <!--Quote section-->
    <section class="quote">
        <div class="quote-content">
            <p>In the last 2 years, my life has completely changed.<br> I always think I am very lucky to have discovered my true talents.</p>
        </div>
    </section><!--Quote section end-->

    <!--Contact section-->
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

    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal modal fade" id="workModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <img class="img-responsive center-block" src="{{asset('img/work/5.jpg')}}" alt="your project">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <h2 class="red">Awesome project #1</h2>
                                <p class="item-intro text-muted">Just some lorem ipsum</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                                <span class="btn-launch-red"><a href="#" title="Launch website" target="_blank"><i class="fa fa-share-square-o"></i> Launch</a></span>
                                <span class="btn-close-red" data-dismiss="modal"><i class="fa fa-times"></i> Close</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal modal fade" id="workModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <img class="img-responsive center-block" src="{{asset('img/work/6.jpg')}}" alt="your project">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <h2 class="red">Awesome project #2</h2>
                                <p class="item-intro text-muted">Just some lorem ipsum</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                                <span class="btn-launch-red"><a href="#" title="Launch website" target="_blank"><i class="fa fa-share-square-o"></i> Launch</a></span>
                                <span class="btn-close-red" data-dismiss="modal"><i class="fa fa-times"></i> Close</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 3 -->
    <div class="portfolio-modal modal fade" id="workModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <img class="img-responsive center-block" src="{{asset('img/work/1.jpg')}}" alt="your project">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <h2 class="blue">Awesome project #3</h2>
                                <p class="item-intro text-muted">Photo credits: <a href="https://www.flickr.com/photos/brettprice/" target="_blank">Brett Price</a></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br/>
                                </p>
                                <span class="btn-launch-blue"><a href="#" title="Launch website" target="_blank"><i class="fa fa-share-square-o"></i> Launch</a></span>
                                <span class="btn-close-blue" data-dismiss="modal"><i class="fa fa-times"></i> Close</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 4 -->
    <div class="portfolio-modal modal fade" id="workModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <img class="img-responsive center-block" src="{{asset('img/work/2.jpg')}}" alt="your project">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <h2 class="blue">Awesome project #4</h2>
                                <p class="item-intro text-muted">Photo credits: <a href="https://www.flickr.com/photos/brettprice/" target="_blank">Brett Price</a></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                                <span class="btn-launch-blue"><a href="#" title="Launch website" target="_blank"><i class="fa fa-share-square-o"></i> Launch</a></span>
                                <span class="btn-close-blue" data-dismiss="modal"><i class="fa fa-times"></i> Close</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 5 -->
    <div class="portfolio-modal modal fade" id="workModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <img class="img-responsive center-block" src="{{asset('img/work/7.jpg')}}" alt="your project">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <h2 class="red">Awesome project #5</h2>
                                <p class="item-intro text-muted">Just some lorem ipsum</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                                <span class="btn-launch-red"><a href="#" title="Launch website" target="_blank"><i class="fa fa-share-square-o"></i> Launch</a></span>
                                <span class="btn-close-red" data-dismiss="modal"><i class="fa fa-times"></i> Close</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="workModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <img class="img-responsive center-block" src="{{asset('img/work/8.jpg')}}" alt="your project">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <h2 class="red">Awesome project #6</h2>
                                <p class="item-intro text-muted">Just some lorem ipsum</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                                <span class="btn-launch-red"><a href="#" title="Launch website" target="_blank"><i class="fa fa-share-square-o"></i> Launch</a></span>
                                <span class="btn-close-red" data-dismiss="modal"><i class="fa fa-times"></i> Close</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 7 -->
    <div class="portfolio-modal modal fade" id="workModal7" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <img class="img-responsive center-block" src="{{asset('img/work/3.jpg')}}" alt="your project">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <h2 class="blue">Awesome project #7</h2>
                                <p class="item-intro text-muted">Photo credits: <a href="https://www.flickr.com/photos/brettprice/" target="_blank">Brett Price</a></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                                <span class="btn-launch-blue"><a href="#" title="Launch website" target="_blank"><i class="fa fa-share-square-o"></i> Launch</a></span>
                                <span class="btn-close-blue" data-dismiss="modal"><i class="fa fa-times"></i> Close</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 8 -->
    <div class="portfolio-modal modal fade" id="workModal8" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <img class="img-responsive center-block" src="{{asset('img/work/4.jpg')}}" alt="your project">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="modal-body">
                                <h2 class="blue">Awesome project #8</h2>
                                <p class="item-intro text-muted">Photo credits: <a href="https://www.flickr.com/photos/brettprice/" target="_blank">Brett Price</a></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                                <span class="btn-launch-blue"><a href="#" title="Launch website" target="_blank"><i class="fa fa-share-square-o"></i> Launch</a></span>
                                <span class="btn-close-blue" data-dismiss="modal"><i class="fa fa-times"></i> Close</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2015 your name - All rights reserved | Developed by <a href="http://www.fasusthemes.net" target="_blank"><img src="{{asset('img/fsthemes.png')}}" alt="Fasus Themes"></a></p>
    </footer>

</div>
@endsection