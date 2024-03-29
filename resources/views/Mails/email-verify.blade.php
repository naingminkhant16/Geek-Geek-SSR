<x-mail-layout>
    @slot("title")
    Please Verify Your <span style="color:#00BBF0">Email</span>.
    @endslot
    <div style="">
        <p style="font-weight: bold;text-align:center;">
            Please click the button below to verify your email in order to login.
        </p>
        <div style="text-align:center">
            <a href="{{route('emailVerify',[$user->id??1,$token??1000])}}"
                style="background-color:#00BBF0;color:#fff;padding:10px;border-radius:6px;font-weight:bold;text-decoration:none;">Verify</a>
        </div>
    </div>
</x-mail-layout>
