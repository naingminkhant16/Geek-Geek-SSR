<x-layout>
    <x-slot:title>Home</x-slot:title>
    <x-breadcrumb :links="$breadcrumb_links" />
    <div class="">
        <div class="row g-0">
            <div class="d-none d-lg-block col-lg-3">
                <div class="d-flex justify-content-end">
                    <div class="w-100 px-3">
                        <x-profile-preview-card />
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex justify-content-center">
                    <div class="w-100 overflow-auto px-lg-3" style="height: 820px">
                        <div class="bg-body-tertiary p-3 rounded-3 border w-100 mb-3">
                            <h6 class="border-bottom pb-2 mb-2 text-dark-emphasis">Share Something</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <x-avatar :path="Auth::user()->profile" />
                                    <span class="ms-2 text-body-secondary" onclick="">
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
                        <div class="text-center p-3  text-body-secondary">No Post Yet! </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block  col-lg-3">
                <div class="d-flex justify-content-start">
                    <div class="w-100 px-3">
                        <x-people-you-may-know-card :people="$people">
                            <a href="{{route('users.peopleYouMayKnow')}}"
                                class="text-body-secondary text-decoration-none">
                                <small>View More Friends <i class="bi bi-caret-down-fill"></i></small></a>
                        </x-people-you-may-know-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
