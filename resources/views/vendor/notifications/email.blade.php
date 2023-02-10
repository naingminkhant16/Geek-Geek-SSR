<x-mail-layout>
    @slot("title")
    Reset Your <span style="color:#00BBF0">Password</span>.
    @endslot
    <div style="">
        <p style="font-weight: bold;text-align:center;">
            Please click the button below to reset your password.
        </p>
        <div style="text-align:center">
            <a href="{{$actionUrl}}" target="_blank"
                style="background-color:#00BBF0;color:#fff;padding:10px;border-radius:6px;font-weight:bold;text-decoration:none;">Reset
                Password</a>
        </div>
    </div>
</x-mail-layout>