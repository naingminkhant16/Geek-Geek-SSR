@props(['user'=>Auth::user()])
<div class="border bg-body-tertiary rounded-3 p-3">
    <div class="d-flex justify-content-end">
        @can('update-user',$user)
        <a href="{{route('users.edit',$user->username)}}"><i class="bi bi-pencil-fill text-primary"></i></a>
        @endcan
    </div>
    <div class="d-flex justify-content-center flex-column">
        <div class="text-center">
            <hr>
            <div class="mb-3">
                <a href="{{asset('storage/'.$user->profile)}}" class="venobox">
                    <x-avatar :path="$user->profile" width="150" />
                </a>
            </div>
            <h4 class="mb-0">
                <a href="{{route('users.show',$user->username)}}" class="text-decoration-none text-dark-emphasis">
                    {{$user->name}}
                </a>
            </h4>
            <small class="">"{{$user->bio??'No Bio'}}"</small><br>
            <small class="text-body-secondary">Joined On {{$user->created_at->format('M, Y')}}.</small><br>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <div class="text-center w-50">
                <h4 class="text-dark-emphasis"> {{$user->followers->count()}}</h4>
                <a href="{{route('users.followers',$user->username)}}" class="text-decoration-none">
                    <small class="text-body-secondary"><i class="bi bi-people-fill"></i> Followers</small></a>
            </div>
            <div class="text-center border-start w-50">
                <h4 class="text-dark-emphasis"> {{$user->followings->count()}}</h4>
                <a href="{{route('users.followings',$user->username)}}" class="text-decoration-none">
                    <small class="text-body-secondary"><i class="bi bi-person-check-fill"></i> Following</small>
                </a>
            </div>
        </div>
        <hr>
    </div>
</div>
