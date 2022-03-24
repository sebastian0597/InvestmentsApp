<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

    <link href="{{ asset('css/material-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/icofont.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/themify.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
    <!--<link id="color" rel="stylesheet" href="{{ asset('css/admin/color-1.css') }}" media="screen"> -->
    <link href="{{ asset('css/admin/responsive.css') }}" rel="stylesheet">

</head>

<body>
    <div>
        @yield('content')
    </div>
    @include('Admins.componentes.footer')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/admin/bootstrap/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/admin/icons/feather-icon/feather.min.js') }}" defer></script>
    <script src="{{ asset('js/admin/icons/feather-icon/feather-icon.js') }}" defer></script>
    <script src="{{ asset('js/admin/scrollbar/simplebar.js') }}" defer></script>
    <script src="{{ asset('js/admin/scrollbar/custom.js') }}" defer></script>
    <script src="{{ asset('js/admin/config.js') }}" defer></script>
    <script src="{{ asset('js/admin/sidebar-menu.js') }}" defer></script>
    <script src="{{ asset('js/admin/counter/jquery.waypoints.min.js') }}" defer></script>
    <script src="{{ asset('js/admin/counter/jquery.counterup.min.js') }}" defer></script>
    <script src="{{ asset('js/admin/counter/counter-custom.js') }}" defer></script>
    <script src="{{ asset('js/admin/datatable/datatables/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('js/admin/support-ticket-custom.js') }}" defer></script>
    <script src="{{ asset('js/admin/tooltip-init.js') }}" defer></script>
    <script src="{{ asset('js/admin/script.js') }}" defer></script>
   

</body>

</html>
