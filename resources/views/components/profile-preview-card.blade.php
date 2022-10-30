@props(['user'=>Auth::user()])
<div class="border rounded p-3 bg-white shadow">
    <div class="d-flex justify-content-end">
        <a href=""><i class="bi bi-pencil-fill"></i></a>
    </div>
    <div class="d-flex justify-content-center flex-column">
        <div class="text-center">
            <div class="mb-3">
                <x-avatar :path="$user->profile" width="180" />
            </div>
            <h4 class="mb-0">
                <a href="{{route('users.show',$user->username)}}" class="text-decoration-none text-black">
                    {{$user->name}}
                </a>
            </h4>
            <small class="">"{{$user->bio??'No Bio'}}"</small><br>
            <small class="text-black-50">Joined On {{$user->created_at->format('M, Y')}}.</small>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <div class="text-center w-50">
                <h4 class=""> {{$user->followers->count()}}</h4>
                <a href="{{route('users.followers',$user->username)}}" class="text-decoration-none">
                    <small class="text-black-50"><i class="bi bi-people-fill"></i> Followers</small></a>
            </div>
            <div class="text-center border-start w-50">
                <h4 class=""> {{$user->followings->count()}}</h4>
                <a href="{{route('users.followings',$user->username)}}" class="text-decoration-none">
                    <small class="text-black-50"><i class="bi bi-person-check-fill"></i> Following</small>
                </a>
            </div>
        </div>
        <hr>
    </div>
</div>
