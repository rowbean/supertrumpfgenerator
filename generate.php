<?php
require_once('lib/tcpdf/tcpdf.php');
require_once('lib/fpdi/src/autoload.php');
use setasign\Fpdi\Tcpdf\Fpdi;

function createCards($titles, $descriptions, $datasets, $images, $layout)
{//Creates a pdf document with the given data;

    //Set the PDF-boxes
    //https://tcpdf.org/docs/srcdoc/TCPDF/class-TCPDF#_getPageDimensions
    $pageformat = array(
        'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 66, 'ury' => 96),
        //'CropBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 297),
        'BleedBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 66, 'ury' => 96),
        'TrimBox' => array ('llx' => 3, 'lly' => 3, 'urx' => 63, 'ury' => 93),
        //'ArtBox' => array ('llx' => 15, 'lly' => 15, 'urx' => 195, 'ury' => 282),
        'Dur' => 3,
        'trans' => array(
            'D' => 1.5,
            'S' => 'Split',
            'Dm' => 'V',
            'M' => 'O'
        ),
        'Rotate' => 0,
        'PZ' => 1,
    );

    $pdf = new Fpdi('p', 'mm', $pageformat, true, 'UTF-8', false);

    //Disable header&footer
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);

    //Set Layout
    $pdf->setSourceFile($layout);
    $tplFront = $pdf->importPage(1);
    $tplBack = $pdf->importPage(2);

    //Set properties
    $pdf->SetFont('courierprimeregular', '', $pdf->pixelsToUnits('22'));
    $pdf->SetLineWidth(0);
    $pdf->SetDrawColor(255, 255, 255, 0);
    $pdf->SetFillColor(0, 0, 0, 0);
    $pdf->SetTextColor(255, 255, 255, 0);
    $pdf->SetAutoPageBreak(false);

    $widthTableCells = array(20, 30);

    //$image_file = $images['tmp_name'];
    for($i = 0;$i < count($datasets);$i++)
    {
        $pdf->AddPage();
        $pdf->useTemplate($tplFront, 0, 0);

        $pdf->SetAbsXY($pdf->pixelsToUnits('24'), $pdf->pixelsToUnits('145'));
        $pdf->SetMargins($pdf->pixelsToUnits('22.5'), 5, 0, false);

        //Add description
        $pdf->Multicell($pdf->pixelsToUnits('145'), 1, $descriptions[$i], 0, 'L', false, 1, $pdf->pixelsToUnits('22'), '', true, 0, false, true, 0, 'T', false);
        $pdf->Ln(2);

        //Add category titles and values
        for($j = 0;$j < count($titles);$j++)
        {
            $pdf->Cell($widthTableCells[0], 2, $titles[$j], 0, 0, 'L', 0);
            $pdf->Cell($widthTableCells[1], 2, $datasets[$i][$j], 0, 0, 'R', 0);
            $pdf->Ln();
        }

        //Add image
        $pdf->SetMargins(0, 0, 0, false );
        $pdf->Image($images['tmp_name'][$i], 0, $pdf->pixelsToUnits('21'), $pdf->pixelsToUnits('120'), $pdf->pixelsToUnits('113'), 'JPG', false, 'M', false, 300, 'C', false, false, 0, 'CM', false, false);

        //Add rear of the card
        $pdf->AddPage();
        $pdf->useTemplate($tplBack, 0, 0);
    }

    $pdf->Output();
}