<x-layout>
    <x-slot:title>Search</x-slot:title>
    <x-breadcrumb :links="$bradcrumb_links" />
    <div class="">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <x-people-you-may-know-card :people="$users" title="Users related with '{{request('search')}}'" />
                </div>
                <div class="">
                    <div class="bg-white text-black p-3 rounded shadow mb-3">
                        <h5 class="mb-0">Posts related with '{{request('search')}}'</h5>
                        <hr class="">
                        @forelse ($posts as $post)
                        <x-post-card :post="$post"></x-post-card>

                        @empty
                        <div class="text-center text-black-50">
                            No Posts!
                        </div>
                        @endforelse
                    </div>
                    <div class="">
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
