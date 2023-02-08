<x-layout>
    <x-slot:title>
        Reset Password
    </x-slot:title>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-5">
            <div class="bg-white shadow rounded-3 p-4 p-lg-5">
                <div class="" style="">
                    <h3 class="text-center mb-4">
                        Reset Password
                    </h3>
                    <hr>
                    <form action="{{route('password.update')}}" method="POST" class="mt-4">
                        @csrf
                        <x-input label="Enter Email Address" name="email" :value="old('email')" />
                        <x-input label="Enter New Password" name="password" :value="old('password')" />
                        <x-input label="Enter Confirm Password" name="password_confirmation"
                            :value="old('password_confirmation')" />
                        <input type="hidden" value="{{$token}}" name="token">

                        <div class="mb-3">
                            <x-button label="Submit" color="primary" />
                        </div>
                    </form>
                    <div class="text-center">
                        <small class="">Enter Your Mail Address</small>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

</x-layout>