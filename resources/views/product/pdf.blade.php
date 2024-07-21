<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        @font-face {
            font-family: 'IranSans';
            src: url('{{ public_path('fonts/IranSans.ttf') }}');
        }

        body {
            font-family: 'IranSans', sans-serif;
            direction: rtl;
            text-align: right;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="title">{{ $title }}</div>
<div>قیمت : {{ $price }}</div>
<img src="{{ $image }}" alt="Product Image">
</body>
</html>
