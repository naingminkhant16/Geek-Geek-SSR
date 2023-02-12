<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email From Geek</title>
    <style>
        body,
        body *:not(html):not(style):not(br):not(tr):not(code) {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
                'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            position: relative;
        }

        body {
            -webkit-text-size-adjust: none;
            background-color: #ffffff;
            color: #718096;
            height: 100%;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            width: 100% !important;
        }
    </style>
</head>

<body>
    <div style="max-width: 600px;margin:20px auto">
        <div
            style="font-size: 38px;text-align:center;margin:24px auto;border-radius:10px;background-color:#00BBF0;color:#fff;max-width:140px;padding:10px;font-weight:bold">
            Geek
        </div>
        <P style="text-align: center;margin-top:40px;font-size:18px;font-weight:bold;">{{$title??"Mail From Geek"}}</P>
        <p style="font-weight: bolder;font-size:20px;margin-top:40px">Hello <span style="color:#00BBF0">Geek</span>,
        </p>
        <div style="text-align:center;margin-top:40px;margin-bottom:30px">
            {{$slot}}
        </div>
        <p style="font-weight: 200;font-size:16px;margin-top:40px;">Best Regards,
        </p>
        <span>Admin Team</span>
    </div>
</body>

</html>