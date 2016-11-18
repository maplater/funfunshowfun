<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

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

    <script async src="//cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script>

</body>
</html>
