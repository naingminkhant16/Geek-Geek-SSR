@props(['post'])
<div class="d-flex align-items-center">
    <div>
        <x-avatar :path="Auth::user()->profile" width="38" />
    </div>
    <div class="w-100">
        <form action="{{route('comments.store',$post)}}" id="comment{{$post->id}}" class="d-flex" method="POST">
            @csrf
            <input type="text" name="body" class="form-control" placeholder="Write your comment...">
            <button type="submit" class="bg-white border-0 text-primary" form="comment{{$post->id}}">
                <i class="bi bi-caret-right-fill fs-4"></i></button>
        </form>
    </div>
</div>
