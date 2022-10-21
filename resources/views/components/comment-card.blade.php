@props(['comment'])
<div class="mb-3 d-flex justify-content-start align-items-start" id="">
    <x-avatar :path="$comment->user->profile" width="28" />
    <div class="border-start px-3" style="text-align: justify">
        <span class="" style="font-size: 14px">
            {{$comment->body}}
        </span>
    </div>
</div>
