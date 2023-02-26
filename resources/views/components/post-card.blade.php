@props(['post','show'=>false])
<div class="bg-white shadow rounded-3 mb-3 p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center">
            <x-avatar :path="$post->user->profile" />
            <div class="d-flex flex-column justify-content-center mt-2">
                <h6 class="mb-1"><a href="{{route('users.show',$post->user->username)}}"
                        class="text-decoration-none text-black">{{$post->user->name}}</a></h6>
                <small class="text-black-50">{{$post->created_at->diffForHumans()}}</small>
            </div>
        </div>
        <div class="">
            <i class="bi bi-three-dots text-black-50 fs-5" data-bs-toggle="dropdown" style="cursor:pointer"></i>
            <ul class="dropdown-menu">
                @can('update',$post)
                <li>
                    <a class="dropdown-item" href="{{route('posts.edit',$post->id)}}">
                        <i class="bi bi-pencil-square"></i> Edit Post
                    </a>
                </li>
                @endcan
                @if (auth()->id()!==$post->user_id)
                <li>
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reportForm{{$post->id}}">
                        <i class="bi bi-exclamation-circle me-1"></i>Report To Admin
                    </button>
                </li>
                @endif
                @can('delete',$post)
                <li>
                    <form action="{{route('posts.destroy',$post->id)}}" method="POST" id="postDeleteForm{{$post->id}}">
                        @csrf
                        @method('delete')
                    </form>
                    <button class="dropdown-item text-danger" data-bs-toggle="modal"
                        data-bs-target="#postDeleteConfirmModal{{$post->id}}">
                        <i class="bi bi-trash"></i> Delete Post
                    </button>
                </li>
                @endcan
            </ul>
        </div>
    </div>
    {{-- modal form for report post --}}
    <x-modal id="reportForm{{$post->id}}">
        @slot('title')
        Write a message for admin to review!
        @endslot
        <div class="">
            <form action="{{route('posts.report')}}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <div class="mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a message here" id="message" name="message"
                            style="height: 250px"></textarea>
                        <label for="message">Report Message</label>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </x-modal>
    {{-- modal form for post delete --}}
    @can('delete',$post)
    <x-modal id="postDeleteConfirmModal{{$post->id}}">
        <div class="text-center">
            @slot('title')
            Are u sure u want to delete?
            @endslot
            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">No</button>
            <button form="postDeleteForm{{$post->id}}" type="submit" class="btn btn-danger ">Yes</button>
        </div>
    </x-modal>
    @endcan

    <div class="">
        <p class="mb-3" style="text-align: justify">
            @if (!$show)
            {{Str::words($post->status, 50,'')}}
            <a href="{{route('posts.show',$post->id)}}" class="text-black-50 text-decoration-none"> See More...</a>
            @else
            {{$post->status}}
            @endif
        </p>

        {{-- photos --}}
        @if ($post->photos)
        <div class="mb-3">
            <x-carousel-img :post="$post" />
        </div>
        @endif
        <div class="d-flex ms-1 mb-3">
            <div class="me-3">
                @csrf
                {{-- <form action="{{route('posts.like',$post->id)}}" method="POST" class="inline-block">
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
                </form> --}}
                <button class="bg-white border-0 me-0"
                    onclick="makeRequestForPostLike(document.getElementsByName('_token')[0].value,{{$post->id}})">
                    @if ($post->likes->contains('user_id',Auth::id()))
                    <i class="bi bi-heart-fill fs-5 heart-sign-{{$post->id}}"></i>
                    @else
                    <i class="bi bi-heart fs-5 heart-sign-{{$post->id}}"></i>
                    @endif
                </button>
                <span class="text-black-50" id="likes-count-{{$post->id}}">{{$post->likes->count()}}</span><span
                    class="text-black-50"> likes</span>
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
{{-- @push('scripts')
<script type="module">
    // const token= document.getElementsByName('_token')[0].value

    // makeRequestForPostLike(token,100)
</script>
@endpush --}}