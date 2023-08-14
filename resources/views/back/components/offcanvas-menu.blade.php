<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
    <!-- application -->
    <li class="nav-item text-light">Application</li>
    <hr class="narrow text-light">

    <li class="nav-item"><a class="nav-link text-light disabled" href="#"><img class="nav-icon" src="{{ asset('img/icons/products-white.png') }}" />Products</a></li>
    <ul>
        <li class="list-group-item">
            <a class="nav-link text-light disabled" href="#">
                <img class="nav-icon" src="{{ asset('img/icons/categorisation-white.png') }}" />Categorisation
            </a>
        </li>
    </ul>
    <li class="nav-item"><a class="nav-link text-light disabled" href="#"><img class="nav-icon" src="{{ asset('img/icons/delivery-white.png') }}" />Deliveries</a></li>
    <li class="nav-item"><a class="nav-link text-light disabled" href="#"><img class="nav-icon" src="{{ asset('img/icons/reorder-white.png') }}" />Orders</a></li>
    <li class="nav-item"><a class="nav-link text-light" href="{{ route('back.customers.index') }}"><img class="nav-icon" src="{{ asset('img/icons/persons-white.png') }}" />Customers</a></li>
    <li class="nav-item"><a class="nav-link text-light disabled" href="#"><img class="nav-icon" src="{{ asset('img/icons/supplier-white.png') }}" />Suppliers</a></li>

    <!-- developer -->
    @can('developer')
        <hr class="narrow text-light">
        <li class="nav-item text-light">Administration</li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                <i class="bi bi-person-bounding-box nav-icon"></i>{{ Auth::user()->name }}
            </a>

            <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                <li><a class="dropdown-item" href="{{ route('back.users.index') }}"><i class="bi bi-people-fill nav-icon"></i>Users</a></li>
                <li><a class="dropdown-item" href="{{ route('back.userslog.index') }}"><i class="bi bi-person-lines-fill nav-icon"></i>User Log</a></li>
                <li><a class="dropdown-item" href="{{ route('back.userslog.statsCountry') }}"><i class="bi bi-person-lines-fill nav-icon"></i>User Statistics (Country)</a></li>
                <li><a class="dropdown-item" href="{{ route('back.userslog.statsCountryMap') }}"><i class="bi bi-person-lines-fill nav-icon"></i>User Statistics (Country Map)</a></li>
                <li><a class="dropdown-item" href="{{ route('back.userslog.statsPeriode') }}"><i class="bi bi-person-lines-fill nav-icon"></i>User Statistics (Periode)</a></li>
                <hr class="narrow">

                <li><a class="dropdown-item" href="{{ url('/back/developer/log-monitor') }}" target="_blank"><i class="bi bi-book-half nav-icon"></i>Log Viewer</a></li>
                <hr class="narrow">

                <li><a class="dropdown-item" href="{{ route('back.backups.index') }}"><i class="bi bi-archive-fill nav-icon"></i>Backups</a></li>
                <hr class="narrow">

                <li><a class="dropdown-item" href="{{ route('back.developer.hashGenerator') }}"><i class="bi bi-key-fill nav-icon"></i>Hash Generator</a></li>
                <hr class="narrow">

                <li><a class="dropdown-item" href="{{ route('back.developer.impressum') }}"><i class="bi bi-file-text-fill nav-icon"></i>Impressum</a></li>
                <li><a class="dropdown-item" href="{{ route('back.developer.session') }}"><i class="bi bi-braces-asterisk nav-icon"></i>Session</a></li>

                <hr class="narrow">
                <li><a class="dropdown-item" href="{{ route('back.developer.test') }}"><i class="bi bi-code-slash nav-icon"></i>Test</a></li>
            </ul>
        </li>
    @endcan
</ul>
