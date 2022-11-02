<x-layout>
    <x-slot:title>
        Register
    </x-slot:title>
    <div class="container-fluid bg-dark vh-100 d-flex align-items-center justify-content-center">
        <div class="" style="max-width: 420px">
            <h3 class="text-white text-center mb-4">Want To Become a <span
                    class="text-dark border p-2 rounded rounded-2 bg-white border-0 m-1">Geek</span>.
                Register Now!
            </h3>
            <hr class="text-white">
            <form action="{{route('attemptRegister')}}" method="POST" class="mt-4">
                @csrf
                <x-input label="Your Geek's Name" name="name" :value="old('name')" />

                <x-input label="Your Geek's Email" name="email" :value="old('email')" />

                <x-input label="Your Geek's Password" name="password" type='password' />

                <x-input label="Confirm Password" name="password_confirmation" type='password' />

                <x-input label="Your Geek's BOD" name="date_of_birth" type='date' :value="old('date_of_birth')" />
                <div class="mb-3">
                    <x-button label="Register" color="primary" />
                </div>
            </form>
            <div class="text-center">
                <small class="text-white">Already have an Account? <a href="{{route('login')}}"
                        class="text-primary">Login</a>
                    Now.</small>
            </div>
            <hr class="text-white">
            <x-oauth />
        </div>
    </div>
</x-layout>
