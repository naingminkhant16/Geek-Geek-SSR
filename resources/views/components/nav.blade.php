<nav class="navbar navbar-expand-lg  bg-body-tertiary border-bottom border-opacity-10 sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <span class="text-white bg-primary p-2 rounded-3 m-1">Geek</span></a>

        <div class="d-flex justify-content-center align-items-center">
            <div class="me-lg-3">
                <i class="bi bi-circle-half fs-5" id="dark-light-circle"></i>
            </div>
            @auth
            <div class="d-none d-lg-block me-3">
                <x-search-form />
            </div>
            <div class="dropdown d-none d-lg-block">
                <div class="" data-bs-toggle="dropdown">
                    <x-avatar :path="Auth::user()->profile" width="36" />
                </div>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                    <li class="">
                        <a href="{{route('users.show',Auth::user()->username)}}" class="dropdown-item">
                            <i class="bi bi-person"></i>
                            Profile
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('users.changePassword.index')}}" class="dropdown-item">
                            <i class="bi bi-gear-fill"></i>
                            Change Password
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
                        <button type="submit" class="dropdown-item text-danger-emphasis" form="logout">
                            <i class="bi bi-box-arrow-right me-1"></i>Logout</button>
                    </li>
                </ul>
            </div>
            <div class="">
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" aria-expanded="false">
                    {{-- <span class="navbar-toggler-icon"></span> --}}
                    <i class="bi bi-three-dots"></i>
                </button>
            </div>
            @endauth
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
        <div></div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex justify-content-center align-items-center">
        <div class="mt-3">
            <div class="text-center">
                <div class="mb-3">
                    <a href="{{route('users.show',auth()->user()->username)}}"
                        class="@if(request()->routeIs('users.show',auth()->user()->username))text-primary @else  text-secondary-emphasis  @endif text-decoration-none">
                        <i class="bi bi-person-fill"></i> Profile</a>
                </div>
                <div class="mb-3">
                    <a href="{{route('users.peopleYouMayKnow')}}"
                        class="@if (request()->routeIs('users.peopleYouMayKnow')) text-primary @else text-secondary-emphasis @endif text-decoration-none">
                        <i class="bi bi-person-plus-fill"></i> People You May Konw</a>
                </div>
                @if (auth()->user()->is_admin)
                <div class="mb-3">
                    <a href="{{route('dashboard.index')}}" class="text-secondary-emphasis text-decoration-none">
                        <i class="bi bi-bar-chart"></i>
                        Dashboard
                    </a>
                </div>
                @endif
                <div class="mb-3">
                    <a href="{{route('users.changePassword.index')}}" class="@if(request()->routeIs('users.changePassword.index')) text-primary @else
                        text-secondary-emphasis @endif text-decoration-none">
                        <i class=" bi bi-gear-fill"></i>
                        Change Password
                    </a>
                </div>

                <div class="mb-3">
                    <a href="{{route('users.followers',auth()->user()->username)}}"
                        class="@if(request()->routeIs('users.followers',auth()->user()->username))text-primary @else  text-secondary-emphasis  @endif text-decoration-none">
                        <i class="bi bi-people-fill"></i> Followers</a>
                </div>
                <div class="mb-3">

                    <a href="{{route('users.followings',auth()->user()->username)}}"
                        class="@if (request()->routeIs('users.followings',auth()->user()->username)) text-primary @else text-secondary-emphasis @endif text-decoration-none">
                        <i class="bi bi-person-check-fill me-1"></i>Followings</a>
                </div>
                <div class="mb-3 d-flex justify-content-center">
                    <button type="submit" class="text-danger-emphasis nav-link border-0 bg-transparent" form="logout">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout</button>
                </div>
            </div>
            <div class="mb-3">
                <x-search-form />
            </div>

        </div>

    </div>
</div>
@endauth
