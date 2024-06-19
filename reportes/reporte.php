<?php 
include "../conectarBD.php";
require('fpdf.php');

class PDF_Report extends FPDF {
    function __construct($fecha1, $fecha2) {
        parent::__construct();
        $this->fecha1 = $fecha1;
        $this->fecha2 = $fecha2;
    }

    function Header() {
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, 'Reporte de Citas Medicas', 0, 0, 'C');
        $this->Ln(20);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Pagina '. $this->PageNo(), 0, 0, 'C');
    }

    function generateReport() {
        include "../conectarBD.php";
        $fecha1 = $_POST["fecha1"];
        $fecha2 = $_POST["fecha2"];

        $query = $conn->query("SELECT start, nombre_paciente, apellido_paciente, cedula_paciente FROM consultas WHERE start BETWEEN '$fecha1' AND '$fecha2' ORDER BY start ASC");

        $this->AddPage();
        $this->SetFont('Arial', '', 12);

        $this->Cell(0, 10, 'Fecha de inicio:  '. $this->fecha1, 0, 1);
        $this->Cell(0, 10, 'Fecha de fin: '. $this->fecha2, 0, 1);
        $this->Ln(10);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 10, 'Fecha de Consulta', 1, 0);
        $this->Cell(50, 10, 'Nombre de Paciente', 1, 0);
        $this->Cell(50, 10, 'Apellido del Paciente', 1, 0);
        $this->Cell(50, 10, 'Cedula del Paciente', 1, 1);
        foreach ($query as $row){
            $this->SetFont('Arial', '', 12);
            $this->Cell(40, 10, date('d/m/Y', strtotime($row['start'])), 1, 0);
            $this->Cell(50, 10, $row['nombre_paciente'], 1, 0);
            $this->Cell(50, 10, $row['apellido_paciente'], 1, 0);
            $this->Cell(50, 10, $row['cedula_paciente'], 1, 1);
        }
    }
}

// Ejemplo de uso
$fecha1 = $_POST['fecha1'];
$fecha2 = $_POST['fecha2'];

$pdf = new PDF_Report($fecha1, $fecha2);
$pdf->generateReport();
$pdf->Output('reporte.pdf', 'I');