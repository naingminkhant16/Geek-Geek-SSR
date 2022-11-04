<x-layout>
    <x-slot:title>
        {{Str::words($post->status,2,'...')}}
    </x-slot:title>
    <div class="container bg-white shadow p-3 my-3 rounded" style="max-width: 600px">
        <div class="d-flex align-items-center mb-3">
            <x-avatar :path="$post->user->profile" />
            <div class="d-flex flex-column justify-content-center mt-2">
                <h6 class="mb-1"><a href="{{route('users.show',$post->user->username)}}"
                        class="text-decoration-none text-black">{{$post->user->name}}</a></h6>
                <small class="text-black-50">{{$post->created_at->diffForHumans()}}</small>
            </div>
        </div>
        <form action="{{route('posts.update',$post->id)}}" method="POST" id="postEditForm" class="mb-3"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <textarea name="status" cols="30" rows="10" class="form-control @error('status')
            is-invalid
        @enderror">{{$post->status}}</textarea>
                @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong class="">*{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="">
                <input type="file" name="photos[]" multiple class="form-control @error('photos.*')
                is-invalid
            @enderror">
                @error('photos.*')
                <span class="invalid-feedback" role="alert">
                    <strong class="">*{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </form>
        @forelse ($post->photos as $photo)
        {{-- <a href="{{asset('storage/'.$photo->name)}}" class="venobox"> --}}
            <div class="position-relative mb-3 rounded"
                style="background-image:url({{asset('storage/'.$photo->name)}});height:400px;background-position:center">
                <form action="{{route('post-photos.delete',$photo->id)}}" class="position-absolute end-0 me-2 mt-2"
                    id="photoDeleteForm{{$photo->id}}" method="POST" enctype="multipart/form-data">
                    @csrf @method('delete')
                    <button class="border-0 rounded bg-light" form="photoDeleteForm{{$photo->id}}" type="submit">
                        <i class="bi bi-x-lg fs-6"></i>
                    </button>
                </form>
            </div>
            {{--
        </a> --}}
        @empty

        @endforelse
        <div class="text-end">
            <button class="btn btn-primary text-white" type="submit" form="postEditForm">Save</button>
        </div>
    </div>
</x-layout>
