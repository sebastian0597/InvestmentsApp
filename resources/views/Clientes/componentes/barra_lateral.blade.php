<div class="sidebar-wrapper">
    <div>
      <div class="logo-wrapper"><a href="">VIP WORLD TRADING</a>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        
      </div>
      <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="../assets/images/logo/logo-icon.png" alt=""></a></div>
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn"><a href="index.html"><img class="img-fluid" src="../assets/images/logo/logo-icon.png" alt=""></a>
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            
            <li class="sidebar-list"><a class="sidebar-link sidebar-title  {{ Request::is('cliente/perfil') ? 'cambio' : '' }}" href="{{url('cliente/perfil')}}"><i data-feather="user"></i><span>PERFIL</span></a>
            </li>
            <li class="sidebar-list"><a class="sidebar-link sidebar-title  {{ Request::is('cliente/inversiones') ? 'cambio' : '' }}" href="{{url('cliente/inversiones')}}"><i data-feather="check-square"></i><span>MÓDULO INVERSIÓN</span></a>
            </li>
            <li class="sidebar-list"><a class="sidebar-link sidebar-title  {{ Request::is('cliente/documentos') ? 'cambio' : '' }}" href="{{url('cliente/documentos')}}"><i data-feather="check-square"></i><span>MÓDULO DOCUMENTOS</span></a>
            </li>
            <li class="sidebar-list"><a class="sidebar-link sidebar-title  {{ Request::is('cliente/extractos') ? 'cambio' : '' }}" href="{{url('cliente/extractos')}}"><i data-feather="briefcase"></i><span>MÓDULO EXTRACTOS</span></a>
            </li>
             <li class="sidebar-list"><a class="sidebar-link sidebar-title {{ Request::is('cliente/desembolsos') ? 'cambio' : '' }}" href="{{url('cliente/desembolsos')}}"><i data-feather="dollar-sign"></i><span>MÓDULO DESEMBOLSOS</span></a>
            </li>
            <li class="sidebar-list"><a class="sidebar-link sidebar-title  {{ Request::is('cliente/solicitudes') ? 'cambio' : '' }}" href="{{url('cliente/solicitudes')}}"><i data-feather="bell"></i><span>SOLICITUDES</span></a>

            </li>

             
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav> 
    </div>
  </div>