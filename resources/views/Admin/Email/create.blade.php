@extends('layouts.admin')
@section('title','Send Email')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-start bg-white rounded-3 p-3 shadow">
        <div class="">
            <a href="{{route('admin.emails.index')}}" class="text-black-50 text-decoration-none"><i
                    class="bi bi-arrow-left"></i>
                <i class="bi bi-envelope-open-fill"></i> Emails |
            </a>
            <span class="text-primary">
                Compose Mail
                <i class="bi bi-envelope-plus-fill"></i>
            </span>
        </div>
    </div>
    <div class="mt-3 rounded-3 shadow bg-white p-3">
        <div class="container" style="max-width: 680px">
            <p class="text-black-50">Compose Mail <i class="bi bi-send-fill"></i></p>
            <form action="{{route('admin.emails.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <x-input type="email" name="recipient" label="Recipient Mail"
                    :value="request('recipient_mail')??old('recipient')" />

                <x-input name="subject" label="Subject" :value="old('subject')" />

                <div class="form-floating mb-3">
                    <textarea class="form-control  @error('body') is-invalid @enderror" placeholder="Leave a body here"
                        name="body" style="height: 400px" id="floatingTextarea">{{old('body')}}</textarea>
                    <label for="floatingTextarea">Write Mail Here...</label>

                    @error('body')
                    <span class="invalid-feedback" role="alert">
                        <strong class="">*{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="files" class="form-label">Choose Attach Files</label>
                    <input type="file" name="files[]" multiple
                        class="form-control  @error('files.*') is-invalid @enderror">

                    @error('files.*')
                    <span class="invalid-feedback" role="alert">
                        <strong class="">*{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="text-end">
                    <button class="btn btn-primary text-white" type="submit">
                        Send<i class="bi bi-send-fill"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
