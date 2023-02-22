<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Geek Geek | {{$title}}</title>
    <link rel="icon" href="https://nmk.netlify.app/img/nmk.2d1e47b7.png">
    @vite('resources/js/app.js')
</head>

<body>
    <div class="d-flex flex-column min-vh-100 bg-light">

        <x-nav />

        <div class="container mt-3">
            {{$slot}}
        </div>

        <x-footer />

    </div>
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
    @stack('scripts')
</body>

</html>