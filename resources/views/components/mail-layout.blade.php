<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email From Geek</title>
</head>

<body>
    <div style="max-width: 600px;margin:20px auto">
        <div
            style="font-size: 56px;text-align:center;margin:24px auto;border-radius:10px;background-color:#00BBF0;color:#fff;max-width:140px;padding:10px;font-weight:bold">
            Geek
        </div>
        <h1 style="text-align: center;margin-top:40px">{{$title??"Mail From Geek"}}</h1>
        <p style="font-weight: bolder;font-size:20px;margin-top:40px">Hello <span style="color:#00BBF0">Geek</span>,
        </p>
        <div style="text-align:justify;margin-top:40px;margin-bottom:30px">
            {{$slot}}
        </div>
        <p style="font-weight: 200;font-size:16px;margin-top:40px;">Best Regards,
        </p>
        <span>Admin Team</span>
    </div>
</body>

</html>
