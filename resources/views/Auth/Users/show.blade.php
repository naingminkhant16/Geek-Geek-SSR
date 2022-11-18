<x-layout>
    <x-slot:title>
        {{$user->username}}
    </x-slot:title>
    <x-breadcrumb :links="$breadcrumb_links" />
    <div class="">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <x-profile-preview-card :user="$user" />
                <div class="mt-3">
                    @foreach ($user->posts as $post)
                    <x-post-card :post="$post" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layout>
