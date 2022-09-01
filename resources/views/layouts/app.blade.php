<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"> </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"> </script>

    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'>

    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #9C27B0;
            color: white;
            text-align: center;
        }

        body {
            background-color: #EDF7EF
        }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" data-value="dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link uk" data-value="unit">Unit Kerja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link kr" data-value="karyawan">Karyawan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link lg" data-value="logout">Logout</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {

        api_token = localStorage.getItem('api_token') == null ? null : localStorage.getItem('api_token');
        menu = localStorage.getItem('menu') == null ? null : localStorage.getItem('menu');

        if (api_token != null) {
            $(".uk").show();
                $(".kr").show();
                $(".lg").show();

            if (menu != null) {
                displayMenu = menu;
            } else {
                displayMenu = 'dashboard';
            }
        } else {
            $(".uk").hide();
                $(".kr").hide();
                $(".lg").hide();
            displayMenu = '/login';
        }

        $(".py-4").load(displayMenu);

        jQuery('body').on('click', '.nav-link', function(e) {

            menu = $(this).attr("data-value");
            link = $(this).attr('href');

            localStorage.removeItem("menu");

            if (menu == 'logout') {
                localStorage.removeItem("api_token");
                $(".uk").hide();
                $(".kr").hide();
                $(".lg").hide();
                $(".py-4").load('/login');
            } else {

                $.get('http://localhost:8000/menu/' + menu,

                    function(data, status) {
                        $(".py-4").load(data);
                        localStorage.setItem("menu", data);

                    });


            }

        });
    });
</script>