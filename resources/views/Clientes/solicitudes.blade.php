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
                  <h3>Modulo de solicitudes</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       <i data-feather="home"></i></a></li>
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
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body"   >
                      <div class="vertical-scroll scroll-demo">
                          <div class="media" >
                      <div class="media-body">
                        <p>28-03-2022 <span></span><span class="badge badge-secondary">Enviado</span></p>
                        <h6>Retiro de capital</h6>
                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, </span>
                        
                      </div>
                        

                        <ul class="nav main-menu" role="tablist">
                            <li class="nav-item">
                              <button class="btn btn-primary btn-block btn-mail w-100" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Responder</button>

                              <div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <!-- titulo de solicitud para responder-->
                                      <h5 class="modal-title" id="exampleModalLabel">solicitud de verificación de saldo</h5>
                                      <!-- boton de cerrar-->
                                      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                                    </div>

                                    <div class="modal-body">
                                      <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                                        <div class="row">
                                          <div class="media-body">
                                            <div class="mb-3 mt-0 col-md-12">
                                              <h6>Nombre del cliente</h6>
                                              <label>Juan sebastian correa delgado</label>
                                              <h6>N° Identificación</h6>
                                              <label>1100970967</label>
                                            </div>
                                            <div class="mb-3 mt-0 col-md-6">
                                              <h6>Estatus</h6>
                                              <label>Vip</label>
                                            </div>
                                          </div>
                                          <div  class="mb-3 mt-0 col-md-12">
                                            
                                             <h5>Asunto de la solicitud</h5>
                            
                                             <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                             quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                             consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                             cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                             proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                             lorem
                                             </span>
                        
                                              </div>
                                          
                                          
                                      
                                          
                                          <div class="mb-3 col-md-12 my-0">
                                            <textarea class="form-control" required="" autocomplete="off">  </textarea>
                                          </div>
                                        </div>
                                        <input id="index_var" type="hidden" value="6">
                                        <button class="btn btn-secondary" id="Bookmark" onclick="submitBookMark()" type="submit">Enviar</button>
                                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            
                          </ul>
                          </div><hr>
                          <div class="media" >
                      <div class="media-body">
                        <p>28-03-2022 <span></span><span class="badge badge-secondary">Enviado</span></p>
                        <h6>Retiro de capital</h6>
                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, </span>
                        
                      </div>
                        

                        <ul class="nav main-menu" role="tablist">
                            <li class="nav-item">
                              <button class="btn btn-primary btn-block btn-mail w-100" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Responder</button>

                              <div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <!-- titulo de solicitud para responder-->
                                      <h5 class="modal-title" id="exampleModalLabel">solicitud de verificación de saldo</h5>
                                      <!-- boton de cerrar-->
                                      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                                    </div>

                                    <div class="modal-body">
                                      <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                                        <div class="row">
                                          <div class="media-body">
                                            <div class="mb-3 mt-0 col-md-12">
                                              <h6>Nombre del cliente</h6>
                                              <label>Juan sebastian correa delgado</label>
                                              <h6>N° Identificación</h6>
                                              <label>1100970967</label>
                                            </div>
                                            <div class="mb-3 mt-0 col-md-6">
                                              <h6>Estatus</h6>
                                              <label>Vip</label>
                                            </div>
                                          </div>
                                          <div  class="mb-3 mt-0 col-md-12">
                                            
                                             <h5>Asunto de la solicitud</h5>
                            
                                             <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                             quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                             consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                             cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                             proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                             lorem
                                             </span>
                        
                                              </div>
                                          
                                          
                                      
                                          
                                          <div class="mb-3 col-md-12 my-0">
                                            <textarea class="form-control" required="" autocomplete="off">  </textarea>
                                          </div>
                                        </div>
                                        <input id="index_var" type="hidden" value="6">
                                        <button class="btn btn-secondary" id="Bookmark" onclick="submitBookMark()" type="submit">Enviar</button>
                                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            
                          </ul>
                          </div><hr>
                          <div class="media" >
                      <div class="media-body">
                        <p>28-03-2022 <span></span><span class="badge badge-secondary">Enviado</span></p>
                        <h6>Retiro de capital</h6>
                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, </span>
                        
                      </div>
                        

                        <ul class="nav main-menu" role="tablist">
                            <li class="nav-item">
                              <button class="btn btn-primary btn-block btn-mail w-100" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Responder</button>

                              <div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <!-- titulo de solicitud para responder-->
                                      <h5 class="modal-title" id="exampleModalLabel">solicitud de verificación de saldo</h5>
                                      <!-- boton de cerrar-->
                                      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                                    </div>

                                    <div class="modal-body">
                                      <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                                        <div class="row">
                                          <div class="media-body">
                                            <div class="mb-3 mt-0 col-md-12">
                                              <h6>Nombre del cliente</h6>
                                              <label>Juan sebastian correa delgado</label>
                                              <h6>N° Identificación</h6>
                                              <label>1100970967</label>
                                            </div>
                                            <div class="mb-3 mt-0 col-md-6">
                                              <h6>Estatus</h6>
                                              <label>Vip</label>
                                            </div>
                                          </div>
                                          <div  class="mb-3 mt-0 col-md-12">
                                            
                                             <h5>Asunto de la solicitud</h5>
                            
                                             <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                             quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                             consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                             cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                             proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                             lorem
                                             </span>
                        
                                              </div>
                                          
                                          
                                      
                                          
                                          <div class="mb-3 col-md-12 my-0">
                                            <textarea class="form-control" required="" autocomplete="off">  </textarea>
                                          </div>
                                        </div>
                                        <input id="index_var" type="hidden" value="6">
                                        <button class="btn btn-secondary" id="Bookmark" onclick="submitBookMark()" type="submit">Enviar</button>
                                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            
                          </ul>
                          </div><hr>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-7">
                  <form class="card">
                    <div class="card-header">
                      <h4 class="card-title mb-0">Enviar solicitud</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        
  
                        <div class="col-md-5">
                          <div class="mb-3">
                            <label class="form-label">Tipo de Solicitud</label>
                            <select class="form-control btn-square">
                              <option value="0">--Select--</option>
                              <option value="1">Quejas y reclamos</option>
                              <option value="2">Inversiones</option>
                              <option value="3">Reinversiones</option>
                              <option value="4">Retiro Capital Parcial </option>
                              <option value="5">Retiro Capital Total  </option>
                              <option value="6">Preguntas </option>
                              <option value="7">Otra </option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div>
                            <label class="form-label">Descripción:</label>
                            <textarea   maxlength="250" class="form-control" rows="3" placeholder="Describe tu solicitud para ayudarte"></textarea>
                          </div>

                        </div>

                        <div class="mb-3"> 
                          <br>
                          <button class="btn btn-primary" type="submit">Enviar solitud</button>
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
