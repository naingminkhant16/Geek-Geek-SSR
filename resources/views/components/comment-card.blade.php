@props(['comment'])
<div class="mb-3 d-flex justify-content-start align-items-start" id="">
    <x-avatar :path="$comment->user->profile" width="28" />
    <div class="border-start px-3 w-100 mb-1" style="text-align: justify">
        <div class="d-flex justify-content-between">
            <h6 class="mb-0">
                <a href="{{route('users.show',$comment->user->username)}}"
                    class="text-decoration-none text-dark-emphasis">
                    {{$comment->user->name}}
                </a>
            </h6>
            <small class="text-body-secondary mb-0 d-block"
                style="font-size: 12px">{{$comment->created_at->diffForHumans()}}</small>
        </div>
        <span class="text-body" style="font-size: 14px">
            {{$comment->body}}
        </span>
    </div>
</div>