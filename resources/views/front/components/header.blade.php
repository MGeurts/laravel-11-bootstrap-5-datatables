<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary  fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> {{ env('APP_NAME') }} </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>

                </ul>

                <div class="d-flex">
                    <div class="dropdown mx-1">
                        <button class="btn btn-sm text-light bg-info-subtle border-info-subtle px-2  border  rounded-2 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <svg fill="currentColor" width="18" height="18">
                                <use href="#icon-auto"></use>
                            </svg>


                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            @include('components.layout.guest.theme')
                        </ul>
                    </div>

                    <a class="btn btn-sm text-light bg-info-subtle border-info-subtle px-2  border  rounded-2" href="{{ route('login') }}" title="Login"
                        role="button" tabindex="-1">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
