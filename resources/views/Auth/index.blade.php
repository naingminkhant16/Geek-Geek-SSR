<x-layout>
    <x-slot:title>Home</x-slot:title>
    <div class=" bg-primary p-5">I am back!!</div>
    <div class="bg-secondary p-5 text-white">I am back!!</div>
    <div class="bg-dark p-5 text-white">I am back!!</div>

    <h1>Auth user</h1>
    {{Auth::user()->name}}
    <hr>
    <h1>Followers</h1>
    @foreach (App\Models\User::first()->followers as $f)
    <p> {{$f->name}}</p>
    @endforeach

    <hr>

    <h1>Followings</h1>
    @foreach (App\Models\User::find(2)->followings as $f)
    <p> {{$f->posts}}</p>
    @endforeach
</x-layout>
