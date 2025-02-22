<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark" style="background-color: #daad00 !important; color: white !important;"> 
    <!-- Sidebar Brand -->
    <div class="sidebar-brand">
        <span class="brand-text text-black">CABARA C.A</span>
    </div>

    <!-- Sidebar Wrapper -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!-- Sidebar Menu -->
            <ul class="nav sidebar-menu flex-column" role="menu">
                <!-- Gestionar Sistema -->
                @if(Auth::user()->hasRole('superAdmin') || Auth::user()->hasRole('empleado'))
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="nav-icon fas fa-house"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('categorias.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Categorías</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('subcategorias.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-list-check"></i>
                        <p>Subcategorías</p>
                    </a>
                </li>
               {{-- <li class="nav-item">
                    <a href="{{route('tasas.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Tasa</p>
                    </a>
                </li>--}}
                <li class="nav-item">
                    <a href="{{ route('almacen') }}" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>Productos</p>
                    </a>
                </li>

                <!-- Ventas -->
                <li class="nav-item">
                    <a href="{{route('ventas.vender')}}" class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Vender</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('ventas.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>Ventas</p>
                    </a>
                </li>

                <!-- Finanzas -->
                <li class="nav-item">
                    <a href="{{route('aperturas.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>Caja</p>
                    </a>
                </li>
             
                @endif

                <!-- Administración -->
                @if(Auth::user()->hasRole('superAdmin'))
                <li class="nav-item">
                    <a href="{{route('usuarios.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
