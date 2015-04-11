<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Excel {

    public function createExcel($filename, $arrydata) {
        require_once('excel/excel.php');

        $excelfile = "xlsfile://tmp/".$filename;  
        $fp = fopen($excelfile, "wb");  
        if (!is_resource($fp)) {  
            die("Error al crear $excelfile");  
        }  
        fwrite($fp, serialize($arrydata));  
        fclose($fp);
        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");  
        header ("Cache-Control: no-cache, must-revalidate");  
        header ("Pragma: no-cache");  
        header ("Content-type: application/x-msexcel");  
        header ("Content-Disposition: attachment; filename=\"" . $filename . "\"" );
        header("Content-Type: text/html; charset=ISO-8859-1");
        readfile($excelfile);
    }
}