<x-layout>
    <x-slot:title>
        Register
    </x-slot:title>
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-lg-5">
            <div
                class="border bg-body-tertiary rounded-3 p-4 p-lg-5 d-flex align-items-center justify-content-center mb-3">
                <div class="" style="">
                    <h3 class="text-dark-emphasis text-center mb-4">Wanna Become a <span
                            class="text-white border p-2 rounded-3 bg-primary border-0 m-1">Geek</span>.
                        Register Now!
                    </h3>
                    <hr>
                    <form action="{{route('attemptRegister')}}" method="POST" class="mt-4">
                        @csrf
                        <x-input label="Your Geek's Name" name="name" :value="old('name')" />

                        <x-input label="Your Geek's Email" name="email" :value="old('email')" />

                        <x-input label="Your Geek's Password" name="password" type='password' />

                        <x-input label="Confirm Password" name="password_confirmation" type='password' />

                        <x-input label="Your Geek's BOD" name="date_of_birth" type='date'
                            :value="old('date_of_birth')" />
                        <div class="mb-3">
                            <x-button label="Register" color="primary" />
                        </div>
                    </form>
                    <div class="text-center">
                        <small class="">Already have an Account? <a href="{{route('login')}}"
                                class="text-primary">Login</a>
                            Now.</small>
                    </div>
                    <hr>
                    <x-oauth />
                </div>
            </div>
        </div>
    </div>

</x-layout>
