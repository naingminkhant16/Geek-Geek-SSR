<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Geek Geek | {{$title}}</title>
    @vite('resources/js/app.js')
</head>

<body>
    <x-nav />
    <div>
        {{$slot}}
    </div>
</body>

</html>
