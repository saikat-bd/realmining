<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Congratulations!</title>
</head>

<body style="background: #F4F4F4;">
    <div algin="center" style="width: 100%; padding-left:250; padding-right:250px;">
        <div>

            <div style="background:white;">
                <h2>{{ $settings->company_name }} Community</h2>
                <h2>Congratulations!</h2>
                <p style="font-size: 18px;">Account Created</p><br />
                <p>Wecome to {{ $settings->company_name }} Community! and Thanks for Signing Up!</p><br />

                <p>Your account has been sucessfully created.<br />
                    Thank you so much for choosing us. We're looking forward to working with you.</p>
                <br /><br /><br />
                <p>{{ $userinfo->name }}, Your Account Details Given Below -</p>
                <p>
                    Login User ID : {{ $userinfo->username }} <br />
                    Login Password : {{ $userinfo->password }}
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
