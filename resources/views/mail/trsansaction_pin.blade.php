<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction New PIN</title>
</head>

<body style="background: #F4F4F4;">
    <div algin="center" style="width: 100%; padding-left:250; padding-right:250px;">
        <div>

            <div style="background:white;">
                <h2>{{ $settings->company_name }}</h2>
                <h2>Transaction New PIN</h2>
                <p style="font-size: 18px;">Welcome to {{ $userinfo->username }}!</p>
                <p style="font-size: 18px;">Here is your account Transaction PIN :
                    <strong>{{ $userinfo->transactionpin }}</strong>
                </p>

                <br /> <br /> <br /> <br />
                <p style="font-size: 18px;">
                    If you did not request this password reset, please contact the {{ $settings->company_name }} Help
                    Team.<br /><br />
                    Best Regards,<br /><br />
                    {{ $settings->company_name }}
                </p>
            </div>
        </div>
    </div>
</body>

</html>
