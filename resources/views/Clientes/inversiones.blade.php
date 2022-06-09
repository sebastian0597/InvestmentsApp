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
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
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
                  <h3>Módulo de inversiones</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    @include(
                      'Clientes/componentes/enlance_navegacion'
                   )
                    <li class="breadcrumb-item">Usuario</li>
                    <li class="breadcrumb-item active"> Inversiones</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="edit-profile">
              <div class="row">

                <div class="col-xl-12">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title mb-0">Listado de inversiones</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="table-responsive add-project p-4">
                      <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                          <tr>
                            <th>Tipo cliente</th>
                            <th>N° contrato</th>
                            <th>Fecha inversión inicial</th>
                            <th>Valor inversión inicial</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($investments as $item)
                            <tr>
                              <td><a class="text-inherit" >{{$item['customer']['customer_type']}}</a></td>
                              <td>P-{{$item['id']}}</td>
                              <td><span class="status-icon bg-success"></span>{{$item['investment_date']}}</td>
                              <td>${{$item['base_amount']}}</td>
                              <td class="text-end">
                                <a class="icon" href="javascript:void(0)"></a>
                                <!--<a class="btn btn-primary btn-sm" href="javascript:void(0)">
                                  <i class="fa fa-download"></i> Descargar Pagaré </a>
                                  <a class="icon" href="javascript:void(0)"></a>
                                  
                                    <a class="btn btn-success btn-sm" href="javascript:void(0)">
                                      <i class="fa fa-upload"></i>  Subir archivo </a> -->
                              </td>
                            </tr>
   
                            @endforeach
                                                    
                        </tbody>
                      </table>
                    </div>
                  </div>
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
@stop
@endcan
@cannot('cliente.inicio')
  @include('errors.403')
@endcannot