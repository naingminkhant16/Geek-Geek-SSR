<x-layout>
    <x-slot:title>{{$user->name}}</x-slot:title>
    <div class="container bg-white rounded p-3 my-3 shadow" style="max-width:600px ">
        <div class="text-center">
            <img src="{{asset('storage/'.$user->profile)}}" alt="" width="400">
        </div>
        <form action="{{route('users.update',$user->id)}}" class="mt-3" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <x-input name="name" label="Your Name" :value="$user->name" />
            </div>
            <div class="mb-3">
                <x-input name="bio" label="Your Bio" :value="$user->bio" />
            </div>
            <div class="mb-3">
                <x-input name="date_of_birth" label="Your DOB" :value="$user->date_of_birth" type="date" />
            </div>
            <div class="mb-3">
                <label for="profile" class="form-label">Choose New Profile</label>
                <input type="file" id="profile" name="profile"
                    class="form-control @error('profile') is-invalid @enderror">
                @error('profile')
                <span class="invalid-feedback" role="alert">
                    <strong class="">*{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3 text-end">
                <a class="btn btn-danger text-white" href="/">Cancel</a>
                <button type="submit" class="btn btn-primary text-white">Upload</button>
            </div>
        </form>
    </div>
</x-layout>
