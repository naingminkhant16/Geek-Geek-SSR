<x-layout>
    <x-slot:title>Home</x-slot:title>
    <div class="container-fluid">
        <div class="row">
            <div class="d-none d-lg-block col-lg-4">
                <div class="mt-3 d-flex justify-content-end">
                    <div class="" style="width: 300px">
                        <x-profile-preview-card />
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex mt-3 justify-content-center">
                    <div class="w-100 overflow-auto" style="height: 820px">
                        <div class="bg-white p-3 rounded shadow w-100 mb-3">
                            <h6 class="border-bottom pb-2 mb-2">Post Something</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <x-avatar :path="Auth::user()->profile" />
                                    <span class="text-black-50" onclick="">
                                        What's on your mind today?</span>
                                </div>
                                <a href="{{route('posts.create')}}" class="btn btn-primary text-white">
                                    Let's Share
                                </a>
                            </div>
                        </div>
                        @if ($posts->count())
                        <div>
                            @foreach ($posts as $post)
                            <x-post-card :post="$post" />
                            @endforeach
                        </div>
                        @else
                        <div class="text-center p-3  text-black-50">No Post Yet! </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block  col-lg-4">
                <div class="mt-3 d-flex justify-content-start">
                    <div class="" style="width: 300px">
                        <x-people-you-may-know-card :people="$people">
                            <a href="{{route('users.peopleYouMayKnow')}}" class="text-black-50 text-decoration-none">
                                <small>View More Friends <i class="bi bi-caret-down-fill"></i></small></a>
                        </x-people-you-may-know-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
