@extends('Admins.layout')
@section('title', 'VIP WORLD TRADING')
@section('content')
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('Admins.componentes.barra_superior')
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('Admins/componentes/barra_lateral')
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>ADMINISTRADOR</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    @include(
                                        'Admins/componentes/enlance_navegacion'
                                    )

                                    <li class="breadcrumb-item active">Cambiar contraseña</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="ro w">
                        <div class="login-card">
                            <div class="login-main">
                                <form class="theme-form">
                                    <h4>Cambiar tu contraseña </h4>
                                    <br><br>
                                    <div class="col-md-12">
                                        <label>Ingrese Contraseña</label>
                                      
                                            <input onblur="ocultarContrasena(this)" onfocus="mostrarContrasena(this)" onkeydown="validarContrasena(this)" id="password_1" type="password" Class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <label>Verificación de contraseña</label>
                                        
                                            <input  onblur="ocultarContrasena(this)" onfocus="mostrarContrasena(this)" onkeydown="validarContrasena(this)" id="password_2" type="password" Class="form-control">
                                      
                                    </div>
                                    <br><br>
                                    <div class="form-group mb-0">

                                        <button onclick="cambiarContrasena()" class="btn btn-primary btn-block w-100" type="button">Cambiar contraseña
                                        </button>
                                    </div>

                                </form>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->

        </div>
    </div>
@stop
