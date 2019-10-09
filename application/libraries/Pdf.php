<?php
class Pdf {
 
    function __construct() {
        include_once APPPATH . '/third_party/fpdf/fpdf.php';

        $pdf = new FPDF();
		$pdf->AddPage();
		
		$CI =& get_instance();
		$CI->fpdf = $pdf;
    }
}
?>