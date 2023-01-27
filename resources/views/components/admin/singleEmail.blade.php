@props(['email'])
<div class="email mb-1 border p-3 rounded-3">
    <div class="d-flex justify-content-between align-items-center mb-1">
        <div class="d-flex align-items-center">
            <x-avatar :path="$email->user->profile??'default_pp.png'" width="38" />
            <div>
                <a href="{{route('admin.emails.show',$email->id)}}" class="text-decoration-none text-black">
                    <small class="d-block">{{\Str::words($email->subject,5,'...')}}</small></a>
                <small class="text-black-50">To : < {{$email->recipient}} ></small>
            </div>
        </div>
        <div class="d-none d-lg-block">
            @isset($email->attach_files)
            <small class="text-primary">Attachments ({{count($email->attach_files)}})</small><br>
            @endisset
            <small class="text-black-50">{{$email->created_at->diffForHumans()}}</small>
        </div>
    </div>
    <div class="">
        <small class="text-black-50 mb-1" style="text-align: justify">
            {{\Str::words($email->body,20,'...')}}
        </small>
    </div>
    <div class="d-flex justify-content-between mt-1 d-lg-none">
        @isset($email->attach_files)
        <small class="text-primary">Attachments ({{count($email->attach_files)}})</small>
        @endisset
        <small class="text-black-50">{{$email->created_at->diffForHumans()}}</small>
    </div>
</div>
