<x-layout>
    <x-slot:title>
        Followers
    </x-slot:title>
    <x-breadcrumb :links="$breadcrumb_links" />
    <div class="">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 mb-3">
                <x-people-you-may-know-card :people="$people" title="{{$user->name}}'s Followers" />
            </div>
        </div>
    </div>
</x-layout>