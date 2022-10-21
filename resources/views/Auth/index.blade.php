<x-layout>
    <x-slot:title>Home</x-slot:title>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">

            </div>
            <div class="col-lg-6">
                <div class="d-flex mt-3 justify-content-center">
                    <div style="width: 600px">
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
            <div class="col-lg-3">

            </div>
        </div>
    </div>
</x-layout>
