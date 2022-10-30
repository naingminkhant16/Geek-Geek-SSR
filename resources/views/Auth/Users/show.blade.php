<x-layout>
    <x-slot:title>
        {{$user->username}}
    </x-slot:title>
    <div class="my-3 container" style="max-width: 600px">
        <x-profile-preview-card :user="$user" />
        <div class="mt-3">
            @foreach ($user->posts as $post)
            <x-post-card :post="$post" />
            @endforeach
        </div>
    </div>
</x-layout>
