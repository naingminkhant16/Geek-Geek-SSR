<x-layout>
    <x-slot:title>
        Followings
    </x-slot:title>
    <div class="container my-3" style="max-width:600px">
        <x-people-you-may-know-card :people="$people" title="Your Followings" />
    </div>
</x-layout>