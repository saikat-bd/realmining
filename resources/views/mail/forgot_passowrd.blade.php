<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot password</title>
</head>

<body style="background: #F4F4F4;">
    <div algin="center" style="width: 100%; padding-left:250; padding-right:250px;">
        <div>

            <div style="background:white;">
                Dear {{ $userinfo->username }},<br /><br />
                <p>We have received a request to reset the password for your {{ $settings->company_name }} account.</p>
                <p> Please click on the following link to complete the process:</p>
                <a
                    href="{{ url('generated-new-password?token=' . $userinfo->token) }}">{{ url('generated-new-password?token=' . $userinfo->token) }}</a>

                <p>Please note the verification link will only be valid until
                    {{ date('d-m-Y H:h', strtotime('+1 day')) }}
                    CET.</p>
                <p>

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
