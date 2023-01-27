@extends('layouts.admin')
@section('title','Emails')
@section('content')
<div class="container-fluid">
    <x-admin.menuBar>
        <p class="mb-0 text-primary">
            <i class="bi bi-envelope-open-fill"></i>
            Emails
        </p>
    </x-admin.menuBar>
    <div class="mt-3 rounded-3 shadow bg-white p-3">
        @foreach ($emails as $email)
        <x-admin.singleEmail :email="$email" />
        @endforeach
        <div class="mt-3">
            {{$emails->links()}}
        </div>
    </div>
    <a href="{{route('admin.emails.create')}}"
        class="rounded-pill bg-primary text-white text-decoration-none px-4 py-3 position-fixed"
        style="right:30px;bottom:30px;font-size:18px">
        <i class="bi bi-pencil-fill"></i> Compose
    </a>
</div>
@endsection
