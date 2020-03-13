<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
require ('database.php');

$db = new Database();

$pn = $_GET['pnNumber'];

$data = $db->nonPdc($pn);

//print_r($data);

class MYPDF extends TCPDF
{
   
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// add a page
$pdf->AddPage();
// reset pointer to the last page
$pdf->lastPage();

$title = 'PROMISORRY NOTE';

$pdf->setFont('times', 'B', '9');
$pdf->Cell(80, 0, '', 0, 0);
$pdf->Cell(20, 0, $title, 0, 1);

$dateToday = date('m/d/Y');

$pdf->setFont('times', '', '7');
$pdf->Cell(20, 0, 'Value Date', 0, 0);
$pdf->Cell(10, 0, '', 0, 0);
$pdf->Cell(0.5, 0, $dateToday, 0, 0);
$pdf->setFont('times', 'B', '7');
$pdf->Cell(50, 0, '__________________', 0, 0);
$pdf->Cell(50, 0, '', 0, 0);
$pdf->setFont('times', '', '7');
$pdf->Cell(20, 0, 'PN No.', 0, 0);
$pdf->Cell(10, 0, '', 0, 0);
$pdf->Cell(0.5, 0, $dateToday, 0, 0);
$pdf->setFont('times', 'B', '7');
$pdf->Cell(50, 0, '__________________', 0, 0);


//Close and output PDF document
$pdf->Output('NON-PDC.pdf', 'I');


// $pdf->Cell(0, 0, 'CODE 39 + CHECKSUM', 0, 1);
// $txt = "You can also export 1D barcodes in other formats (PNG, SVG, HTML). Check the examples inside the barcodes directory.\n";
// $pdf->MultiCell(70, 50, $txt, 0, 'J', false, 1, 125, 30, true, 0, false, true, 0, 'T', false);
// $pdf->SetY(30);
