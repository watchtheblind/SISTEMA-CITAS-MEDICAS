<?php
    $pacienteNomApe = $_POST['paciente'];
    $medicoNomApe = $_POST['medico'];
    $especialidad = $_POST['especialidad'];
    $pacienteCedula = $_POST['cedula'];
    $fechaCita = $_POST['fechaCita'];
    $numero = $_POST['numero'];
	# Incluyendo librerias necesarias #
    require "./code128.php";
    $pdf = new PDF_Code128('P','mm',array(80,120));
    $pdf->SetMargins(5,8,5);
    $pdf->AddPage();
    # Encabezado y datos de la empresa #
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(0,7,iconv("UTF-8", "ISO-8859-1",strtoupper("Centro Docente Cardiologico Bolivariano Aragua")),0,'C',false);
    $pdf->SetFont('Arial','',11);
    $pdf->Image('cardiol.png', 5, 25, 70, 70, '', '', '', false, 100, '', true, 0.2);
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(0, 10, iconv("UTF-8", "ISO-8859-1", "TICKET DE ATENCIÓN MÉDICA"), 0, 'C', false, 20);
    $pdf->MultiCell(0,11,iconv("UTF-8", "ISO-8859-1",""),0,'C',false);
    $pdf->SetFont('Arial','',12);
    $pdf->MultiCell(0,7,iconv("UTF-8", "ISO-8859-1","Paciente:".$pacienteNomApe),0,'C',false);
    $pdf->MultiCell(0,7,iconv("UTF-8", "ISO-8859-1","Cédula: V-".$pacienteCedula),0,'C',false);
    $pdf->MultiCell(0,7,iconv("UTF-8", "ISO-8859-1","Fecha de consulta: ".date("d/m/Y", strtotime($fechaCita))),0,'C',false);
    $pdf->MultiCell(0,7,iconv("UTF-8", "ISO-8859-1","Consulta: ".$especialidad),0,'C',false);
    $pdf->MultiCell(0,7,iconv("UTF-8", "ISO-8859-1","Médico: ".$medicoNomApe),0,'C',false);
    $pdf->SetFont('Arial','B',12);
    $pdf->MultiCell(0,15,iconv("UTF-8", "ISO-8859-1",""),0,'C',false);

    $pdf->MultiCell(0,2,iconv("UTF-8", "ISO-8859-1",strtoupper("Ticket Nro: ").$numero),0,'C',false);
    $pdf->SetFont('Arial','B',4);
    $pdf->MultiCell(0,2,iconv("UTF-8", "ISO-8859-1",""),0,'C',false);
    $pdf->MultiCell(0,2,iconv("UTF-8", "ISO-8859-1",strtoupper("ADVERTENCIA: No pierda este ticket, ya que no se le dara uno nuevo")),0,'C',false);
    # Nombre del archivo PDF #
    $pdf->Output("I","Ticket_Nro_".$numero.".pdf",true);