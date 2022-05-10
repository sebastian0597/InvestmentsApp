<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a href="">VIP WORLD TRADING</a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        </div>
    
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                   
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" ><i
                                data-feather="users"></i><span></span></a>
                    </li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title {{ Request::is('crear_administrador') ? 'cambio' : '' }}" href="{{url('crear_administrador')}}"><i
                        data-feather="user"></i><span>PERFIL ADMINISTRADOR</span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title  {{ Request::is('solicitudes') ? 'cambio' : '' }}" href="{{url('solicitudes')}}"><i
                                data-feather="bell"></i><span>MÓDULO SOLICITUDES</span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title {{ Request::is('clientes', 'crear_cliente','editar_cliente/*') ? 'cambio' : '' }}" href="{{url('clientes')}}"><i
                                data-feather="users"></i><span>MÓDULO CLIENTES</span></a>
                    </li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title {{ Request::is('inversiones', 'crear_inversion/*', 'editar_inversion/*') ? 'cambio' : '' }}" href="{{url('inversiones')}}"><i
                                data-feather="check-square"></i><span>MÓDULO INVERSIONES</span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title {{ Request::is('extractos') ? 'cambio' : '' }}" href="{{url('extractos')}}"><i
                                data-feather="briefcase"></i><span>MÓDULO EXTRACTOS</span></a></li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title {{ Request::is('desembolsos', 'editar_desembolso/*') ? 'cambio' : '' }}" href="{{url('desembolsos')}}"><i
                                data-feather="dollar-sign"></i><span>MÓDULO DESEMBOLSOS</span></a></li>


                    <li class="sidebar-list"><a class="sidebar-link sidebar-title {{ Request::is('kpis') ? 'cambio' : '' }}" href="{{url('kpis')}}"><i
                                data-feather="file"></i><span>MÓDULO KPI'S</span></a></li>

            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
