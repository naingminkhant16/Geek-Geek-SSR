<x-layout>
    <x-slot:title>
        Followers
    </x-slot:title>
    <div class="container my-3" style="max-width:600px">
        <x-people-you-may-know-card :people="$people" title="Your Followers" />
    </div>
</x-layout>