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
        <div class="page-header">
            @include('Clientes/componentes/barra_superior')

        </div>
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('Clientes/componentes/barra_lateral')

            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>Perfil de usuario</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    @include(
                                        'Clientes/componentes/enlance_navegacion'
                                    )
                                    <li class="breadcrumb-item">Usuario</li>
                                    <li class="breadcrumb-item active"> Ver perfil</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="edit-profile">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                   
                                    <div class="card-body">
                                        <form>
                                            <div class="row mb-2">
                                                <div class="profile-title">
                                                    <div class="media"> <img class="img-70 rounded-circle" alt=""
                                                            src="../assets/images/profile.jpg">
                                                        <div class="media-body">
                                                            <!-- nombre del usuario-->
                                                            <h5 class="mb-1">{{mb_strtoupper($customer['name'].' '.$customer['last_name'])}}</h5>
                                                            <!-- Estado-->
                                                            <b><p>{{mb_strtoupper($customer['customer_type'])}}</p></b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Tipo de documento</label>
                                                <input disabled class="form-control" placeholder="{{$customer['document_type']}}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">N° Identificacion</label>
                                                <input disabled class="form-control" placeholder="{{$customer['document_number']}}">
                                            </div>
                                            
                                            <h5>Cuenta bancaria desembolso</h5>
                                            <div class="mb-3">
                                                <label class="form-label">{{$customer['name_bank_account']}}</label>
                                                <input disabled class="form-control" placeholder="{{$customer['bank_name']}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Tipo de cuenta</label>
                                                        <input disabled class="form-control" type="text" placeholder="{{$customer['account_type']}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">N° de cuenta</label>
                                                        <input disabled class="form-control" type="text"
                                                            placeholder="{{$customer['account_number']}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <form class="card">
                                   
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="mb-3">
                                                <label class="form-label">Celular</label>
                                                <input disabled class="form-control" placeholder="{{$customer['phone']}}">
                                            </div>

                                            
                                            <div class="mb-3">
                                                <label class="form-label">Correo</label>
                                                <input disabled class="form-control" placeholder="{{$customer['email']}}">
                                            </div>

                                            <div class="col-sm-6 col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Dirección</label>
                                                    <input disabled class="form-control" placeholder="{{$customer['address']}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Ciudad</label>
                                                    <input disabled class="form-control" placeholder="{{$customer['city']}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Departamento</label>
                                                    <input disabled class="form-control" placeholder="{{$customer['department']}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Pais</label>
                                                    <input disabled class="form-control" placeholder="{{$customer['country']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Actividad económica</label>
                                                    <input disabled class="form-control" placeholder="{{$customer['economic_activity']}}">
                                                </div>
                                            </div>

                                        </div>
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
