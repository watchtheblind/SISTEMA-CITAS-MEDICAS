<?php 
include "../conectarBD.php";
require('fpdf.php');

class PDF_Report extends FPDF {
    function __construct() {
        parent::__construct();
    }

    function Header() {
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, 'Reporte de todas las Citas Medicas', 0, 0, 'C');
        $this->Ln(20);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Pagina '. $this->PageNo(), 0, 0, 'C');
    }

    function generateReport() {
        include "../conectarBD.php";

        $query = $conn->query("SELECT start, nombre_paciente, apellido_paciente, cedula_paciente FROM consultas ORDER BY start ASC");

        $this->AddPage();
        $this->SetFont('Arial', '', 12);

        $this->Cell(0, 10, '', 0, 1);
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
$pdf = new PDF_Report();
$pdf->generateReport();
$pdf->Output('reporte.pdf', 'I');