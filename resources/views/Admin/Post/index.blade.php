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
                    <form action="">
                        <input type="text" class="form-control" name="search" placeholder="Search Posts">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">

        </div>
    </div>
</div>
@endsection
