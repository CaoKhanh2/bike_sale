<!DOCTYPE html>
<html lang="en">

@php
    $expires_verify = now()->addMinutes(2);
    $url = URL::temporarySignedRoute('thuchien-xacnhan-mail-Guest', $expires_verify, ['id' => $acc->mand]);
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thư xác nhận tài khoản</title>
    <style>
        
        body,html {
            font-family: Arial, Helvetica, sans-serif;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .shadow {
            box-shadow: 0px 4px 6px hsla(0, 0%, 0%, 0.1);
        }

        .p-3 {
            padding: 1rem;
        }

        .mb-5 {
            margin-bottom: 3rem;
        }

        .bg-body-tertiary {
            background-color: hsl(210, 17%, 98%);
        }

        .rounded {
            border-radius: 0.25rem;
        }

        .my-3 {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        #img-banner {
            width: 100%;
            height: auto;
            display: block;
            margin: auto;
            max-height: 100%;
            max-width: 100%;
            object-fit: cover;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-gray-600 {
            color: hsl(208, 7%, 46%);
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            color: hsl(0, 0%, 100%);
            background-color: hsl(211, 100%, 50%);
            border-color: hsl(211, 100%, 50%);
            text-decoration: none;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            color: hsl(0, 0%, 100%);
            background-color: hsl(211, 100%, 35%);
            border-color: hsl(211, 100%, 35%);
        }

        hr {
            border-top: 1px solid hsl(210, 16%, 93%);
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .text-muted {
            color: hsl(208, 7%, 46%);
        }

        .fs-7 {
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="shadow p-3 mb-5 bg-body-tertiary rounded" style="width: 620px;">
            <div class="my-3" style="overflow: hidden; width: 100%; height: 150px;">
                <img src="https://tse3.mm.bing.net/th/id/OIG2.dyy2drtEHdmprI5Bb8ah?pid=ImgGn" alt=""
                    id="img-banner">
            </div>
            <div class="my-4 text-sm text-gray-600">
                <h3>Xin chào <strong>{{ $acc->hovaten }}</strong>, </h3>
                <p>Xin chân thành cảm ơn bạn vì đã sử dụng dịch vụ của chúng tôi!</p>
                <p>TP xin thông báo xe của bạn mã số {{' '. $dtm->madkthumua . ' '}} gửi ngày {{' '. $dtm->ngaydk .' ' }} đã được đăng ký bán thành công, chúng tôi sẽ liên lạc với bạn trong vòng 24h.</p>
            </div>
            <hr>
            <p class="text-muted fs-7"><small>Số 1/115 đường Máng Nước, Cái Tắt, An Đồng, An Dương, Hải Phòng</small>
            </p>
        </div>
    </div>
</body>

</html>
