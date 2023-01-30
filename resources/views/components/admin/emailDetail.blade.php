@props(['email'])
<div class="p-3 border rounded-3">
    <div class="row justify-content-between align-items-center mb-3">
        <div class="col-lg-6 d-flex align-items-end">
            <x-avatar :path="$email->user->profile??'default_pp.png'" width="38" />
            <div>
                <p class="mb-0 fs-4"> {{$email->subject}}</p>
                <small class="text-black-50 d-block">
                    From : < {{$email->sender}} >
                </small>
                <small class="text-black-50">
                    To : < {{$email->recipient}} >
                </small>
            </div>
        </div>
        <div class="col-lg-6 text-end">
            <small class="text-black-50">{{$email->created_at->diffForHumans()}}</small>
        </div>
    </div>
    <div class="">
        <p class="" style="text-align: justify">{{$email->body}}</p>
        @isset($email->attach_files)
        <div class="mb-3 text-end">
            <small class="text-primary">Attachments ({{count($email->attach_files)}})</small>
        </div>
        <div class="d-flex flex-wrap justify-content-center justify-content-lg-start">
            @foreach ($email->attach_files as $file)
            @php
            $extension= explode(".",$file)[1];
            @endphp
            @if ($extension=="pdf")
            <div class="mb-1 me-lg-1">
                <iframe src="{{asset('storage/mail_files/'.$file)}}" class="rounded" type="application/pdf"
                    frameBorder="0" scrolling="auto" height="300" width="300"></iframe>
            </div>
            @else
            <div class="mb-1 me-lg-1" style="width: 300px;height:300px;">
                <a href="{{asset('storage/mail_files/'.$file)}}" class="venobox">
                    <img src="{{asset('storage/mail_files/'.$file)}}" class="rounded" style="object-fit: cover"
                        width="300" height="300">
                </a>
            </div>
            @endif

            @endforeach
        </div>
        @endisset
    </div>
</div>
{{-- Replies Section --}}
<div class="">
    @forelse ($email->emailReplies as $reply)
    <div class="border p-3 rounded-3 mt-3">
        <div class="d-flex justify-content-between mb-1">
            <small class="text-black-50">
                Reply To : < {{$email->recipient}} >
            </small>
            <small class="text-black-50">{{$reply->created_at->diffForHumans()}}</small>
        </div>
        <p class="" style="text-align: justify">{{$reply->body}}</p>
        @isset($reply->attach_files)
        <div class="mb-3 text-end">
            <small class="text-primary">Attachments ({{count($reply->attach_files)}})</small>
        </div>
        <div class="d-flex flex-wrap justify-content-center justify-content-lg-start">
            @foreach ($reply->attach_files as $file)
            @php
            $extension= explode(".",$file)[1];
            @endphp
            @if ($extension=="pdf")
            <div class="mb-1 me-lg-1">
                <iframe src="{{asset('storage/mail_files/'.$file)}}" class="rounded" type="application/pdf"
                    frameBorder="0" scrolling="auto" height="300" width="300"></iframe>
            </div>
            @else
            <div class="mb-1 me-lg-1" style="width: 300px;height:300px;">
                <a href="{{asset('storage/mail_files/'.$file)}}" class="venobox">
                    <img src="{{asset('storage/mail_files/'.$file)}}" class="rounded" style="object-fit: cover"
                        width="300" height="300">
                </a>
            </div>
            @endif

            @endforeach
        </div>
        @endisset
    </div>
    @empty

    @endforelse


</div>
