<x-layout>
    <x-slot:title>{{Str::words($post->status,4)}}</x-slot:title>
    <div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <x-post-card :post="$post" :show="true" />
            </div>
        </div>
    </div>
</x-layout>
