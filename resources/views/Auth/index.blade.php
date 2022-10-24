<x-layout>
    <x-slot:title>Home</x-slot:title>
    <div class="container-fluid">
        <div class="row">
            <div class="d-none d-lg-block col-lg-4">
                <div class="mt-3 d-flex justify-content-end">
                    <div class="w-50">
                        <x-profile-preview-card />
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex mt-3 justify-content-center">
                    <div class="w-100 overflow-auto" style="height: 820px">
                        <div class="bg-white p-3 rounded shadow w-100">
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
                        @foreach ($posts as $post)
                        <x-post-card :post="$post" />
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block  col-lg-4">
                <div class="mt-3 d-flex justify-content-start">
                    <div class="w-50">
                        <x-people-u-may-know-card :people="$people" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
