<nav class="navbar navbar-expand-lg bg-white navbar-white border-bottom border-opacity-10 border-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <span class="text-white border p-2  rounded-3 bg-primary border-0 m-1">Geek</span></a>

        <div class="d-flex justify-content-center align-items-center">
            @auth
            <div class="dropdown d-none d-lg-block">
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
                    @if (auth()->user()->is_admin)
                    <li class="">
                        <a href="{{route('dashboard.index')}}" class="dropdown-item">
                            <i class="bi bi-bar-chart"></i>
                            Dashboard
                        </a>
                    </li>
                    @endif
                    <li class="">
                        <button type="submit" class="dropdown-item text-danger" form="logout">
                            <i class="bi bi-box-arrow-right me-1"></i>Logout</button>
                    </li>
                </ul>
            </div>
            @endauth
            <div class="">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>

    </div>
</nav>

@auth
<form action="{{route('logout')}}" method="POST" id="logout" class="d-none">
    @csrf
</form>

{{-- //offcanvas --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <a class="offcanvas-title mt-2" href="/">
            <span class="text-white border p-2  rounded-3 bg-primary border-0 m-1">Geek</span></a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex justify-content-center align-items-center">
        <div class="mt-3">
            <div class="text-center">
                <div class="mb-3">
                    <a href="{{route('users.show',auth()->user()->username)}}" class="">
                        <i class="bi bi-person-fill"></i> Profile</a>
                </div>
                <div class="mb-3">
                    <a href="{{route('users.peopleYouMayKnow')}}" class="">
                        <i class="bi bi-person-plus-fill"></i> People You May Konw</a>
                </div>
                @if (auth()->user()->is_admin)
                <div class="mb-3">
                    <a href="{{route('dashboard.index')}}" class="">
                        <i class="bi bi-bar-chart"></i>
                        Dashboard
                    </a>
                </div>
                @endif
                <div class="mb-3">
                    <a href="{{route('users.peopleYouMayKnow')}}" class="">
                        <i class="bi bi-people-fill"></i> Followers</a>
                </div>
                <div class="mb-3">

                    <a href="{{route('users.peopleYouMayKnow')}}" class="">
                        <i class="bi bi-person-check-fill me-1"></i>Followings</a>
                </div>
                <div class="mb-3 d-flex justify-content-center">
                    <button type="submit" class="text-danger nav-link border-0 bg-transparent" form="logout">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout</button>
                </div>
            </div>

            <form action="{{route('users.search')}}" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="search"
                        value="{{request('search')}}">
                    <button class="btn btn-primary text-white" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

        </div>

    </div>
</div>
@endauth