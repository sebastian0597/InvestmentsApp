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
    <div class="tap-top"></i></div>
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
                                <h3>Módulo de solicitudes</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                  @include(
                                    'Clientes/componentes/enlance_navegacion'
                                 )

                                    <li class="breadcrumb-item">Usuario</li>
                                    <li class="breadcrumb-item active"> Solicitudes</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="edit-profile">
                        <div class="row">
                            <div class="col-xl-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Mis solicitudes</h4>
                                        <div class="card-options"><a class="card-options-collapse" href="#"
                                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                                class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                                    class="fe fe-x"></i></a></div>
                                    </div>
                                    <div class="card-body">
                                        <div class="vertical-scroll scroll-demo">
                                          <?php $aux = 0; ?>

                                          @foreach ($requests as $item)
                                              <?php 
                                                $badge_class = 'badge-primary';
                                                if($item['id_status'] == 2){
                                                  $badge_class = 'badge-secondary';
                                                }
                                              
                                              ?>
                                              <div class="media">
                                                  
                                                <div class="media-body">
                                                      <p>{{$item['date']}}<span></span><span
                                                              class="badge {{$badge_class}}">{{$item['status']}}</span></p>
                                                      <h6>{{$item['request_type']}}</h6>
                                                      <span>{{$item['short_desc']}}</span>
                                                      
                                                  </div>
                                                  
                                                  <ul class="nav main-menu" role="tablist">
                                                      <li class="nav-item">
                                                          <button class="btn btn-primary btn-block btn-mail w-100"
                                                              type="button" data-bs-toggle="modal"
                                                              data-bs-target=".modalRequests_<?= $aux ?>">Ver detalles
                                                          </button>

                                                          <div class="modal fade modal-bookmark modalRequests_<?= $aux; ?>" id="#exampleModal"
                                                              tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                              aria-hidden="true">
                                                              <div class="modal-dialog modal-lg" role="document">
                                                                  <div class="modal-content">
                                                                      <div class="modal-header">
                                                                          <!-- titulo de solicitud para responder-->
                                                                          <h5 class="modal-title" id="exampleModalLabel">
                                                                            {{$item['request_type']}}</h5>
                                                                          <!-- boton de cerrar-->
                                                                          <button class="btn-close" type="button"
                                                                              data-bs-dismiss="modal" aria-label="Close">
                                                                          </button>
                                                                      </div>

                                                                      <div class="modal-body">
                                                                          <form class="form-bookmark needs-validation"
                                                                              id="bookmark-form" novalidate="">
                                                                              <div class="row">
                                                                                  <div class="media-body">
                                                                                      <div class="mb-3 mt-0 col-md-12">
                                                                                          <h6>Nombre del cliente</h6>
                                                                                          <label>{{$item['customer']['name']}} {{$item['customer']['last_name']}}</label>
                                                                                          <h6>N° Identificación</h6>
                                                                                          <label>{{$item['customer']['document_number']}}</label>
                                                                                      </div>
                                                                                      <div class="mb-3 mt-0 col-md-6">
                                                                                          <h6>Estado de la solicitud</h6>
                                                                                          <label>{{$item['status']}}</label>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="mb-3 mt-0 col-md-12">

                                                                                      <h5>Asunto de la solicitud</h5>

                                                                                      <span>{{$item['description']}}</span>

                                                                                  </div>

                                                                                  <div class="mb-3 col-md-12 my-0">
                                                                                      <textarea disabled class="form-control" required="" autocomplete="off">{{$item['answer']}}</textarea>
                                                                                  </div>
                                                                              </div>
                                                                   
                                                                              <button class="btn btn-primary" type="button"
                                                                                  data-bs-dismiss="modal">Cancel</button>
                                                                          </form>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </li>

                                                  </ul>
                                              </div>
                                              <hr>
                                              <?php $aux++; ?>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7">
                                <form class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Enviar solicitud</h4>
                                        <div class="card-options"><a class="card-options-collapse" href="#"
                                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                                class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                                    class="fe fe-x"></i></a></div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">


                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label class="form-label">Tipo de solicitud</label>
                                                    <select id="tipo_solicitud" class="form-control">
                                                      <option value="">Seleccione--</option>
                                                      @foreach ($requests_types as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                      @endforeach
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div>
                                                    <label class="form-label">Descripción:</label>
                                                    <textarea id="descripcion_solicitud" maxlength="250" class="form-control" rows="3" placeholder="Describe tu solicitud para ayudarte"></textarea>
                                                </div>

                                            </div>

                                            <div class="mb-3">
                                                <br>
                                                <button onclick="registrarSolicitud()" class="btn btn-primary" type="button">Enviar solitud</button>
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

    </div>
@section('scripts')
  <script src="{{ asset('js/cliente/solicitudes.js') }}" defer></script>
@stop
@stop
@endcan