<!-- resources/views/email/sendotp.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        /* Add any CSS styling here */
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .content {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to Our Service</h1>
    </div>
    <div class="content">
        <p>Dear User,</p>
        <p>Thank you for joining our service! We are excited to have you on board.</p>
        <p>Your OTP is: <strong>{{ $otp }}</strong></p>
        <p>Please use this OTP to verify your account.</p>
        <p>Best regards,<br>Your Love</p>
    </div>
</body>
</html>