<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $slot->title ?? 'Email' }}</title>
    <style>
        body {
            font-family: 'Hanken Grotesk', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #000000;
            color: #ffffff;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
        }

        .header h1 {
            color: #000000;
            margin: 0;
            font-size: 28px;
        }

        .header p {
            color: #6b7280; /* Light gray text for the slogan */
            font-size: 16px;
            margin-top: 5px;
        }

        h2 {
            color: #000000;
            margin: 0 0 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 0 0 15px;
            color: #000000;
        }

        a {
            color: #1d4ed8;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #d1d5db; /* Light border for separation */
            text-align: center;
            color: #6b7280; /* Light gray text */
        }

        .footer p {
            margin: 0;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>JobBoardApp</h1>
        <p>Find your dream job with us!</p>
    </div>

    {{ $slot }}

    <div class="footer">
        <p>&copy; {{ date('Y') }} JobBoardApp. All rights reserved.</p>
        <p>Connecting talent with opportunity.</p>
    </div>
</div>
</body>
</html>
