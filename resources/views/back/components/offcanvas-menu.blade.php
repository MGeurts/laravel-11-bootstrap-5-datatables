<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
    <!-- application -->
    <li class="nav-item">
        <a class="nav-link disabled" aria-current="page" href="/">Application</a>
    </li>
    <div class="text-secondary">
        <hr class="narrow">
    </div>

    <li class="nav-item"><a class="nav-link disabled" href="#"><img class="nav-icon" src="{{ asset('img/icons/products-white.png') }}" />Products</a></li>
    <li class="nav-item"><a class="nav-link disabled" href="#"><img class="nav-icon" src="{{ asset('img/icons/delivery-white.png') }}" />Deliveries</a></li>
    <li class="nav-item"><a class="nav-link disabled" href="#"><img class="nav-icon" src="{{ asset('img/icons/reorder-white.png') }}" />Orders</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('back.customers.index') }}"><img class="nav-icon" src="{{ asset('img/icons/persons-white.png') }}" />Customers</a></li>
    <li class="nav-item"><a class="nav-link disabled" href="#"><img class="nav-icon" src="{{ asset('img/icons/supplier-white.png') }}" />Suppliers</a></li>
    <div class="text-secondary">
        <hr class="narrow">
    </div>

    <!-- developer -->
    @can('developer')
        <li class="nav-item">
            <a class="nav-link disabled" aria-current="page" href="/">Administration</a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-bounding-box nav-icon"></i>{{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                <li><a class="dropdown-item" href="{{ route('back.users.index') }}"><i class="bi bi-people-fill nav-icon"></i>Users</a></li>
                <li><a class="dropdown-item" href="{{ route('back.userslog.index') }}"><i class="bi bi-person-lines-fill nav-icon"></i>Users Log</a></li>
                <li><a class="dropdown-item" href="{{ route('back.userslog.stats') }}"><i class="bi bi-person-lines-fill nav-icon"></i>Users Statistics</a></li>
                <hr class="narrow">

                <li><a class="dropdown-item" href="{{ url('/back/developer/log-monitor') }}" target="_blank"><i class="bi bi-book-half nav-icon"></i>Log Viewer</a></li>
                <hr class="narrow">

                <li><a class="dropdown-item" href="{{ route('back.developer.hashGenerator') }}"><i class="bi bi-key-fill nav-icon"></i>Hash Generator</a></li>
                <hr class="narrow">

                <li><a class="dropdown-item" href="{{ route('back.developer.impressum') }}"><i class="bi bi-file-text-fill nav-icon"></i>Impressum</a></li>
                <li><a class="dropdown-item" href="{{ route('back.developer.session') }}"><i class="bi bi-braces-asterisk nav-icon"></i>Session</a></li>
            </ul>
        </li>
    @endcan
</ul>
