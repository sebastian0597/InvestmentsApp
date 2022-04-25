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

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/material-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/icofont.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/themify.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
    <!--<link id="color" rel="stylesheet" href="{{ asset('css/admin/color-1.css') }}" media="screen"> -->
    <link href="{{ asset('css/admin/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">   
    <link href="{{ asset('css/admin/tables.css') }}" rel="stylesheet">   
   
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.structure.css') }}" rel="stylesheet">   
    <link href="{{ asset('css/jquery-ui.theme.css') }}" rel="stylesheet">   
    <link href="{{ asset('css/date-picker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">-->

</head>

<body>
    <div>
        @yield('content')
    </div>
    @include('Admins.componentes.footer')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
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
    <script src="{{ asset('js/admin/clientes.js') }}" defer></script>  
    <script src="{{ asset('js/admin/admins.js') }}" defer></script>  
    <script src="{{ asset('js/admin/extractos.js') }}" defer></script>  
    <script src="{{ asset('js/admin/solicitudes.js') }}" defer></script>
    <script src="{{ asset('js/admin/inversiones.js') }}" defer></script>
    <script src="{{ asset('js/admin/kpis.js') }}" defer></script>
    <script src="{{ asset('js/util.js') }}" defer></script> 
    <script src="{{ asset('js/ajax.js') }}" defer></script> 
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    
    <script src="{{ asset('js/admin/datatable/datatables/jquery.tablesorter.min.js') }}" defer></script>
    <script src="{{ asset('js/admin/datatable/datatables/tablesort.min.js') }}" defer></script>
    <script src="{{ asset('js/admin/datatable/datatables/jquery.tablesorter.widgets.js') }}" defer></script>
    <script src="{{ asset('js/admin/datatable/datatables/jquery.tablesorter.pager.js') }}" defer></script>
    <script src="{{ asset('js/tables.js') }}" defer></script> 
    <script src="{{ asset('js/datepicker.js') }}" defer></script> 
    <script src="{{ asset('js/datepicker.en.js') }}" defer></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
</body>

</html>
