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
        @foreach ($mails as $mail)
        <div class=" mb-1 border p-3 rounded-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <div class="d-flex align-items-center">
                    <x-avatar :path="$mail->user->profile??'default_pp.png'" width="38" />
                    <div>
                        <a href="" class="text-decoration-none text-black">
                            <small class="d-block">{{\Str::words($mail->subject,5,'...')}}</small></a>
                        <small class="text-black-50">to : {{$mail->recipient}}</small>
                    </div>
                </div>
                <div class="d-none d-lg-block">
                    @isset($mail->attach_files)
                    <small class="text-primary">Attachments ({{count($mail->attach_files)}})</small><br>
                    @endisset
                    <small class="text-black-50">{{Auth::user()->created_at->diffForHumans()}}</small>
                </div>
            </div>
            <div class="">
                <small class="text-black-50 mb-1" style="text-align: justify">
                    {{\Str::words($mail->body,20,'...')}}
                </small>
            </div>
            <div class="d-flex justify-content-between mt-1 d-lg-none">
                @isset($mail->attach_files)
                <small class="text-primary">Attachments ({{count($mail->attach_files)}})</small>
                @endisset
                <small class="text-black-50">{{Auth::user()->created_at->diffForHumans()}}</small>
            </div>
        </div>
        @endforeach
        <div class="mt-3">
            {{$mails->links()}}
        </div>
    </div>
    <a href="{{route('admin.emails.create')}}"
        class="rounded-pill bg-primary text-white text-decoration-none px-4 py-3 position-fixed"
        style="right:30px;bottom:30px;font-size:18px">
        <i class="bi bi-pencil-fill"></i> Compose
    </a>
</div>
@endsection
