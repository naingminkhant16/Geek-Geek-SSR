<x-layout>
    <x-slot:title>
        Change Password
    </x-slot:title>
    <x-breadcrumb :links="$breadcrumb_links" />


    <div class="">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="border bg-body-tertiary p-4 rounded-3">
                    <h3 class="text-dark-emphasis">Change Your Password</h3>
                    <hr>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{route('users.changePassword.change')}}" method="POST" id="">
                        @csrf

                        <x-input type="password" name="current_password" label="Current Password"
                            :value="old('current_password')" />

                        <x-input type="password" name="password" label="New Password" />

                        <x-input type="password" name="password_confirmation" label="Confirm Password" />

                        <div class="mb-3 text-end">
                            <a class="btn btn-danger text-white" href="/">Cancel</a>
                            <button type="submit" class="btn btn-primary text-white">Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>