<x-layout>
    <x-slot:title>{{$user->name}}</x-slot:title>
    <x-breadcrumb :links="$breadcrumb_links" />
    <div class="">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class=" bg-white rounded p-3 shadow">
                    <div class="text-center">
                        <img src="{{asset('storage/'.$user->profile)}}" alt="" id="preview" width="400"
                            class="img-fluid rounded">
                    </div>
                    <form action="{{route('users.update',$user->id)}}" class="mt-3" method="POST"
                        enctype="multipart/form-data">
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
                            {{-- <img src="#" alt="" id="preview" class="img-thumbnail"> --}}
                        </div>
                        <div class="mb-3 text-end">
                            <a class="btn btn-danger text-white" href="/">Cancel</a>
                            <button type="submit" class="btn btn-primary text-white">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        const profile=document.getElementById('profile')
        const preview=document.getElementById('preview')
        profile.onchange=ent=>{
            const [file]=profile.files
            if(file){
                preview.src=URL.createObjectURL(file)
            }
        }
    </script>
    @endpush
</x-layout>
