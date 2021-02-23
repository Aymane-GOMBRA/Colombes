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
$pdf->AddPage('L', 'A4', 0);

//Typo
$pdf->SetFont('Times', '', 10);

//Impression contenu table
try{
    if(isset($_GET['t']) && !empty($_GET['t'])){
        $t = $_GET['t'];
        $sql = "SELECT * FROM $t";
        //lit et écrit les datas
        $qry=$cnn->query($sql);
        $nb=$qry->columnCount();
        $width=277/$nb;
        $pdf->SetTextColor(255,255,255);
        for($i=0;$i<$nb;$i++){
            $pdf->Cell($width,5,utf8_decode($qry->getColumnMeta($i)["name"]), 1, 0, 'C', true);
        }
        $pdf->Ln(5);
        $pdf->SetTextColor(0);
        while($row=$qry->fetch(PDO::FETCH_NUM)){
            for($i=0;$i<$nb;$i++){
                $pdf->Cell($width,5,utf8_decode($row[$i]), 1, 0);
            }
            $pdf->Ln(5);
        }
    }else{
        $pdf->MultiCell(0,30, 'Table non trouvée');
    }
}catch(PDOException $e){
    $pdf->MultiCell(0, 30, $e->getMessage());
}

unset($cnn);


//Renvoi du résultat
$pdf->Output('I', 'export.pdf', true);

