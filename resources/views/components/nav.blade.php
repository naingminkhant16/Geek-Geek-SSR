<nav class="navbar navbar-expand-lg bg-white navbar-white border-bottom border-opacity-10 border-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <span class="text-white border p-2 rounded rounded-2 bg-primary border-0 m-1">Geek</span></a>

        <div class="d-flex justify-content-center align-items-center">
            <div class="dropdown">
                <div class="" data-bs-toggle="dropdown">
                    <x-avatar :path="Auth::user()->profile" />
                </div>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                    <li class="">
                        <a href="{{route('users.show',Auth::user()->username)}}" class="dropdown-item">
                            <i class="bi bi-person"></i>
                            Profile
                        </a>
                    </li>
                    <li class="">
                        <button type="submit" class="dropdown-item bg-danger text-white" form="logout">
                            <i class="bi bi-box-arrow-right me-1"></i>Logout</button>
                    </li>
                </ul>
            </div>
            <div class="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <form action="{{route('users.search')}}" class="nav-link">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="search"
                                value="{{request('search')}}">
                            <button class="btn btn-primary text-white" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>

        <form action="{{route('logout')}}" method="POST" id="logout" class="d-none">
            @csrf
        </form>
    </div>
</nav>
