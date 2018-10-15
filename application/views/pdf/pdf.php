<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).

require_once(FCPATH.'assets/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Boxeprint');
$pdf->SetTitle('Cartao');
$pdf->SetSubject('FGV Boxeprint');
$pdf->SetKeywords('');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);


// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('Helvetica', '', 10, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
//$pdf->SetFillColor(255, 255, 127);

/*$txt = 'Rodrigo';


// Multicell test
$pdf->MultiCell(35, 5, '[LOGO] ', 1, 'L', 0, 1, 45, '', true);
$pdf->MultiCell(35, 8, '[Nome] '.$txt."\n".$txt."\n".$txt, 1, 'L', 0, 1, 5, '', true);
$pdf->SetFont('helvetica', '', 8);
$txt2 = 'Rodrigo';
$pdf->MultiCell(35, 25, '[CENTER] '.$txt."\n".$txt2."\n".$txt2."\n".$txt2."\n".$txt2."\n".$txt2."\n".$txt2."\n".$txt2."\n".$txt2."\n".$txt2, 1, 'L', 0, 0, 45, 20, true);
*/
if($unidades!=''){
foreach($unidades as $unidade){
$nomeUnidade = $unidade->nome;
$logoUnidade = $unidade->logo;
}

}else{
	$nomeUnidade = '';
$logoUnidade = '';

}

$pdf->setJPEGQuality(75);

$pdf->Image($logoUnidade, 42, 3, 45, 10, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);
// Set some content to print
/*
$logo_html = <<<EOD
<style>
	.logo {
		font-family:helvetica;
		font-size: 12px;
	}
	
</style>

<div class="logo"></div>

EOD;
*/
$nome_html = <<<EOD
<style>
	.nome {
		text-transform: capitaliza;
		font-family:helvetica;
		font-size: 12px;
		font-style: normal;
		font-weight: bold;
		color: blue;
	}
	.cargo {
		text-transform: capitaliza;
		font-family:helvetica;
		font-size: 11px;
		font-style: normal;
		font-weight: normal;
		color: blue;
	}
	.cargo_en {
		text-transform: capitaliza;
		font-family:helvetica;
		font-size: 11px;
		font-style: italic;
		font-weight: normal;
		color: blue;
	}
	
</style>

<span class="nome">$nomes</span><br/>
<span class="cargo">$cargo</span><br/>
<span class="cargo_en">$cargo_en</span>

EOD;

foreach($setores as $setor){
$nomeSetor = $setor->nome;
$nomeSetor_en = $setor->nome_en;
}


foreach($enderecos as $endereco){
$logradouro = $endereco->logradouro;
$numero = $endereco->numero;
$bairro = $endereco->bairro;
$estado = $endereco->estado;
$uf = $endereco->uf;
$pais = $endereco->país;
$pais_en = $endereco->país_en;
$cep = $endereco->cep;
}

$c_andar = str_replace('_','/',$c_andar);
$c_sala = str_replace('_','/',$c_sala);
$telefone_completo = str_replace('_','(',$telefone_completo);
$telefone_completo = str_replace('.',')',$telefone_completo);
$celular_completo = str_replace('_','(',$celular_completo);
$celular_completo = str_replace('.',')',$celular_completo);
$fax_completo = str_replace('_','(',$fax_completo);
$fax_completo = str_replace('.',')',$fax_completo);
$email_completo = $email_prefixo.'@'.$email_sufixo;

$dados_html = <<<EOD
<style>
	.small{
		line-height: 1;
	}
	.setor {
		text-transform: capitaliza;
		font-family:helvetica;
		font-size: 11px;
		font-style: normal;
		font-weight: bold;
		color: blue;
	}
	.setor_en {
		text-transform: capitaliza;
		font-family:helvetica;
		font-size: 10px;
		font-style: italic;
		font-weight: normal;
		color: blue;
		
	}
	.endereco {
		text-transform: capitaliza;
		font-family:helvetica;
		font-size: 8px;
		font-style: normal;
		font-weight: normal;
		color: blue;
		
	}
	.telefone {
		text-transform: capitaliza;
		font-family:helvetica;
		font-size: 8px;
		font-style: normal;
		font-weight: normal;
		color: blue;
	
	}
	.celular {
		text-transform: capitaliza;
		font-family:helvetica;
		font-size: 8px;
		font-style: normal;
		font-weight: normal;
		color: blue;
		
	}
	.fax {
		text-transform: capitaliza;
		font-family:helvetica;
		font-size: 8px;
		font-style: normal;
		font-weight: normal;
		color: blue;
		
	}
	.email {
		text-transform: capitaliza;
		font-family:helvetica;
		font-size: 8px;
		font-style: normal;
		font-weight: normal;
		color: blue;
	}
	
</style>
<p class="small">
<span class="setor">$nomeSetor</span><br/>
<span class="setor_en">$nomeSetor_en</span><br/>
<span class="endereco">$logradouro, $numero - $c_andar $andar $c_sala $sala $bairro $cep - $estado - $uf $pais/$pais_en</span><br/>
<span class="telefone">t. $telefone_completo</span><br/>
<span class="celular">c. $celular_completo</span><br/>
<span class="fax">f. $fax_completo</span><br/>
<span class="email">$email_completo</span>
</p>
EOD;
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
//$pdf->writeHTMLCell(50, '', 35, '', $logo_html, 0, 0, 0, true, 'J', true);
$pdf->writeHTMLCell(30, '', 5, 10, $nome_html, 0, 0, 0, true, 'J', true);
$pdf->writeHTMLCell(45, 30, 40, 15, $dados_html, 0, 0, 0, true, 'L', true);

$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(0, 0, 0, 0);

// set cell margins
$pdf->setCellMargins(0, 0, 0, 0);

$pdf->SetFillColor(0,0,255);

$verso_html = <<<EOD
<style>
	.email{
		text-transform: lowercase;
		font-family:helvetica;
		font-size: 12px;
		font-style: normal;
		font-weight: normal;
		color: white;
	}
</style>
<span class="email">$email_sufixo</span>
EOD;
$pdf->writeHTMLCell(90, 49.9, 0, 0, '', 0, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(12, 8, 40, 25, $verso_html, 0, 0, 0, true, 'C', true);

$pdf->lastPage();
// Print text using writeHTMLCell()
//$pdf->Write(0, $html, '', 0, 'L', true, 0, false, false, 0);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output(FCPATH.'assets/pdf/tmp/'.$id_usuario.'/'.$nomes.'.pdf', 'FI');
//$pdf->Output('/var/www/html/cartao_fgv/assets/pdf/tmp/teste.pdf', 'FI');



//============================================================+
// END OF FILE
//============================================================+
