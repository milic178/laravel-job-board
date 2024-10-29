<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="dark">
    <meta name="supported-color-schemes" content="dark">
    <title>{{ $slot->title ?? 'Email' }}</title>
    <style>
        /* Place all your styles here */
        body {
            background-color: #121212; /* Dark background for the email */
            color: #e0e0e0; /* Light text color */
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #1e1e1e; /* Slightly lighter background for email container */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }
        .header {
            font-size: 24px;
            margin-bottom: 10px;
            color: #ffffff; /* White header text */
        }
        .content {
            font-size: 16px;
            line-height: 1.5;
        }
        .footer {
            font-size: 12px;
            color: #b0b0b0; /* Lighter footer text */
            margin-top: 20px;
            text-align: center;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff; /* Blue action button */
            color: #fff; /* White text for button */
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px; /* Spacing above button */
        }
    </style>
</head>
<body>
        <div class="email-container">
            <div class="header" style="display: flex; align-items: center;">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo JobBoardApp" style="width: 40px; height: 40px; margin-right: 10px;">
                {{ $header }}
            </div>
            <div class="content">
                {{ $slot }}
            </div>
            <div class="footer">
                {{ $subcopy ?? '' }}
                <p>&copy; {{ date('Y') }} JobBoardApp. All rights reserved.</p>
                <p>Connecting talent with opportunity.</p>
            </div>
        </div>
</body>
</html>
