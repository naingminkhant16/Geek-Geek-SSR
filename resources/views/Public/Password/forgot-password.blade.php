<x-layout>
    <x-slot:title>
        Forgot Password
    </x-slot:title>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-5">
            <div class="bg-body-tertiary rounded-3 p-4 p-lg-5">
                <div class="" style="">
                    <h3 class="text-center mb-4 text-dark-emphasis">
                        Forgot Password
                    </h3>
                    <hr>
                    @if (Session::has('success'))
                    <p class="text-success">Reset Password link is sent to your mail.</p>
                    @elseif (Session::has('error'))
                    <p class="">Opps, failed to send mail! Try Again.</p>
                    @endif
                    <form action="{{route('password.email')}}" method="POST" class="">
                        @csrf
                        <x-input label="Enter Email Address" name="email" :value="old('email')" />

                        <div class="mb-3">
                            <x-button label="Submit" color="primary" />
                        </div>
                    </form>
                    <div class="text-center">
                        <small class="text-body-secondary">Enter Your Mail Address Or <a href="{{route('login')}}"
                                class=" text-primary">Login</a></small>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

</x-layout>
