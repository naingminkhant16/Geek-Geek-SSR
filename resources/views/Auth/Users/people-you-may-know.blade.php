<x-layout>
    <x-slot:title>People You May Know</x-slot:title>
    <div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <x-people-you-may-know-card :people="$people">
                    <div class="">
                        {{$people->onEachSide(1)->links()}}
                    </div>
                </x-people-you-may-know-card>
            </div>
        </div>
    </div>
</x-layout>
