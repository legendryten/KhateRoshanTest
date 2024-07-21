<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Scraper</title>
</head>
<body>
<form action="{{ route('product_info') }}" method="POST">
    @csrf
    <label for="productUrl">Product URL:</label>
    <input type="text" id="productUrl" name="productUrl" required>
    <button type="submit">Get Product Info</button>
</form>
</body>
</html>
