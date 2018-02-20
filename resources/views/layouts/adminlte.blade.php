<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('app.name','Samuel API')}} || {{$title}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('/bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('/dist/css/skins/_all-skins.min.css')}}">
    @yield('css')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
{{--IF LOGGED IN REMOVE LAYOUT-TOP-NAV--}}
<body class="hold-transition {{$creator['theme']}} layout-top-nav">
@yield('content')
<script src="{{asset('/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('/bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('/dist/js/demo.js')}}"></script>
@yield('js')
</body>
</html>
