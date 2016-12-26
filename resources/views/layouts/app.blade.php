<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Search & discover where your favorite kind of music is playing">
    <meta name="author" content="">

    <meta property="og:title" content="FunFunShowFun" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://funfunshowfun.com" />
    <meta property="og:image" content="{{url('/img/hero.png')}}" />
    <meta property="og:description" content="http://ia.media-imdb.com/images/rock.jpg" />

    <title>FunFunShowFun</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{url('/css/bootstrap.css')}}" type="text/css">
    <style type="text/css">
       body { background: #f7f7f7 } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
    </style>


    @yield('header')
</head>
<body id="page-top">


    @yield('content')


    <!-- jQuery -->
    <script src="{{url('/js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('/js/bootstrap.js')}}"></script>



</body>
</html>
