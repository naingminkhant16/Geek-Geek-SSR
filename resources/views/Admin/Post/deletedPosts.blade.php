@extends('layouts.admin')
@section('title','Deleted Posts')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <x-admin.menuBar class="menuBar">
                <a href="{{route('admin.posts.index')}}" class="mb-0 text-decoration-none
                text-black-50
                ">
                    <span class="">
                        <i class="bi bi-file-post"></i>
                        Posts
                    </span>
                </a>
                <span class="text-black-50">|</span>
                <a href="{{route('admin.posts.deletedPosts')}}" class="mb-0 text-decoration-none text-primary">
                    <span class="">
                        Deleted Posts
                        <i class="bi bi-trash-fill"></i>
                    </span>
                </a>
            </x-admin.menuBar>
        </div>
        <div class="col-12">
            <div class="mt-3 shadow p-3 rounded-3 bg-white">
                @foreach ($deletedPosts as $post)
                <div class="row mb-3 align-items-center border-bottom p-3">
                    <div class="col-12 col-lg-4 mb-3 position-relative">
                        @if ($post->reportedPosts->count())
                        <span class="badge bg-danger float-start position-absolute z-3"
                            style="transform:rotate(-45deg);left:0%;top:8%">
                            {{$post->reportedPosts->count()}} Reported
                        </span>
                        @endif
                        @if ($post->photos->count())
                        <div id="photo{{$post->id}}" class="carousel slide" style="max-width: 320px;"
                            data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($post->photos as $photo)
                                <div class="carousel-item @if($loop->first) active @endif">
                                    <a href="{{asset('storage/'.$photo->name)}}" class="venobox">
                                        <img src="{{asset('storage/'.$photo->name)}}" class="d-block w-100 rounded"
                                            style="height:180px;object-fit:cover;">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            @if ($post->photos->count()>1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#photo{{$post->id}}"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#photo{{$post->id}}"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                            @endif
                        </div>
                        @else
                        <div class="bg-dark d-flex justify-content-center align-items-center opacity-50 rounded-3"
                            style="max-width:320px;height:180px;">
                            <p class=" text-white mb-0">No Photos</p>
                        </div>
                        @endif
                    </div>
                    <div class="col-12 col-lg-2"></div>
                    <div class="col-12 col-lg-6">
                        <p class="text-black-50" style="text-align: justify">
                            {{Str::words($post->status, 80, '...')}}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <form action="{{route('admin.posts.restore',$post->id)}}" class="d-none" method="POST"
                                    id="restorePost{{$post->id}}">
                                    @csrf
                                    @method('PATCH')
                                </form>
                                <button form="restorePost{{$post->id}}" type="submit"
                                    class="text-decoration-none btn btn-sm btn-success me-1">
                                    <i class="bi bi-arrow-clockwise  text-white"></i>
                                </button>


                                {{-- to see reported msg with modal box --}}
                                @if ($post->reportedPosts->count())
{{--                                    @dd($post->reportedPosts->count())--}}
                                <button type="button" data-bs-toggle="modal" data-bs-target="#reportInfo{{$post->id}}"
                                    class="btn btn-danger btn-sm text-white"><i
                                        class="bi bi-exclamation-triangle-fill"></i></button>
                                <x-modal id="reportInfo{{$post->id}}">
                                    @slot('title')
                                    <span class="text-danger">Report Info</span>
                                    @endslot
                                    @foreach ($post->reportedPosts as $reportedPost)
                                    <div class="border p-3 rounded-3 mb-3">
                                        <small class="text-black-50">Reporter :</small>
                                        <p class="mb-0">{{$reportedPost->reporter->name}}</p>

                                        <small class="text-black-50">Reported Message :</small>
                                        <p class="mb-0" style="text-align: justify">{{$reportedPost->message}}</p>
                                    </div>
                                    @endforeach
                                </x-modal>
                                @endif
                                <form action="{{route('admin.posts.destroy',$post->id)}}" class="d-none" method="POST"
                                    id="deletePost{{$post->id}}">
                                    @csrf
                                    @method('delete')
                                </form>
                                <button form="deletePost{{$post->id}}" type="submit"
                                    class="text-decoration-none btn btn-sm btn-danger me-1">
                                    <i class="bi bi-trash-fill text-white"></i>
                                </button>
                            </div>
                            <div class="text-center">
                                <small class="text-black-50 mb-0 d-block">Owner - {{$post->user->name}}</small>
                                <small class="text-black-50 mb-0">{{$post->created_at->diffForHumans()}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="">
                    {{$deletedPosts->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
