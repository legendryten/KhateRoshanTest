<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\PdfService;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ProductController extends Controller
{
    private ProductService $productService;
    private PdfService $pdfService;

    public function __construct(ProductService $productService, PdfService $pdfService)
    {
        $this->productService = $productService;
        $this->pdfService = $pdfService;
    }

    public function showForm(): Factory|View|Application
    {
        return view('product.form');
    }

    public function getProduct(Request $request): Factory|View|Application
    {
        $productUrl = 'https://www.banimode.com/BM-'.$request->input('productUrl');
        $productDetails = $this->productService->fetchProductDetails($productUrl);

        return view('product.product', [
            'title' => $productDetails['title'],
            'price' => $productDetails['price'],
            'image' => $productDetails['image'],
            'productUrl' => $productUrl,
        ]);
    }

    public function downloadPdf(Request $request)
    {
        $productUrl = $request->query('productUrl');
        $productDetails = $this->productService->fetchProductDetails($productUrl);

        $this->pdfService->generateProductPdf($productDetails['title'], $productDetails['price'], $productDetails['image']);
    }
}
