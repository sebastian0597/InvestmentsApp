@can(['admin.inicio','admin.solicitudes.index'])
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
            <!-- Page Sidebar Start-->
            @include('Admins/componentes/barra_lateral')

            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>SOLICITUDES</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    @include('Admins/componentes/enlance_navegacion')

                                    <li class="breadcrumb-item active">Módulo de solicitudes:</li>
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
                                    <h4>Solicitudes de usuarios y novedades </h4>
                                    <br>

                                    <div class="mb-3 row g-3">

                                        <div class="col-xl-5 col-sm-9">
                                            <div class="input-group">

                                                <input id="calendario" class="datepicker-here form-control digits"
                                                    type="date" data-language="en">
                                                <button class="btn btn-secondary" onclick="buscarSolicitudesFecha()"
                                                    type="submit">Buscar solicitudes</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body pt-0">

                                    <div class="col-xl-12 notification box-col-12">
                                        <div class="card">
                                            <div class="card-header card-no-border">
                                                <div class="header-top">
                                                    <h5 class="m-0">Lista de solicitudes de clientes</h5>

                                                </div>
                                            </div>
                                            <div id="card_body" class="card-body pt-0">
                                                <?php $aux = 0; ?>
                                                @foreach ($request as $item)
                                                    <div class="media card-box">
                                                        <div class="media-body">
                                                            <p>{{ $item['date'] }} <span>{{ $item['hour'] }}</span><span
                                                                    class="badge badge-secondary">{{ $item['status'] }}</span>
                                                            </p>
                                                            <h6>{{ $item['request_type'] }}</h6>
                                                            <span>{{ $item['short_desc'] }}</span>

                                                        </div>

                                                        <ul class="nav main-menu" role="tablist">
                                                            <li class="nav-item">
                                                                <button class="btn btn-primary btn-block btn-mail w-100"
                                                                    type="button" data-bs-toggle="modal"
                                                                    data-bs-target=".modalRquests_<?= $aux ?>">Responder</button>

                                                                <div class="modal fade modal-bookmark modalRquests_<?= $aux ?>"
                                                                    id="exampleModal" tabindex="-1" role="dialog"
                                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <!-- titulo de solicitud para responder-->
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    {{ $item['request_type'] }}</h5>
                                                                                <!-- boton de cerrar-->
                                                                                <button class="btn-close" type="button"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"> </button>
                                                                            </div>

                                                                            <div class="modal-body">
                                                                                <form class="form-bookmark needs-validation"
                                                                                    id="bookmark-form" novalidate="">
                                                                                    <div class="row">
                                                                                        <div class="media-body">
                                                                                            <div
                                                                                                class="mb-3 mt-0 col-md-12">
                                                                                                <h6>Nombres</h6>
                                                                                                <label>{{ $item['customer']['name'] }}
                                                                                                    {{ $item['customer']['last_name'] }}</label>
                                                                                                <h6>N° Identificación</h6>
                                                                                                <label>{{ $item['customer']['document_number'] }}</label>
                                                                                            </div>
                                                                                            <div class="mb-3 mt-0 col-md-6">
                                                                                                <h6>Tipo cliente</h6>
                                                                                                <label>{{ $item['customer']['customer_type'] }}</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="mb-3 mt-0 col-md-12">

                                                                                            <h5>Asunto de la solicitud</h5>

                                                                                            <span>{{ $item['description'] }}
                                                                                            </span>

                                                                                        </div>

                                                                                        <div class="mb-3 col-md-12 my-0">
                                                                                            <h6>Respuesta</h6>
                                                                                            <textarea class="form-control" id="respuesta_solicitud_<?= $aux ?>" autocomplete="off"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <input id="index_var" type="hidden"
                                                                                        value="6">
                                                                                    <button class="btn btn-secondary"
                                                                                        id="btn_responder"
                                                                                        onclick="responderSolicitud({{ $item['id'] }}, {{ $aux }})"
                                                                                        type="button">Enviar</button>
                                                                                    <button class="btn btn-primary"
                                                                                        type="button"
                                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <?php $aux++; ?>
                                                @endforeach
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
        @include('Admins.componentes.footer')
    </div>
    </div>
    @section('scripts')
        <script src="{{ asset('js/admin/solicitudes.js') }}" defer></script>
    @stop
@stop
@endcan