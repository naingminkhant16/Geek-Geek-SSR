<x-layout>
    <x-slot:title>
        Login
    </x-slot:title>
    <div class="container-fluid bg-dark vh-100 d-flex align-items-center justify-content-center">
        <div class="" style="max-width: 420px">
            <h3 class="text-white text-center mb-4">Be Ready To <span
                    class="text-dark border p-2 rounded rounded-2 bg-white border-0 m-1">Geek</span>.
                Login Now!
            </h3>
            <hr class="text-white">
            <form action="{{route('attemptLogin')}}" method="POST" class="mt-4">
                @csrf
                <x-input label="Your Geek's Email" name="email" :value="old('email')" error="email">
                </x-input>
                <x-input label="Your Geek's Password" name="password" error="password" type='password'></x-input>
                <div class="mb-3">
                    <x-button label="Login" color="primary"></x-button>
                </div>
            </form>
            <div class="text-center">
                <small class="text-white">No Account? <a href="{{route('register')}}" class="text-primary">Register</a>
                    Now.</small>
            </div>
        </div>
    </div>
</x-layout>
