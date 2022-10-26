<x-layout>
    <x-slot:title>People You May Know</x-slot:title>
    <div class="container my-3" style="max-width:600px">
        <x-people-u-may-know-card :people="$people" :show="true" />
    </div>
</x-layout>
