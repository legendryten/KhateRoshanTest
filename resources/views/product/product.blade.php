<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .price {
            font-size: 20px;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        .product-image img {
            width: 100%;
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .download-link {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #3498db;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .download-link:hover {
            background-color: #2980b9;
        }

        @media (max-width: 768px) {
            .title {
                font-size: 20px;
            }

            .price {
                font-size: 18px;
            }

            .download-link {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="title">{{ $title }}</div>
    <div class="price">قیمت: {{ $price }}</div>
    <div class="product-image">
        <img src="{{ $image }}" alt="Product Image">
    </div>
    <a href="{{ route('product_pdf', ['productUrl' => $productUrl]) }}" class="download-link">دانلود PDF</a>
</div>
</body>
</html>
