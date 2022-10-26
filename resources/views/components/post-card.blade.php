@props(['post','show'=>false])
<div class="bg-white shadow rounded mb-3 p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center">
            <x-avatar :path="$post->user->profile" />
            <div class="d-flex flex-column justify-content-center mt-2">
                <h6 class="mb-1">{{$post->user->name}}</h6>
                <small class="text-black-50">{{$post->created_at->diffForHumans()}}</small>
            </div>
        </div>
        <div>
            <i class="bi bi-three-dots text-black-50" style="font-size: 18px"></i>
        </div>
    </div>
    <div class="">
        <p class="mb-3" style="text-align: justify">
            @if (!$show)
            {{Str::words($post->status, 50,'')}}
            <a href="{{route('posts.show',$post->id)}}" class="text-black-50 text-decoration-none"> See More...</a>
            @else
            {{$post->status}}
            @endif
        </p>
        @if ($post->photos)
        <div class="mb-3">
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
                <button class="carousel-control-prev" type="button" data-bs-target="#photo{{$post->id}}"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#photo{{$post->id}}"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        @endif
        <div class="d-flex ms-1 mb-3">
            <div class="me-3">
                <form action="{{route('posts.like',$post->id)}}" method="POST" class="inline-block">
                    @csrf
                    <div class="">
                        <button class="bg-white border-0 me-0">
                            @if ($post->likes->contains('user_id',Auth::id()))
                            <i class="bi bi-heart-fill text-danger fs-5"></i>
                            @else
                            <i class="bi bi-heart fs-5"></i>
                            @endif
                        </button>
                        <span class="text-black-50">{{$post->likes->count()}} likes</span>
                    </div>
                </form>
            </div>
            <div class="me-3">
                <i class="bi bi-chat fs-5 me-1"></i>
                <span class="text-black-50">{{$post->comments->count()}} comments</span>
            </div>
        </div>
        <hr>

        {{-- post's comment section --}}
        @if($post->comments->count())

        <x-comment-card :comment="$post->comments->last()" /> {{-- show latest comment --}}

        @if ($post->comments->count()>1)

        @php
        $post->comments->pop();//remove last comment
        @endphp

        <div class="d-none" id="hideComments{{$post->id}}">
            @foreach ($post->comments->reverse() as $comment)
            <x-comment-card :comment="$comment" />
            @endforeach
        </div>

        <p class="text-black-50" style="cursor: pointer" id="VMC{{$post->id}}" onclick="viewComments({{$post->id}})">
            View more comments <i class="bi bi-caret-down-fill"></i>
        </p>
        <p class="text-black-50 d-none" style="cursor: pointer" id="HC{{$post->id}}"
            onclick="hideComments({{$post->id}})">
            Hide comments <i class="bi bi-caret-up-fill"></i></p>
        @endif

        @endif

        <x-comment-form :post="$post" />
    </div>
</div>
