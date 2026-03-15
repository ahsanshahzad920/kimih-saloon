<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Email Registration Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #ffffff;
            margin: 50px auto;
            padding: 20px;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .header {
            background-color: #007BFF;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 20px;
        }

        .content p {
            margin: 0 0 10px;
        }

        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #666666;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>New Email Registration Notification</h1>
        </div>
        <div class="content">
            <p>Dear Admin,</p>
            <p>We are pleased to inform you that a new email has been registered:</p>
            <p><strong>{{ $email }}</strong></p>
            <p>Please take the necessary actions as required.</p>
        </div>
    </div>
</body>

</html>
