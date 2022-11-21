<?php

session_start();
require('./pdf/tfpdf.php');
$pdf = new tFPDF();
$pdf->AddPage();
$primr ;
// Add a Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);

// Load a UTF-8 string from a file and print it
$txt = file_get_contents('./pdf/HelloWorld.txt');
$pdf->Cell(0,10,"Билет", 0, 1, "C");
$pdf->Cell(0,10, "Вы заказали экскурсию ".'"'.$_SESSION['Exc_arr_pdf'][2].'"'.":", 0, 1);
for($i = 4; $i < count($_SESSION['Exc_arr_pdf']); $i++){
    
    switch ($i){
        case 4:
            $pdf->SetX(20);
            $pdf->Cell(10,10, "Цена: ".$_SESSION['Exc_arr_pdf'][4]." рублей;", 0, 1);
            break;
        case 5:
            $pdf->SetX(20);
            $pdf->Cell(10,10, "Почта экскурсовода: ".$_SESSION['Exc_arr_pdf'][5].";", 0, 1);
            break;
        case 6:
            $pdf->SetX(20);
            $pdf->Cell(10,10, "Номер экскурсовода: ".$_SESSION['Exc_arr_pdf'][6].";", 0, 1);
            break;
        case 7:
            $pdf->SetX(20);
            $pdf->Cell(0,10, "ФИ экскурсовода: ".$_SESSION['Exc_arr_pdf'][10]." ".$_SESSION['Exc_arr_pdf'][11].";", 0, 1);
            
            break;
        case 8:
        
            
            $pdf->Cell(0,10, $_SESSION['surname']." ".$_SESSION['name']." ".$_SESSION['TwoNameOrder'].":", 0, 1, "C");
            $pdf->Cell(0,10, "Время: ".$_SESSION['date'].";", "B", 0, 1);
            $pdf->Ln(10);
            $pdf->Cell(0,10, "Количество билетов: ".$_SESSION['CountOrder'].";", 0, 1);
            $pdf->Cell(0,10, "Всего: ".(int)$_SESSION['CountOrder']*(int)$_SESSION['Exc_arr_pdf'][4].":", 1, 1);
            break;

            



    }
}

$pdf->Ln(20);
$pdf->Cell(0, 0, 'Обязательно сохраните документ!!!');

$pdf->Output();



?>