@extends('layouts.admin')
@section('title','Emails')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-start bg-white rounded-3 p-3 shadow">
        <div class="">
            <a href="{{route('admin.emails.index')}}" class="text-black-50 text-decoration-none"><i
                    class="bi bi-arrow-left"></i>
                <i class="bi bi-envelope-open-fill"></i> Emails |
            </a>
            <span class="text-primary">
                {{$email->subject}}
            </span>
        </div>
    </div>
    <div class="mt-3 rounded-3 shadow bg-white p-3">
        <x-admin.emailDetail :email="$email" />
        <a href="{{route('admin.emails.reply.create',$email->id)}}"
            class="rounded-pill bg-primary text-white  text-decoration-none px-4 py-3 position-fixed"
            style="right:30px;bottom:30px;font-size:18px">
            <i class="bi bi-arrow-90deg-left"></i> Reply
        </a>
    </div>
</div>
@endsection
