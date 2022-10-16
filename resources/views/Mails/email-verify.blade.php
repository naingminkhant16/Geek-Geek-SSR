<x-mail-layout>
    <div style="">
        <p style="font-weight: bold;text-align:center;margin-bottom:30px">
            Please click the button below to verify your email in order to login.
        </p>
        <div style="text-align:center">
            <a href="{{route('emailVerify',[$user->id??1,$token??1000])}}"
                style="background-color:#005972;color:#fff;padding:10px;border-radius:6px;font-weight:bold;text-decoration:none;">Verify</a>
        </div>
    </div>
</x-mail-layout>
