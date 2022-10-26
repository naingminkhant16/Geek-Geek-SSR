<x-layout>
    <x-slot:title>{{Str::words($post->status,4)}}</x-slot:title>
    <div class="container my-3" style="max-width: 600px">
        <x-post-card :post="$post" :show="true" />
    </div>
</x-layout>
