<?php

namespace App\Services;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class ProductService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['verify' => false]);
    }

    public function fetchProductDetails(string $productUrl): array
    {
        $response = $this->client->request('GET', $productUrl);
        $content = $response->getBody()->getContents();

        $crawler = new Crawler($content);

        $title = $crawler->filter('h1.product-title')->text();
        $price = $crawler->filter('meta[property="product:price:amount"]')->attr('content');
        $image = $crawler->filter('meta[property="og:image"]')->attr('content');

        return [
            'title' => $title,
            'price' => $price,
            'image' => $image,
        ];
    }
}
