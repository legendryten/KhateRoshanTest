<?php

namespace App\Services;

use TCPDF;

class PdfService
{
    public function generateProductPdf(string $title, string $price, string $imageUrl)
    {
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

        $imageUrl = htmlspecialchars($imageUrl);
        $pdf->Image($imageUrl, 15, 50, 180, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);

        $pdf->Output('product.pdf', 'D');
    }
}
