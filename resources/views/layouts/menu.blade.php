<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/home">
        <i class=" fas fa-building"></i><span>Inicio</span>
    </a>
    
    @can('ver-usuario')
    <a class="nav-link" href="/usuarios">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>
    @endcan
    
    @can('ver-rol')
    <a class="nav-link" href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a>
    @endcan
    
    @can('ver-place')
    <a class="nav-link" href="/places">
        <i class=" fas fa-place"></i><span>Lugares</span>
    </a>
    @endcan
    
    @can('ver-typeEvent')
    <a class="nav-link" href="/typeEvents">
        <i class=" fas fa-place"></i><span>Tipo de Eventos</span>
    </a>
    @endcan
    @can('ver-ticComponent')
    <a class="nav-link" href="/ticComponents">
        <i class=" fas fa-place"></i><span>Componentes tics</span>
    </a>
    @endcan
    @if(Auth::user()->hasRole('alumno'))
        <a class="nav-link" href="/events">
            <i class=" fas fa-place"></i><span>Mis Pedidos</span>
        </a>
    @else
        <a class="nav-link" href="/events">
            <i class=" fas fa-place"></i><span>Pedidos</span>
        </a>
    @endif
    @can('ver-eventconfirmados')
    <!-- Mostrar contenido solo si el usuario tiene el permiso -->
    <a class="nav-link" href="{{ route('events.confirmados') }}">
        <i class=" fas fa-place"></i><span>Eventos Confirmados</span>
    </a>
    @endcan

    
</li>
