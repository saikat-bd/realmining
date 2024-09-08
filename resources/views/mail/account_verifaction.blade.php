<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Verification</title>
</head>

<body style="background: #F4F4F4;">
    <div algin="center" style="width: 100%; padding-left:250; padding-right:250px;">
        <div>

            <div style="background:white;">

                <h2>Verification link</h2>
                <p style="font-size: 18px;">Welcome to {{ $settings->company_name }}!</p>
                <p style="font-size: 18px;">Here is your account verification link :
                    <a
                        href="{{ url('account-verifaction?token=' . $userinfo->wallet_address) }}">{{ $userinfo->wallet_address }}</a>
                </p>

                <br /> <br /> <br /> <br />
                <p style="font-size: 18px;">
                    Please contact the {{ $settings->company_name }} Help
                    Team.<br /><br />
                    Best Regards,<br /><br />
                    {{ $settings->company_name }}
                </p>
            </div>
        </div>
    </div>
</body>

</html>
