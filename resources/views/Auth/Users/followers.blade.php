<x-layout>
    <x-slot:title>
        Followers
    </x-slot:title>
    <div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <x-people-you-may-know-card :people="$people" title="{{$user->name}}'s Followers" />
            </div>
        </div>
    </div>
</x-layout>
