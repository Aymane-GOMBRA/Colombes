<?php
include_once('test_session.php');
include_once('fpdf/fpdf.php');//http://www.fpdf.org/
include_once('pdo_connect.php');

//Clase qui étend FPDF
class MyPDF extends FPDF{
    //Surcharge la méthode HEADER : personnalise
    public function Header(){
        //Logo
        $this->Image('pics/logo.jpg', 10, 5, 50, 25);
        //Typo
        $this->SetTextColor(255,0,0);
        $this->SetFont('Arial', 'B', 20);
        //Texte
        $this->Cell(0, 10, 'Les Darons Codeurs', 0, 0, 'C');
        //Saut de ligne
        $this->Ln(20);
    }
    //Surcharge la méthode footer : personnalise
    public function Footer(){
        //Positionnement 1.5 du bas
        $this->setY(-15);
        //Typo
        $this->SetFont('Times', 'I', 10);
        //Texte
        $this->Cell(0, 10, 'Page '.$this->PageNo().' sur {nb} ', 0, 0, 'C');

    }
}

//Appelle la classe créée ci-dessus : impression en PDF
$pdf = new MyPDF();

//Gestion du nb de pages
$pdf->AliasNbPages();

//Création de la page
$pdf->AddPage('P', 'A4', 0);

//Test
$pdf->SetFont('Times', '', 10);
for($i=1;$i<1001;$i++){
    $pdf->Cell(0, 5, 'Ligne No '.$i, 1, 2);
}

//Renvoi du résultat
$pdf->Output('I', 'export.pdf', true);
