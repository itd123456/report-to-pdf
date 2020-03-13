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
    // Page footer
    public function Footer() 
    {
    	$d = new Database();
    	$dt = $d->nonPdc($_GET['pnNumber']);
    	$amount = 0;
    	$c = count($dt);

		for ($i = 0; $i < $c; $i++)
		{
			$amount += (int)$dt[$i]['MPDC_AMOUNT'];
		}

		$amount = number_format($amount, 2);

        $this->SetFont('times', 'B', 9);
        $this->Cell(20, 15, '________________________________________________________________________________________________________________________', 0, 1);
        $this->SetFont('times', '', 9);
        $this->Cell(10, 0, 'Total Check Amount', 0, 0);
        $this->Cell(30, 0, '', 0, 0);
        $this->SetFont('times', 'B', 9);
        $this->Cell(10, 2, $amount, 0, 0);
        $this->Ln(0.5);
        $this->SetFont('times', 'B', 9);
        $cou = strlen($amount);
        
        if ($cou <= 9)
        {
        	$this->Cell(35, 0, '', 0, 0);
        	$this->Cell(10, 2, '___________', 0, 0);
        	$this->Ln(0.5);
        	$this->Cell(35, 0, '', 0, 0);
        	$this->Cell(10, 2, '___________', 0, 1);
        }
        else if ($cou == 10)
        {
        	$this->Cell(35, 0, '', 0, 0);
        	$this->Cell(10, 2, '____________', 0, 0);
        	$this->Ln(0.5);
        	$this->Cell(35, 0, '', 0, 0);
        	$this->Cell(10, 2, '____________', 0, 1);
        }
        else if ($cou == 11)
        {
        	$this->Cell(35, 0, '', 0, 0);
        	$this->Cell(10, 2, '_____________', 0, 0);
        	$this->Ln(0.5);
        	$this->Cell(35, 0, '', 0, 0);
        	$this->Cell(10, 2, '_____________', 0, 1);
        }
        else if ($cou == 12)
        {
        	$this->Cell(35, 0, '', 0, 0);
        	$this->Cell(10, 2, '______________', 0, 0);
        	$this->Ln(0.5);
        	$this->Cell(35, 0, '', 0, 0);
        	$this->Cell(10, 2, '______________', 0, 1);
        }
        else if ($cou == 13)
        {
        	$this->Cell(35, 0, '', 0, 0);
        	$this->Cell(10, 2, '_______________', 0, 0);
        	$this->Ln(0.5);
        	$this->Cell(35, 0, '', 0, 0);
        	$this->Cell(10, 2, '_______________', 0, 1);
        }

        $this->Ln(15);
        $this->SetFont('times', '', 9);
        $this->Cell(5, 0, 'Pepared By:', 0, 0);
        $this->Cell(15, 0, '', 0, 0);
        $this->SetFont('times', 'B', 10);
        $this->Cell(5, 0, '___________________', 0, 0);

        $this->Cell(40, 0, '', 0, 0);
        $this->SetFont('times', '', 9);
        $this->Cell(5, 0, 'Released By:', 0, 0);
        $this->Cell(15, 0, '', 0, 0);
        $this->SetFont('times', 'B', 10);
        $this->Cell(5, 0, '___________________', 0, 0);

        $this->Cell(40, 0, '', 0, 0);
        $this->SetFont('times', '', 9);
        $this->Cell(5, 0, 'Approved By:', 0, 0);
        $this->Cell(15, 0, '', 0, 0);
        $this->SetFont('times', 'B', 10);
        $this->Cell(5, 0, '___________________', 0, 0);
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->setPrintHeader(false);
//$pdf->setPrintFooter(false);
$pdf->SetFooterMargin(50);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// add a page
$pdf->AddPage();
// reset pointer to the last page
$pdf->lastPage();

$company = 'Global Dominion Financing Inc.';
$reportType = 'PDC LIST - Borrower';
$branch = $data[0]['BRAN_NAME'];
$current = date('m/d/Y h:i:sA');
$branchAdd = $data[0]['BRAN_ADDRESS'];
$product = $data[0]['PROD_NAME'];
$released = $data[0]['released_date'];
$name = $data[0]['BORR_LAST_NAME'].', '.$data[0]['BORR_FIRST_NAME'].' '.$data[0]['BORR_MIDDLE_NAME'];
$address = $data[0]['BORR_ADDRESS'];

$brokenLine = '_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _';

$solidLine = '_______________________________________________________________________________________________________________________';

$pdf->SetFont('times', 'B', 13);
$pdf->Cell(50, 0, $company, 0, 0);
$pdf->Cell(100, 0, '', 0, 0);
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(0, 0, $reportType, 0, 1);

$pdf->Ln(1);
$pdf->SetFont('times', '', 10);
$pdf->Cell(20, 0, $branch, 0, 0);
$pdf->Cell(130, 0, '', 0, 0);
$pdf->SetFont('times', '', 8.5);
$pdf->Cell(0, 0, 'As of '.$current, 0, 1);

$pdf->Ln(0.5);
$pdf->SetFont('times', '', 8.5);
$pdf->Cell(20, 0, $branchAdd, 0, 0);
$pdf->Ln(0.7);
$pdf->SetFont('times', 'B', 8.5);
$pdf->Cell(20, 0, '_____________________________________________________________________________________________________________________________', 0, 1);

$pdf->Ln(1);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(10, 0, 'Product', 0, 0);
$pdf->Cell(25, 0, '', 0, 0);
$pdf->Cell(10, 0, $product, 0, 0);
$pdf->Cell(106, 0, '', 0, 0);
$pdf->Cell(22, 0, 'Released Date :', 0, 0);
$pdf->Cell(10, 0, $released, 0, 1);

$pdf->Ln(0);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(10, 0, 'PN Number', 0, 0);
$pdf->Cell(25, 0, '', 0, 0);
$pdf->Cell(25, 0, $pn, 0, 1);

$pdf->Ln(0);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(10, 0, 'Payment Center', 0, 1);

$pdf->Ln(0);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(10, 0, 'Reference No.', 0, 0);
$pdf->Cell(25, 0, '', 0, 0);
$pdf->Cell(25, 0, $pn, 0, 1);

$pdf->Ln(0);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(10, 0, 'Borrower Name', 0, 0);
$pdf->Cell(25, 0, '', 0, 0);
$pdf->Cell(25, 0, $name, 0, 1);

$pdf->Ln(0);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(10, 0, 'Borrower Address', 0, 0);
$pdf->Cell(25, 0, '', 0, 0);
$pdf->Cell(1, 0, $address, 0, 0);

$pdf->Ln(0.5);
$pdf->Cell(0, 0, $solidLine, 0, 1);

$pdf->Ln(1);
$pdf->Cell(14, 0, 'No.', 0, 0);
$pdf->Cell(30, 0, 'Check No.', 0, 0);
$pdf->Cell(30, 0, 'Bank', 0, 0);
$pdf->Cell(30, 0, 'Account No.', 0, 0);
$pdf->Cell(30, 0, 'Maturity', 0, 0);
$pdf->Cell(30, 0, 'Amount', 0, 0);
$pdf->Cell(30, 0, 'Status', 0, 0);
$pdf->Ln(1);
$pdf->Cell(0, 0, $solidLine, 0, 1);

$count = count($data);
for ($i = 0; $i < $count; $i++)
{
	$sequence = $data[$i]['MPDC_SEQUENCE'];
	$bank = 'NPDC';
	$accountNo = '*';
	$maturity = $data[$i]['maturity'];
	$amount = number_format($data[$i]['MPDC_AMOUNT'], 2);
	$status = '';

	if($data[$i]['MPDC_STATUS'] == '0')
	{
		$status = 'Uncleared';
	}

	$pdf->Ln(1);
	$pdf->SetFont('times', 'B', 9);
	$pdf->Cell(14, 0, $sequence, 0, 0);
	$pdf->Cell(30, 0, $sequence, 0, 0);
	$pdf->Cell(30, 0, $bank, 0, 0);
	$pdf->Cell(30, 0, $accountNo, 0, 0);
	$pdf->Cell(30, 0, $maturity, 0, 0);
	$pdf->Cell(30, 0, $amount, 0, 0);
	$pdf->Cell(30, 0, $status, 0, 0);

	if ($i == $count - 1)
	{
		$pdf->Ln(1);
		$pdf->SetFont('times', '', 6);
		$pdf->Cell(30, 0, $brokenLine, 0, 0);

		$pdf->Ln(0.1);
		$pdf->SetFont('times', 'B', 9);
		$pdf->Cell(0, 0, $solidLine, 0, 1);

		$pdf->Ln(1);
		$pdf->SetFont('times', 'B', 9);
		$pdf->Cell(0, 0, 'REMINDERS', 0, 1);
	}
	else
	{
		$pdf->Ln(1);
		$pdf->SetFont('times', '', 6);
		$pdf->Cell(30, 0, $brokenLine, 0, 1);
	}
}

$numberOneTwo = '1. Always demand a receipt as a proof of payment. Any claims by the borrower in the future that they have made payments to an GDFI employee or its authorized collector/s will not be HONORED by Global Dominion Financing Inc. (GDFI) without any valid GDFI receipt/s.                                  2. In case of check payment, check issued must be payable to Global Dominion Financing Inc.. *Pay to Cash check/s is not acceptable.                   ';

$numberThree = '3. For any deposits made directly to Global Dominion Financing Inc, transaction slip such as the bank deposit slip must properly safekeep for future references. Inthe deposit slip signature over printed name and contact number must be clearly indicated.                                             ';
$numberFour = '4. Keep receipt/s for safekeeping for reference in the future.';
$numberFive = '5.  In case the borrower pledges any item in lieu of cash payment, in the future, to any GDFI employee or its authorized collector/s, kindly fillup an acknowledgement receipt and list down all items being pulled out and have document signed by the GDFI employee or its authorized collector/s.';

$pdf->Ln(2);
$pdf->SetFont('times', '', 8.9);
$pdf->MultiCell(190, 10, $numberOneTwo, 0);
$pdf->MultiCell(190, 4, $numberThree, 0);
$pdf->MultiCell(80, 4, $numberFour, 0);
$pdf->MultiCell(190, 4, $numberFive, 0);

$ack = 'This acknowledgement copy must be retained by the borrower for future references.';

$pdf->Ln(2);
$pdf->Cell(30, 0, $ack, 0, 1);

$inq = 'For Inquiries or questions regarding on your payment, you may contact Global Doiminion Financing Inc. at:';
$treasury = '1. Treasury Department - Tel. No.: 631-4774 / Telefax: 910-5381 / CP No.: 0917-8272742, 0922-8147566';
$accounting = '2. Accounting Department - Tel. No.: 310-2766 / CP No.: 0925-7150338';
$accredited = '3. Accredited Collection Company';
$annapolis = 'Annapolis Credit Mgt. Services, Inc. (North Luzon Branches) - 637-9641, 0917-2400217, 0905-3121445, 0915-9161295';
$maharlika = 'First Maharlika Collection Mgt, Inc. (South Luzon Branches) - 0916-3595512, 0977-1273849, 0949-4086395, 0949-7365237';
$sparta = 'Sparta Credit Mgt. Services, Inc. (VISMIN Area) - 637-2143, 637-1470, 570-6011, 477-4917';
$concern = 'Your Concern is our priority.';
$pdf->Ln(2);
$pdf->Cell(30, 2, $inq, 0, 1);
$pdf->Cell(30, 2, $treasury, 0, 1);
$pdf->Cell(30, 2, $accounting, 0, 1);
$pdf->Cell(30, 2, $accredited, 0, 1);
$pdf->Cell(15, 0, '', 0, 0);
$pdf->Cell(30, 2, $annapolis, 0, 1);
$pdf->Cell(15, 0, '', 0, 0);
$pdf->Cell(30, 2, $maharlika, 0, 1);
$pdf->Cell(15, 0, '', 0, 0);
$pdf->Cell(30, 2, $sparta, 0, 1);
$pdf->Cell(30, 2, $concern, 0, 1);


$other = 'Other Contact number:';

//Close and output PDF document
$pdf->Output('NON-PDC.pdf', 'I');


// $pdf->Cell(0, 0, 'CODE 39 + CHECKSUM', 0, 1);
// $txt = "You can also export 1D barcodes in other formats (PNG, SVG, HTML). Check the examples inside the barcodes directory.\n";
// $pdf->MultiCell(70, 50, $txt, 0, 'J', false, 1, 125, 30, true, 0, false, true, 0, 'T', false);
// $pdf->SetY(30);
