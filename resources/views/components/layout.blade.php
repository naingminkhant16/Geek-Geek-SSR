<!DOCTYPE html>
<html lang="en">

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
        @auth
        <x-nav />
        @endauth
        <div class="container mt-3">
            {{$slot}}
        </div>
        @auth
        <x-footer />
        @endauth
    </div>
</body>

</html>
