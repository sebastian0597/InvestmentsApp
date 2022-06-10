@can('cliente.inicio')
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

                                                    <style>
                                                        .images-cards figure {
                                                            position: relative;
                                                        
                                                        
                                                        }

                                                        #Images .add-new-photo {
                                                            display: flex;
                                                            font-size: 50px;
                                                            cursor: pointer;
                                                            background-size: 50% 50%;
                                                            width: 70px;
                                                            height: 69px;
                                                            -moz-border-radius: 50%;
                                                            -webkit-border-radius: 50%;
                                                            border-radius: 50%;
                                                            border: 3px solid #555;
                                                            align-content: flex-end;
                                                            justify-content: space-around;
                                                            flex-wrap: wrap;
                                                            background-size: cover;
                                                            flex-direction: row;
                                                        }



                                                        #add-photo-container input {
                                                            display: none;
                                                        }

                                                        .img-perfil {
                                                            width: 100px !important;
                                                            height: 100px !important;
                                                        object-fit: cover;
                                                        }


                                                        .images-cards figure figcaption {
                                                            position: absolute;
                                                            top: 0;
                                                            left: 0;
                                                            display: flex;
                                                            width: 100px !important;
                                                            height: 100px !important;
                                                            border-radius: 50%;
                                                            align-items: center;
                                                            justify-content: center;
                                                            background: rgba(0, 0, 0, 0.4);
                                                            color: #ffffff;
                                                            font-size: 44px;
                                                            cursor: pointer;
                                                            
                                                            transition: 0.3s all ease;
                                                            -webkit-transition: 0.3s all ease;
                                                            -moz-transition: 0.3s all ease;
                                                            -ms-transition: 0.3s all ease;
                                                            -o-transition: 0.3s all ease;
                                                        }       

                                                        .mover{
                                                            margin-top: 40px;

                                                        }
                                                    </style>

                                                    



                                                    <div class="media"> 
                                                        <h5> Inserta tu foto de perfil</h5>
                                                    
                                                        <section id="Images" class="images-cards">

                                                            <form method="post" enctype="multipart/form-data">

                                                               <div class="row">
                                                                  <div class="row g-3">
                                                                     <!-- aqui la pinta-->
                                                                     <div class="col-md-3" class="img-perfil rounded-circle" id="add-photo-container">
                                                                        <span class="material-symbols-outlined"></span>
                                                                        <div class="add-new-photo first" id="add-photo">
                                                                            <span><i data-feather="camera"> Inserta tu foto de</i></span>
                                                                        </div>
                                                                        <input type="file" id="add-new-photo" name="images[]">
                                                                     </div>
                                                                     <!-- aqui esta el boton de guardar-->
                                                                     <div class="col-md-4">
                                                                        <span><i class="fa-regular fa-circle-xmark"></i></span>
                                                                        <a class="btn btn-success btn-sm mover" onclick="cargarFoto()">
                                                                        <i class="fa fa-save"></i></a>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </form>
                                                         </section>
                                                        <hr >   
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <!-- nombre del usuario-->
                                                <h5 class="mb-1">{{mb_strtoupper($customer['name'].' '.$customer['last_name'])}}</h5>
                                                <!-- Estado-->
                                                <b><p>{{mb_strtoupper($customer['customer_type'])}}</p></b>
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
            @include('Clientes.componentes.footer')
        </div>
    </div>
@section('scripts')
    <script src="{{ asset('js/cliente/cliente.js') }}" defer></script>
@stop
@stop
@endcan
@cannot('cliente.inicio')
    @include('errors.403')
@endcannot