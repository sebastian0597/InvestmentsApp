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
                                    @include('Admins/componentes/enlance_navegacion') 
                                    <li class="breadcrumb-item active">Editar administrador</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <form class='form-bookmark needs-validation' id='bookmark-form' novalidate=''>
                                                        
                                <div class='form-row'>
                                    <div class='form-group col-md-6'>
                                        <label>Nombres</label>
                                        <input type='text' class='form-control' id='nombres' value='{{$admin["name"]}}'>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label>Email</label>
                                        <input type='email' class='form-control' id='correo'value='{{$admin["email"]}}'>
                                    </div>
                                </div>
                                <!--<div class='form-group col-md-6'>
                                    <label>Estado actual</label>
                                    <input disabled type='text' class='form-control' id='estado_actual_${aux}' value='${user.status}'>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label>Rol actual</label>
                                    <input disabled type='text' class='form-control' id='rol_actual_${aux}' value='${user.roles.role}' >
                                </div>-->
                                <div class='form-group col-md-6''>
                                    <label>Rol</label>
                                    <select class="form-select" id='rol'>
                                        <option value="" selected>Seleccione---</option>
                                        @foreach ($roles as $item)
                                            <option value="{{$item->id}}" {{ $item->id == $admin['id_rol'] ? 'selected' : '' }}>{{$item->rol}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class='form-group col-md-6'>
                                <label>Estado</label>
                                <select class="form-select" id='estado'>
                                    <option value="" selected>Seleccione---</option>
                                    <option value="1"  {{ $admin['ind_status'] == '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ $admin['ind_status'] == '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                                <br><br>
                            <button onclick="actualizarAdmin({{$admin['id']}})" type='button' class='btn btn-secondary'>Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->

        </div>
    </div>
  
@stop
