<?php

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// add a page
$pdf->AddPage();

$html = <<<EOD
LOAN NOTICE
EOD;
$pdf->Cell(0, 9, $html, 0, 1, 'C', 0, '', 0, false, '', '' );

$html = <<<EOD
<i>From,</i>
EOD;
$sigingoff=<<<EOD
--
EOD;
$pdf->Cell(0, 9, $sigingoff, 0, 1, 'R', 0, '', 0, false, '', '' );
	
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
	
foreach($record as $r ){
$details ='<i>Company Name : </i>'.$r->company_name.'<br />
<i>Company Address : </i>'.$r->company_addrs.'<br />
<i>Phone No : </i>'.$r->company_phno.'<br />
<i>Email : </i>'.$r->company_email.'<br/>';
$body1='
<p></p>
<p></p>
<p>'.$r->description1.'</p>';
$body2='
<p></p>
<p></p>
<p style="color:#CC0000;">THE INTEREST TYPE BEING '.$r->interest_type .'. '.$r->description2.'</p>';

}
$pdf->writeHTMLCell(0, 0, '', '', $details, 0, 1, 0, true, '', true);

$title= <<<EOD
Loan Details<br/>
EOD;

$table = '<table >';
$table .= '<tr>
		   <th>Loan Amount</th>
		   <th>Rate</th>
		   </tr>';
			
foreach($records as $r ){
$subject='<p>Subject : <b>Loan report details of LOAN-- '.$r->loan_no.'</b></p>
<p>Dear Sir / Madam,</p>
<p>The is to inform .... holding gold loan in our company bearing Customer No : '.$r->cust_no.' and Loan No : '.$r->loan_no.'</p>';

$table .=	'<tr>
		<td style="border:1em solid #ccc;paddng:6px;" >'.$r->loan_amt.'</td>
		<td style="border:1em solid #ccc;paddng:6px;" >'.$r->loan_rate.'</td>
	</tr>';
}
$table .= '</table>';


$pdf->writeHTMLCell(0, 0, '', '', $subject, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $body1, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $body2, 0, 1, 0, true, '', true);
$pdf->WriteHTMLCell(0,0,'','',$title,0,1,0,true,'C',true);
$pdf->WriteHTMLCell(0,0,'','',$table,0,1,0,true,true);

$pdf->Cell(0, 9, 'Thanking You ', 0, true, 'R', 0, '', 0, false, '', '' );
$pdf->Cell(0, 9, 'Yours Faithfully ', 0, true, 'R', 0, '', 0, false, 'T', 'M' );

// move pointer to last page
$pdf->lastPage();

//Close and output PDF document
ob_clean();
$pdf->Output();
