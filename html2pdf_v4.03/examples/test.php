<?php

	$AdID=$_GET['event_id']; 
/
    ob_start();
   
	include(dirname(__FILE__).'/res/test.php'); 
    $content = "
<page>
    <h1>Exemple d'utilisation</h1>
    <br>
    Ceci est un <b>exemple d'utilisation</b>
    de <a href='http://html2pdf.fr/'>HTML2PDF</a>.<br>
</page>";

    // convert in PDF
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
//      $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial'); 
		ob_get_clean();
        $html2pdf->writeHTML($content);  
		//ob_flush();
		$my_string = substr(str_shuffle(MD5(microtime())), 0, 6); 
       // $html2pdf->Output("invoice.pdf");
		$path='../../invoice/adv'.$AdID.'.pdf';		
		$html2pdf->Output($path, 'F');
		$html2pdf->Output("adv.pdf");
		 
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    } 
	
?>
