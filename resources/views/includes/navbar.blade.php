<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('home') }}" class="navbar-brand">
            Gestión Hospitalaria
        </a>

        <div class="navbar-links">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                Inicio
            </a>
            <a href="{{ route('medicos.index') }}" class="{{ request()->routeIs('medicos.*') ? 'active' : '' }}">
                Médicos
            </a>
            <a href="{{ route('pacientes.index') }}" class="{{ request()->routeIs('pacientes.*') ? 'active' : '' }}">
                Pacientes
            </a>
            <a href="{{ route('ingresos.index') }}" class="{{ request()->routeIs('ingresos.*') ? 'active' : '' }}">
                Ingresos
            </a>
            <a href="{{ route('historial.index') }}" class="{{ request()->routeIs('historial.*') ? 'active' : '' }}">
                Historial / Consultas
            </a>
        </div>
    </div>
</nav>