<x-layout>
    <x-slot:title>People You May Know</x-slot:title>
    <div class="container my-3" style="max-width:600px">
        <x-people-you-may-know-card :people="$people">
            <div class="">
                {{$people->onEachSide(1)->links()}}
            </div>
        </x-people-you-may-know-card>
    </div>
</x-layout>
