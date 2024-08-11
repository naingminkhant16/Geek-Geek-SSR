<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Admin Dashboard</title>
    <link rel="icon" href="https://nmk.netlify.app/img/nmk.2d1e47b7.png">
    @vite('resources/js/app.js')
</head>

<body>
    <div class="">
        <div class="row g-0">
            <div class="d-none d-lg-block col-12 col-lg-2">
                <div class="bg-dark min-vh-100 text-white">
                    <div class="row vh-100">
                        <div class="col-lg-12">
                            <div class="text-center mt-4">
                                <a class="" href="{{route('dashboard.index')}}">
                                    <span
                                        class="text-white border p-2 fs-2 rounded-3 bg-primary border-0 m-1">Geek</span></a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="text-center w-100">
                                <x-avatar :path="Auth::user()->profile" width="130" />
                                <h4 class="mt-3 mb-0">{{Auth::user()->name}}</h4>
                                @if (Auth::user()->is_admin)
                                <p class="text-white-50">Admin</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <x-admin.navLink />
                        </div>
                        <div class="col-lg-12">
                            <div class="text-center">
                                <a href="{{route('home')}}"
                                    class="text-decoration-none text-white-50 dashboard-link-exit rounded-3 p-3 "><i
                                        class="bi bi-box-arrow-right"></i> Exit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-10">
                <div class="bg-light min-vh-100">
                    {{--mobile nav --}}
                    <nav class=" d-lg-none navbar navbar-expand-lg bg-white">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="{{route('dashboard.index')}}">
                                <span
                                    class="text-white border p-2 fs-2  rounded-3 bg-primary border-0 m-1">Geek</span></a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="offcanvas offcanvas-start bg-dark" tabindex="-1" id="offcanvasExample"
                                aria-labelledby="offcanvasExampleLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title text-white" id="offcanvasExampleLabel"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                        aria-label="Close" />
                                </div>
                                <div class="offcanvas-body">
                                    <div class="bg-dark text-white mt-5">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center w-100">
                                                    <x-avatar :path="Auth::user()->profile" width="130" />
                                                    <h4 class="mt-3 mb-0">{{Auth::user()->name}}</h4>
                                                    @if (Auth::user()->is_admin)
                                                    <p class="text-white-50">Admin</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <x-admin.navLink />
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="text-center mt-3">
                                                    <a href="{{route('home')}}"
                                                        class="text-decoration-none text-white-50 dashboard-link-exit rounded-3 p-3">
                                                        <i class="bi bi-box-arrow-right"></i> Exit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                    {{-- content --}}
                    <div class="px-0 py-3 p-lg-3 overflow-auto vh-100">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stack('scripts')
    <script type="module">
        @if (Session::has('success'))
        showToast(" {{session('success')}} ")

        @elseif (Session::has('error'))
        showToast(" {{session('error')}} ",'error')

        @elseif (Session::has('warning'))
        showToast(" {{session('warning')}} ",'warning')

        @elseif (Session::has('info'))
        showToast(" {{session('info')}} ",'info')

        @else

        @endif
    </script>
</body>

</html>
