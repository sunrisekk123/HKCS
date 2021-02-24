<?php
require_once("Connections/mylib.php");
require_once("fpdf/fpdf.php");

if(isset($_POST['save'])){
    $id = $_COOKIE['emailOrId'];
    $date = $_SESSION['dateTime'];

}


//Create new PDF
$pdf = new FPDF('P','mm','a4');
$pdf->SetFont('arial', 'b','14');
$pdf->Image('Image/');