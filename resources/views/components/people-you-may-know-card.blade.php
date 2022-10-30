@props(['people','title'=>"People You May Know"])
<div class="bg-white p-3 rounded shadow w-100">
    <h5>{{$title}}</h5>
    <hr>
    @foreach ($people as $person)
    <div class="d-flex align-items-center justify-content-between border-bottom mb-3 pb-3">
        <div class="d-flex justify-content-start align-items-center">
            <x-avatar :path="$person->profile" width="28" />
            <div class="d-flex flex-column justify-content-center mt-2">
                <h6 class="mb-0"><a href="" class="text-decoration-none text-black">{{$person->name}}</a></h6>
                <small class="text-black-50">Joined on {{$person->created_at->format('M, Y')}}</small>
            </div>
        </div>
        <div class="">
            @if (!Auth::user()->followings->contains('id',$person->id))
            <form action="{{route('users.follow')}}" id="" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{$person->id}}">
                <button class="bg-white border-0" type="submit"><i class=" bi bi-plus-circle text-primary"></i></button>
            </form>
            @else
            <i class="bi bi-person-check-fill text-primary me-1 " data-bs-toggle="dropdown"></i>
            <ul class="dropdown-menu">
                <form action="{{route('users.unfollow')}}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$person->id}}">
                    <button class="dropdown-item text-danger" type="submit">
                        <i class="bi bi-person-dash-fill"></i>
                        <small>Unfollow</small>
                    </button>
                </form>
            </ul>
            @endif
        </div>
    </div>
    @endforeach
    <div class="">
        {{$slot}}
    </div>
</div>
