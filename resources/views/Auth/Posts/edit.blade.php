<x-layout>
    <x-slot:title>
        {{Str::words($post->status,2,'...')}}
    </x-slot:title>
    <x-breadcrumb :links="$breadcrumb_links" />
    <div class="">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 ">
                <div class=" bg-white shadow p-3 rounded-3">

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
                    <div class="position-relative mb-3 rounded-3"
                        style="background-image:url({{asset('storage/'.$photo->name)}});height:400px;background-position:center;">
                        <div class="position-absolute end-0 m-1">
                            <button type="button" class="btn btn-white text-white" data-bs-toggle="modal"
                                data-bs-target="#photoDeleteConfirmModal{{$photo->id}}">
                                <i class="bi bi-x-lg fs-5"></i>
                            </button>
                        </div>

                        <form action="{{route('post-photos.delete',$photo->id)}}" class="d-inline-block"
                            id="photoDeleteForm{{$photo->id}}" method="POST" enctype="multipart/form-data">
                            @csrf @method('delete')
                        </form>
                        {{-- confirm modal for photo delete --}}
                        <x-modal id="photoDeleteConfirmModal{{$photo->id}}">
                            <div class="text-center">
                                <h5>Are u sure u want to delete?</h5>
                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">No</button>
                                <button form="photoDeleteForm{{$photo->id}}" type="submit"
                                    class="btn btn-danger">Yes</button>
                            </div>
                        </x-modal>
                    </div>

                    @empty

                    @endforelse
                    <div class="text-end">
                        <a class="btn btn-danger" href="{{route('home')}}">Cancel</a>
                        <button class="btn btn-primary text-white" type="submit" form="postEditForm">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
