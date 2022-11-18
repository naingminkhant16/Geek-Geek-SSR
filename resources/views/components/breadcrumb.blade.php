@props(['links'])
<nav aria-label="breadcrumb" class="" style="--bs-breadcrumb-divider: '/';">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        @foreach ($links as $name=> $link)

        @if ($loop->last)
        <li class="breadcrumb-item active" aria-current="page">{{$name}}</li>
        @else
        <li class="breadcrumb-item"><a href="{{$link}}">{{$name}}</a></li>
        @endif

        @endforeach
    </ol>
</nav>
