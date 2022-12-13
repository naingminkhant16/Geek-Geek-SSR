<x-layout>
    <x-slot:title>Post Create</x-slot:title>
    <x-breadcrumb :links="$breadcrumb_links" />
    <div class="">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="bg-white shadow p-4 rounded">
                    <h3 class="text-black">Share Your Feelings</h3>
                    <hr>
                    <form action="{{route('posts.store')}}" method="POST" id="postCreateForm"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <textarea name="status" id="" cols="30" rows="15" class="form-control @error('status')
                                is-invalid
                                @enderror" placeholder="What's on your mind today?...">{{old('status')}}</textarea>
                            @error('status')
                            <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="file" name="photos[]" multiple id="photos" class="form-control @error('photos.*')
                                is-invalid
                                @enderror">
                            @error('photos.*')
                            <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center flex-column align-items-center"
                            id="photos_parent_div">

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
        const photos = document.getElementById('photos')
        const parentDiv = document.getElementById("photos_parent_div")

        photos.onchange = e => {

            if(parentDiv.childElementCount){
                 parentDiv.textContent=""
            }

            const [...files] = photos.files
            files.forEach(file => {
            if(file){
                let img = document.createElement('img')
                img.src=URL.createObjectURL(file)
                img.classList.add('img-fluid','mb-3','rounded','w-100')

                parentDiv.append(img);
            }
            });
        }

    </script>
    @endpush
</x-layout>
