<div class="border rounded p-3 bg-white shadow">
    <div class="d-flex justify-content-end">
        <a href=""><i class="bi bi-pencil-fill"></i></a>
    </div>
    <div class="d-flex justify-content-center flex-column">
        <div class="text-center">
            <div class="mb-3">
                <x-avatar :path="Auth::user()->profile" width="150" />
            </div>
            <h4 class="mb-0"><a href="#" class="text-decoration-none text-black">{{Auth::user()->name}}</a></h4>
            <small class="">"{{Auth::user()->bio??'No Bio'}}"</small><br>
            <small class="text-black-50">Joined On {{Auth::user()->created_at->format('M, Y')}}.</small>
        </div>
        <div class="row mt-3">
            <div class="border col rounded text-center p-3">
                <h4 class=""> {{Auth::user()->followers->count()}}</h4>
                <small class="text-black-50"><i class="bi bi-people-fill"></i> Followers</small>
            </div>
            <div class="border col rounded text-center p-3">
                <h4 class=""> {{Auth::user()->followings->count()}}</h4>
                <small class="text-black-50"><i class="bi bi-person-check-fill"></i> Following</small>
            </div>
        </div>
    </div>
</div>
