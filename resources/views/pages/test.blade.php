@extends('layouts.adminlte')

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
                {{--TODO: THIS IS FOR THE LINK OF THE LINKIFY--}}
                <img class="img-sm" src="{{asset('/img/ico/reddit.svg')}}" alt="Reddit.com">
                <small>/r/redditdev/comments/64m1hf/is_it_possible_to_get_all_reddit_comments/</small>
            </h1>
        </section>

        <section class="content">


            <div class="row">
                <div class="col-md-6">
                    <div class="box box-widget">
                        <div class="box-header with-border">
                            <div class="user-block">
                                <img class="img-circle" src="{{asset('/img/ico/user.png')}}" alt="User Image">
                                {{--TODO: DITO ILALAGAY YUNG USERNAME NG USER PATI YUNG LINK TO PROFILE--}}
                                <span class="username"><a href="">Username</a></span>
                                {{--TODO: DITO ILALAGAY YUNG DATE OF POSTING--}}
                                <span class="description">Shared publicly - 7:30 PM Today</span>
                            </div>
                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            {{--<img class="img-responsive pad" src="../dist/img/photo2.png" alt="Photo">--}}
                            <p>CONTENT</p>
                            {{--TODO: BILANG NG LIKES PATI COMMENTS--}}
                            <span class="pull-right text-muted">127 likes - 3 comments</span>
                        </div>
                        <div class="box-footer box-comments">
                            {{--TODO: FOR LOOP DITO NG COMMENT--}}
                            <div class="box-comment">
                                <img class="img-circle img-sm" src="{{asset('/img/ico/user.png')}}" alt="User Image">
                                <div class="comment-text">
                                  <span class="username">
                                    USERNAME
                                    <span class="text-muted pull-right">DATE</span>
                                  </span>
                                    COMMENT
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{--TODO: THIS IS WHERE YOU PUT THE LIKES/UPVOTES OF THE MAIN POST--}}
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Likes</span>
                            <span class="info-box-number">41,410</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                {{--TODO: THIS IS WHERE YOU PUT THE NUMBER OF COMMENTS ON THAT POST--}}
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Comments</span>
                            <span class="info-box-number">41,410</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>

        </section>

    </div>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>
</div>
@endsection