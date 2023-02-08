<x-layout>
    <x-slot:title>
        Forgot Password
    </x-slot:title>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-5">
            <div class="bg-white shadow rounded-3 p-4 p-lg-5">
                <div class="" style="">
                    <h3 class="text-center mb-4">
                        Forgot Password
                    </h3>
                    <hr>
                    <form action="{{route('password.email')}}" method="POST" class="mt-4">
                        @csrf
                        <x-input label="Enter Email Address" name="email" :value="old('email')" />

                        <div class="mb-3">
                            <x-button label="Submit" color="primary" />
                        </div>
                    </form>
                    <div class="text-center">
                        <small class="">Enter Your Mail Address Or <a href="{{route('login')}}"
                                class=" text-decoration-none text-primary">Login</a></small>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

</x-layout>