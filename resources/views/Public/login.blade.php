<x-layout>
    <x-slot:title>
        Login
    </x-slot:title>
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-lg-5">
            <div class="bg-white shadow d-flex align-items-center justify-content-center rounded-3 p-4 p-lg-5 ">
                <div class="" style="">
                    <h3 class="text-center mb-4">Be Ready To <span
                            class="text-white border p-2 rounded-3 bg-primary border-0 m-1">Geek</span>.
                        Login Now!
                    </h3>
                    <hr>
                    <form action="{{route('attemptLogin')}}" method="POST" class="mt-4">
                        @csrf
                        <x-input label="Your Geek's Email" name="email" :value="old('email')" />

                        <x-input label="Your Geek's Password" name="password" type='password' />

                        <div class="mb-3">
                            <x-button label="Login" color="primary" />
                        </div>
                    </form>
                    <div class="text-center">
                        <small class="">No Account? <a href="{{route('register')}}"
                                class="text-primary text-decoration-none">Register</a>
                            Now.
                            <a href="{{route('password.request')}}" class="text-primary text-decoration-none">
                                Forgot Password?
                            </a>
                        </small>
                    </div>
                    <hr>
                    <x-oauth />
                </div>
            </div>
        </div>
    </div>

</x-layout>