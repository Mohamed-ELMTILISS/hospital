<?php 
	include 'connect.php';
	require('../fpdf/fpdf.php');
	$cin_P = $_GET['cin_P'];
	class PDF extends FPDF{
		function Header(){
			    // Logo
			    $this->Image('../image/logo.png',10,-3,40);
			    // Arial bold 15
			    $this->SetFont('Arial','B',15);
			    // Move to the right
			    $this->Cell(80);
			    // Title
			    $this->Cell(30,10,'Facture',1,0,'C');
			    // Line break
			    $this->Ln(30);
			}
			function Footer(){
				// Position at 1.5 cm from bottom
				$this->SetY(-15);
				// Arial italic 8
				$this->SetFont('Arial','I',8);
				$this->SetFillColor(68,85,90);
				// Page number
				$this->Cell(0,10,'Email: hospital@hospital.ma ¦ Fix: 0555678943 ¦ Adress: 168 St. UpTown New York',0,0,'C');
			}
	}

	$sql = "SELECT p.date_entree, total, avance, date_sortie, nom, prenom, f.cin_P FROM facture f, patient p WHERE p.cin_P = f.cin_P AND f.cin_P = '". $cin_P. "'";
    $result = $conn->query($sql);

	$pdf = new PDF();
	$pdf->AddPage();
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			$pdf->SetFont('Arial','B',15);
			$pdf->Cell(100,20,"Patient:",0,0,'L');
			$pdf->Ln();
			$pdf->SetFont('Arial','',13);
			$pdf->Cell(37,12,"",0,0,"L");
			$pdf->Cell(90,12,"Nom: ",0,0,"L");
			$pdf->Cell(30,12,$row['nom'],0,0,"C");
			$pdf->Ln();
			$pdf->Cell(37,12,"",0,0,"L");
			$pdf->Cell(90,12,"Prenom: ",0,0,"L");
			$pdf->Cell(30,12,$row['prenom'],0,0,"C");
			$pdf->Ln();
			$pdf->Cell(37,12,"",0,0,"L");
			$pdf->Cell(90,12,"CIN: ",0,0,"L");
			$pdf->Cell(30,12,$row['cin_P'],0,0,"C");
			$pdf->Ln(18);
			$pdf->Cell(20,0,"",0,0,'C');
			$pdf->Cell(140,0,"",1,0,'C');
			$pdf->Ln(15);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(37,12,"Date Entree",1,0,'C');
			$pdf->Cell(37,12,"Total",1,0,'C');
			$pdf->Cell(37,12,"Avance",1,0,'C');
			$pdf->Cell(37,12,"Date Sortie",1,0,'C');
			$pdf->Cell(37,12,"Time Sortie",1,0,'C');
			$pdf->SetFont('Arial','',12);
			$pdf->Ln();
			$pdf->Cell(37,12,$row['date_entree'],1,0,'C');
			$pdf->Cell(37,12,$row['total']. 'Dhs',1,0,'C');
			$pdf->Cell(37,12,$row['avance']. 'Dhs',1,0,'C');
			$pdf->Cell(37,12,$row['date_sortie'],1,0,'C');
			$pdf->Cell(37,12,date("h:i A"),1,0,'C');
			$pdf->Ln();
			$pdf->Cell(185,12,"Fure le :". date("d/m/Y"),0,0,"R");
		}
	}
	
	$pdf->Output();
	

 ?>