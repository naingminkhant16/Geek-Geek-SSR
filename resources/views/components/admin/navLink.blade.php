@php
// $currentUri= collect(explode('/',url()->current()))->last();
$currentUrl= url()->current();
@endphp
<div class="text-center">
    <a href="{{route('dashboard.index')}}" class="d-block p-3 rounded-3 text-decoration-none  dashboard-link mx-5 @if ($currentUrl===route('dashboard.index'))
text-white
@else
text-white-50
        @endif">
        <i class="bi bi-bar-chart-fill"></i>
        Dashboard</a>
    <a href="{{route('admin.posts.index')}}" class="d-block p-3 rounded-3 text-decoration-none  dashboard-link  mx-5 @if ($currentUrl===route('admin.posts.index'))
        text-white
        @else
        text-white-50
                @endif">
        <i class="bi bi-file-post"></i>
        Posts</a>
    <a href="" class="d-block p-3 rounded-3 text-decoration-none dashboard-link  mx-5 @if ($currentUrl==='')
    text-white
    @else
    text-white-50
            @endif">
        <i class="bi bi-people-fill"></i>
        Users</a>
    <a href="" class="d-block p-3 rounded-3 text-decoration-none dashboard-link  mx-5 @if ($currentUrl==='')
    text-white
    @else
    text-white-50
            @endif">
        <i class="bi bi-envelope-open-fill"></i>
        Emails</a>
</div>
