<?php

require('fpdf.php');


class PDF extends FPDF {

    function generatePDF($nom, $prenom, $score, $date, $heure) {
        $this->AddPage();
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(40, 10, 'Résultats du test COVID-20');

    
        $this->Ln(10);
        $this->SetFont('Arial', '', 12);
        $this->Cell(40, 10, "Nom: $nom");
        $this->Ln(8);
        $this->Cell(40, 10, "Prénom: $prenom");
        $this->Ln(8);
        $this->Cell(40, 10, "Score: $score%");
        $this->Ln(8);
        $this->Cell(40, 10, "Date du test: $date");
        $this->Ln(8);
        $this->Cell(40, 10, "Heure du test: $heure");
    }
}


$pdf = new PDF();


$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$score = $_GET['score'];
$date = $_GET['date'];
$heure = $_GET['heure'];


$pdf->generatePDF($nom, $prenom, $score, $date, $heure);



$pdf->Output('C:\xampp\htdocs/mon_fichier.pdf', 'F');


$pdf->Output();
?>