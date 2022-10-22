@props(['comment'])
<div class="mb-3 d-flex justify-content-start align-items-start" id="">
    <x-avatar :path="$comment->user->profile" width="28" />
    <div class="border-start px-3" style="text-align: justify">
        <p class="text-black-50 mb-0" style="font-size: 12px">{{$comment->created_at->diffForHumans()}}</p>
        <span class="" style="font-size: 14px">
            {{$comment->body}}
        </span>
    </div>
</div>
