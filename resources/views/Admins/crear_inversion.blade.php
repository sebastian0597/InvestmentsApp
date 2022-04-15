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

            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>INVERSIONES</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    @include('Admins/componentes/enlance_navegacion')
                                    <li class="breadcrumb-item active">Crear inversion</li>
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
                                    <h5>Formulario para crear inversión</h5>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" novalidate="" accept-charset="UTF-8" enctype="multipart/form-data">
                                       
                                        <input type="hidden" id="id_cliente" value="{{$customer['id']}}">
                                        <input type="hidden" id="nombre_cliente" value="{{$customer['name']}} {{$customer['last_name']}}">
                                        <input type="hidden" id="email_cliente" value="{{$customer['email']}}">
                                        <h4>Inversión</h4>
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Tipo de moneda</label>
                                                <select class="form-select" onchange="validarMontoMinimo();" id="tipo_moneda">
                                                    <option value="">Seleccione---</option>
                                                    @foreach ($currencies as $item)
                                                        <option value="{{ $item->code }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_tipo_moneda"></span>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Método de pago</label>
                                                <select class="form-select" id="metodo_pago" >
                                                    @foreach ($payment_methods as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_metodo_pago"></span>
                                            </div>

                                            <div class="col-md-3">
                                               
                                                <label>Monto de inversión</label>
                                                <input id="base_monto_inversion" onblur="validarMontoMinimo()" onkeyup="convertirAformatoMoneda(this)"  class="form-control" type="text">
                                                <span class="msg_error_form" id="error_base_monto_inversion"></span>
                                            
                                            </div>

                                            <div class="col-md-3">
                                                <label>Inversión en pesos</label>
                                                <input disabled id="monto_inversion" class="form-control" type="text">
                                                <span class="msg_error_form" id="error_monto_inversion"></span>
                                                
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                        
                                            <div class="col-md-3">
                                                <label>Tipo de inversión</label>
                                                <select class="form-select" id="tipo_inversion" >
                                                    @foreach ($investments_types as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_tipo_inversion"></span>
                                                
                                            </div>
                                            <div class="col-md-4">
                                                <label>Documento de consignación</label>
                                                <input class="form-control" id="archivo_consignacion" accept=".pdf, .png, .jpg, .jpeg" type="file">
                                                <span class="msg_error_form" id="error_archivo_consignacion"></span>
                                                
                                            </div>
                                        </div>
                     
                                        <br><br>
                                        <div class="mb-4 placeholder-glow">
                                            <button class="btn btn-primary" id="btn_crear_inversion" type="button" onclick="crearInversion()">Crear Cliente</button>
                                        </div>
                                        <br>
                                </div>
                              

                            </div>

                            <!-- <div class="mb-3">
                                <div class="form-check">
                                    <div class="checkbox p-0">
                                        <input class="form-check-input" id="invalidCheck" type="checkbox" >
                                        <label class="form-check-label" for="invalidCheck"></label>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div> -->
                           
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
@stop
