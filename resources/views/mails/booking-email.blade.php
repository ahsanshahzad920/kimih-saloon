<!DOCTYPE html>
<html>

<head>
    <title>Appointment Booked Successfully</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f7;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .email-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .email-body {
            padding: 20px;
            line-height: 1.8;
            color: #333333;
        }

        .email-body p {
            margin: 0 0 15px;
        }

        .email-footer {
            background-color: #f4f4f7;
            text-align: center;
            padding: 20px;
            color: #999999;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            border-top: 1px solid #e0e0e0;
        }

        .button {
            display: inline-block;
            padding: 12px 25px;
            margin-top: 20px;
            color: #ffffff;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .email-container img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

{{-- <body>
    <div class="container">
        <div class="header">
            <h1>Appointment Booked Successfully</h1>
        </div>
        <div class="content">
            <p>Dear {{$name}},</p>
            <p>Your appointment has been booked successfully. Here are the details:</p>
            <p><strong>Shop:</strong> {{$shopName}}</p>
            <p><strong>Service:</strong> {{$service}}</p>
            <p><strong>Date:</strong> {{$date}}</p>
            <p>Thank you for choosing us. We look forward to seeing you soon.</p>
        </div>
    </div>
</body> --}}
<body>
    <div class="email-container">
        {{-- <div class="email-header">
            <h1>Your Appointment Booked Successfully</h1>
        </div> --}}
        <div class="content">
            <p>Dear {{$name}},</p>
            <p>Your appointment has been booked successfully. Here are the details:</p>
            <p><strong>Date:</strong> {{$date}}</p>
            <p><strong>Location:</strong> {{$location}}</p>
            <p>Thank you for choosing us. We look forward to seeing you soon.</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} {{ env('COMPANY_NAME') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
