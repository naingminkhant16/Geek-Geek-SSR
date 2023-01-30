@extends('layouts.admin')
@section('title','Send Email')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-start bg-white rounded-3 p-3 shadow">
        <div class="">
            <a href="{{route('admin.emails.show',$email->id)}}" class="text-primary text-decoration-none"><i
                    class="bi bi-arrow-left"></i>
                <i class="bi bi-envelope-open-fill"></i> {{$email->subject}}
            </a>
        </div>
    </div>
    <div class="mt-3 rounded-3 shadow bg-white p-3">
        <div class="container" style="max-width: 680px">
            <p class="text-black-50 mb-1">
                Subject : {{$email->subject}}
            </p>
            <p class="text-black-50">
                Reply To : <i class="bi bi-arrow-90deg-left"></i>
                < {{$email->recipient}} >
            </p>

            <form action="{{route('admin.emails.reply.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$email->id}}" name="email_id">

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
