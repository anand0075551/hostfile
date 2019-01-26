<?php
include_once('report.class.php');  
       
$classObj = new ReportClass();

$condition=$_POST['c'];

$res=$classObj->pdf_accounts($condition);

require('fpdf/fpdf.php');
$pdf = new FPDF('L','pt','A3');

$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,10,'Title',1,1,'C');
foreach($res as $row) {
	$pdf->Ln();
	
	foreach($row as $column)
	//$pdf->Cell(95,12,$column,1,1,'C');
		$pdf->cell(95,12,$column,1);
}
$deposit=0;
$deduction=0;
$balance=0;
foreach($res as $row) 
{
		 $deposit = $deposit + $row['DEPOSIT'];
		 $deduction = $deduction + $row['Deduction'];
		 $balance = $balance + $row['Balance'];
}
$amount = $deposit - $deduction;
$pdf->Cell(20,10,'Total Deposit',1,1,'C');
$pdf->Cell(20,10, $deposit,1,1,'C');
$pdf->Cell(20,10,'Total Deduction',1,1,'C');
$pdf->Cell(20,10, $deduction,1,1,'C');
$pdf->Cell(20,10,'Total Balance Amount',1,1,'C');
$pdf->Cell(20,10, $amount,1,1,'C');
$pdf->Output();
?>