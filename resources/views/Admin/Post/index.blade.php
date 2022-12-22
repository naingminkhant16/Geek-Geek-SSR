@extends('layouts.admin')
@section('title','Posts')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center bg-white rounded-3 p-3 shadow">
                <div class="">
                    <h4 class="mb-0">Posts</h4>
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
        <div class="col-12">
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
    </div>
</div>
@endsection
