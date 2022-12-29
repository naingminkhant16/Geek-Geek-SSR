@extends('layouts.admin')
@section('title','Posts')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center bg-white rounded-3 p-3 shadow">
                <div class="">
                    <a href="" id="postsLink" class="mb-0 text-decoration-none text-primary">
                        <span class="">
                            <i class="bi bi-file-post"></i>
                            Posts
                        </span>
                    </a>
                    <span class="text-black-50">|</span>
                    <a href="" id="deletedPostsLink" class="mb-0 text-decoration-none text-black-50">
                        <span class="">
                            Deleted Posts
                            <i class="bi bi-trash-fill"></i>
                        </span>
                    </a>
                </div>
                <div class="">
                    <form action="{{route('admin.posts.index')}}">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Posts" name="search"
                                value="{{request('search')}}">
                            <button class="btn btn-primary text-white" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12" id="posts">
            <div class="mt-3 mt-lg-4 row">
                @foreach ($posts as $post)
                <div class="col-12 col-lg-4">
                    <x-post-card :post="$post" />
                </div>
                @endforeach
                <div class="">
                    {{$posts->links()}}
                </div>
            </div>
        </div>
        <div class="col-12" id="deletedPosts d-none">
            <div class="mt-3 mt-lg-4 row">
                @foreach ($deletedPosts as $post)
                <div class="col-12 col-lg-4">
                    <x-post-card :post="$post" />
                </div>
                @endforeach
                <div class="">
                    {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    let postsDiv= document.getElementById('posts');
    let deletedPostsDiv= document.getElementById('deletedPosts');

    let deletedPostsLink=document.getElementById('deletedPostsLink');
    let postsLink=document.getElementById('postsLink');

deletedPostsLink.addEventListener('click',function(e){
    e.preventDefault();

    handlePostsStatus(false);
})


postsLink.addEventListener('click',function(e){
    e.preventDefault();
    handlePostsStatus(true);
})

function handlePostsStatus(status=true){
    //true for posts and false for deleted posts
if(status){
    postsDiv.classList.add('d-block');
    postsDiv.classList.remove('d-none',);

    deletedPostsDiv.classList.add('d-none');
    deletedPostsDiv.classList.remove('d-block');

    postsLink.classList.add('text-primary');
    postsLink.classList.remove('text-black-50');

    deletedPostsLink.classList.remove('text-primary');
    deletedPostsLink.classList.add('text-black-50');
}else{
    postsDiv.classList.add('d-none');
    deletedPostsDiv.classList.add('d-block');

    deletedPostsLink.classList.add('text-primary');
    deletedPostsLink.classList.remove('text-black-50');

    postsLink.classList.remove('text-primary');
    postsLink.classList.add('text-black-50');
}
}

</script>
@endpush
@endsection
