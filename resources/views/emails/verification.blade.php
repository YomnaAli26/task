<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>
</head>
<body>
<h1>Verify Your Account</h1>
<p>Thank you for registering with us! Your verification code is:</p>
<h2>{{ $verificationCode }}</h2>
<p>Please enter this code in the app to verify your account by using this url {{route("verify")}}</p>
<p>If you did not request this verification, please ignore this email.</p>
</body>
</html>
