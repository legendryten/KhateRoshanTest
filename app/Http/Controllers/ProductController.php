<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use TCPDF;

class ProductController extends Controller
{
    public function showForm()
    {

        return view('product.form');
    }

    /**
     * @throws GuzzleException
     */
    public function getProduct(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $productUrl = 'https://www.banimode.com/BM-'.$request->input('productUrl');


        [$title, $price, $image] = $this->getHtmlEntities($productUrl);


        return view('product.product', [
            'title' => $title,
            'price' => $price,
            'image' => $image,
            'productUrl' => $productUrl,
        ]);
    }

    public function downloadPdf(Request $request)
    {
        $productUrl = $request->query('productUrl');

        [$title, $price, $image] = $this->getHtmlEntities($productUrl);

        $pdf = new TCPDF();

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Company');
        $pdf->SetTitle('Product Details');
        $pdf->SetSubject('Product PDF');

        $pdf->SetMargins(15, 27, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->SetFont('dejavusans', '', 12);

        $pdf->AddPage();

        $html = '
            <h1>' . htmlspecialchars($title) . '</h1>
            <p>Price: ' . htmlspecialchars($price) . '</p>
        ';


        $pdf->writeHTML($html, true, false, true, false, '');

        $imageUrl = htmlspecialchars($image);
        $pdf->Image($imageUrl, 15, 50, 180, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);

        $pdf->Output('product.pdf', 'D');

    }
    /**
     * @param array|string|null $productUrl
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getHtmlEntities(array|string|null $productUrl): array
    {
        $client = new Client(['verify' => false]);
        $response = $client->request('GET', $productUrl);
        $content = $response->getBody()->getContents();

        $crawler = new Crawler($content);

        $title = $crawler->filter('h1.product-title')->text();

        $price = $crawler->filter('meta[property="product:price:amount"]')->attr('content');

        $image = $crawler->filter('meta[property="og:image"]')->attr('content');
        return array($title, $price, $image);
    }
}
