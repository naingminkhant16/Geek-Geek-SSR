<x-layout>
    <x-slot:title>
        Contact Us
    </x-slot:title>
    <div class="bg-white shadow rounded-3 p-4 p-lg-5 mt-0 mt-lg-5 mb-3">
        <h2 class="text-center">Contact Us</h2>
        <p class="text-center text-black-50">Any question or remarks? Just leave a message.</p>

        <div class="row border p-0 p-lg-3 rounded-3 mt-lg-5">
            <div class="col-lg-6 mt-3">
                <div class="d-flex flex-column justify-content-between align-item-center w-100 h-100  p-3 rounded-3 ">
                    <div>
                        <h4>Contact Information</h4>
                        <p class="text-black-50">You can also contact from the information below.</p>
                        <hr>
                    </div>
                    <div class="text-black-50">
                        <p class="mb-5"><i class="bi bi-telephone-fill me-3"></i> +959 123 456 789</p>
                        <p class="mb-5"><i class="bi bi-envelope-fill me-3"></i> tharkhant777@gmail.com</p>
                        <p class="mb-5"><i class="bi bi-geo-alt-fill me-3"></i> South Okkalapa Township, Yangon, Myanmar
                        </p>
                    </div>
                    <div class="">
                        <a href="https://www.facebook.com/TharKhant.734/" target="blank"> <i
                                class="bi bi-facebook fs-3 me-3"></i></a>
                        <a href="https://github.com/naingminkhant16" target="blank">
                            <i class="bi bi-github fs-3 me-3"></i></a>
                        <a href="https://www.linkedin.com/in/naing-min-khant/" target="blank">
                            <i class="bi bi-linkedin fs-3 me-3"></i></a>
                        <a href="https://nmk.netlify.app/#/" target="blank">
                            <i class="bi bi-link-45deg fs-3 me-3"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="" style="">
                    <p class="text-black-50 ">Leave your message here.</p>
                    <form action="{{route('contact-us.store')}}" method="POST" class="">
                        @csrf
                        <x-input label="Your Name" name="name" :value="old('name')" />

                        <x-input label="Your Email" name="email" type='email' />
                        <div class="mb-3">
                            <textarea name="message" id="" class="form-control @error('message')
                                is-invalid  @enderror" cols="30" rows="10"
                                placeholder="Write a message...">{{old('message')}}</textarea>
                            @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong class="">*{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="">
                            <x-button label="Submit" color="primary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>