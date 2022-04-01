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

                                    <li class="breadcrumb-item active">Perfil de administrador</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Registro de administrador </h4>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" id="form-admin">
                                      
                                        <h5>Datos</h5>

                                        <div class="row g-3">
                                            <div class="col-md-8">
                                                <label class="form-label" >Nombre completo</label>
                                                <input class="form-control" id="nombres" type="text" value="">
                                            </div>

                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Correo</label>
                                                <input class="form-control" id="correo" type="email" value="">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Rol</label>
                                                <select class="form-select" id="rol">
                                                    <option value="">Seleccione---</option>
                                                  @foreach ($roles as $item)
                                                    <option value="{{$item['id']}}">{{$item['rol']}}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <br>
                                        <button id="btn_crear_admin" onclick="crearAdmin()" class="btn btn-primary" type="button">Crear administrador</button>
                                        <br><br><br>

                                </div>

                            </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    </div>
    <!-- footer start-->

    </div>
    </div>

    </html>
@stop
