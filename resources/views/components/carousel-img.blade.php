@props(['post'])
<div id="photo{{$post->id}}" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($post->photos as $photo)
        <div class="carousel-item @if($loop->first) active @endif">
            <a href="{{asset('storage/'.$photo->name)}}" class="venobox">
                <img src="{{asset('storage/'.$photo->name)}}" class="d-block w-100"
                    style="height:400px;object-fit:cover;">
            </a>
        </div>
        @endforeach
    </div>
    @if ($post->photos->count()>1)
    <button class="carousel-control-prev" type="button" data-bs-target="#photo{{$post->id}}" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#photo{{$post->id}}" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    @endif
</div>
