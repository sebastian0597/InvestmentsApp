@can(['admin.inicio','admin.crear'])
@extends('layout')
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
    <div class="tap-top"></div>
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
                                <div style="display:flex; align-items:center; padding-right: 0px;" class="card-header">
                                    <div style="width:100%" class="row">
                                        <div class="col-6">
                                            <h5>Registro administradores</h5>
                                        </div>
                                        @can('admin.editar')
                                            <div class="col-6">
                                                <ol style="float:right;" class="breadcrumb">
                                                    <a onclick="consultarUsuariosAdmin()" class="btn btn-primary">Consultar usuarios</a>
                                                </ol>
                                            </div>
                                        @endcan
                                    </div> 
                                </div>
                                <div class="card-body">
                                    <div class="col-sm-12 shadow-box">
                                        <form class="needs-validation" id="form-admin">
                                      
                                            <h5>Datos</h5>
    
                                            <div class="row g-3">
                                                <div class="col-md-10">
                                                    <label class="form-label" >Nombre completo</label>
                                                    <input class="form-control" id="nombres" type="text" value="">
                                                </div>
    
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-md-5">
                                                    <label class="form-label">Correo</label>
                                                    <input onblur="validarSintaxisCorreo(this)" class="form-control" id="correo" type="email" value="">
                                                    <span class="msg_error_form" id="error_correo"></span>
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Rol</label>
                                                    <select class="form-select" id="rol">
                                                        <option value="">Seleccione---</option>
                                                      @foreach ($roles as $item)
                                                        <option value="{{$item['id']}}">{{$item['name']}}</option>
                                                      @endforeach
                                                    </select>
                                                </div>
                                            </div>
    
                                            <br>
                                            <button id="btn_crear_admin" onclick="crearAdmin()" class="btn btn-primary" type="button">Crear administrador</button>
                                            <br><br><br>
                                        </form>

                                        <div id="content-users">
                            
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    </div>
    <!-- footer start-->
    @include('Admins.componentes.footer')
    </div>
    </div>

@stop
@endcan
@cannot('admin.inicio', 'admin.crear')
    @include('errors.403')
@endcannot