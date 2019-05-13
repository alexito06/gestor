<?php
require_once ("../plugins/tcPDF/tcpdf.php");
require_once ("../plugins/tcPDF/config/lang/spa.php");

//require_once("../common/clsMiCNXAcceso.php");
require_once("../common/classGestor.php");
// Extend the TCPDF class to create custom Header and Footer

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo_unam.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, ' Universidad Nacional Autónoma de México', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$gestor = new gestor(); 

$datos=$gestor->infSolicitud($_POST);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Ticket');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

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

// ---------------------------------------------------------
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
// set font
$pdf->SetFont('times', '', 11);

// add a page
$pdf->AddPage();

// set some text to print
$txt = '<table border="" cellpadding="5">
			<thead>
				<tr>
				<th></th>
				<th colspan="2" align="center"> Ticket de Reporte</th>
				<th></th>
				</tr>
			</thead>
			
			<tr>
				<td></td>
				<td width="80" align="right"> Usuario:</td>
				<td width="250" align="left">'.$datos->usuario.'</td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td align="right"> Login:</td>
				<td align="left">'.$datos->login.'</td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td align="rigth"> Area:</td>
				<td align="left">'.$datos->area.'</td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td align="rigth"> Fecha de Registro:</td>
				<td align="left">'.$datos->fc_reg.'</td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td align="rigth"> Folio:</td>
				<td align="left">'.$datos->folio.'</td>
				<td></td>
			</tr>
		</table>';

// print a block of text using Write()
$pdf->writeHTML($txt, true, false, true, false, '');
//$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('ticket.pdf', 'I');
?>