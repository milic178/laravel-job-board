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
    {{ $slot }}
</div>
</body>
</html>
