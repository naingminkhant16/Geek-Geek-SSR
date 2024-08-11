<x-layout>
    <x-slot:title>
        Developer Profile
    </x-slot:title>
    <div class="border bg-body-tertiary rounded-3 p-4 p-lg-5 mt-0 mb-3">
        <h2 class="text-center text-dark-emphasis">About the Creator</h2>
        <p class="text-center text-body-secondary">Brief story about the creator.</p>

        <div class="row border p-0 p-lg-3 rounded-3 mt-lg-5">
            <div class="col-lg-4 mt-3">
                <div class="p-2 border border-4 border-primary">
                    <img src="{{asset('storage/dev_profile.jpg')}}" alt="" class="img-fluid ">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="" style="">
                    <h3 class="mt-3 mb-4 text-dark-emphasis">Hello, I'm <span class="text-primary">Naing Min
                            Khant</span>. </h3>
                    <div class="text-body" style="text-align: justify">
                        You can call me Thar Khant. I'm 22 years old Web Developer and
                        currently studying BSc in Computer Science at BUC. I'm interested in Backend
                        Development and currently learning Java, Spring Boot, and React. My
                        career aspiration is to become a Software Engineer in the future.
                    </div>
                    <div class="mt-4">
                        <p><span class="fw-bold">Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </span><span
                                class="text-body-secondary">Naing
                                Min
                                Khant</span> </p>

                        <p><span class="fw-bold">Age &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                            </span>
                            <span class="text-body-secondary">22</span>
                        </p>

                        <p><span class="fw-bold">Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </span><a
                                href="mailto:tharkhant777@gmail.com"
                                class="text-primary email">tharkhant777@gmail.com</a></p>

                        <p><span class="fw-bold">Phone &nbsp;&nbsp;&nbsp;&nbsp;: </span> <span
                                class="text-body-secondary">+959 952 128 314</span> </p>

                        <p><span class="fw-bold">From&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </span><span
                                class="text-body-secondary"> Yangon, Myanmar</span></p>
                    </div>
                    <div class="mb-3 mb-lg-0 mt-4">
                        <a href="https://nmk.netlify.app/#/" target="blank" class="btn  btn-primary text-white">Visit
                            Me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
