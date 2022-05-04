<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/assets/img/daicon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/assets/img/daicon.png')}}">
    <title>
    Inventory Management System
  </title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/assets/css/signin.css')}}" rel="stylesheet">
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</head>
<body class="text-center">
    
    <main class="form-signin">

        @yield('content')
        
    </main>
    

</body>
</html>