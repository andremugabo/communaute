<?php 
session_start();
include('../includes/db.php');
$e_reference=$_GET['ref'];
include('../fpdf182/fpdf.php');

$loggin_id=$_SESSION['logged']['u_id'];


$select_e_details=mysqli_query($db,"SELECT  bands.*,eucharist_details.* FROM eucharist_details JOIN bands ON eucharist_details.ed_bsid=bands.bs_id WHERE eucharist_details.ed_eref='$e_reference'");
// var_dump($select_e_details);
       while ($row=mysqli_fetch_assoc($select_e_details)) {

       		$select_e=mysqli_query($db,"SELECT eucharist.*,diocese.*,parish.* FROM eucharist JOIN diocese ON eucharist.e_did=diocese.d_id JOIN parish ON eucharist.e_cid=parish.p_id WHERE eucharist.e_ref='$e_reference'");
       		while($PARISH=mysqli_fetch_assoc($select_e)){
       			$DIOCESE_NAME=$PARISH['d_name'];
       			$PARI_NAME=$PARISH['p_name'];
       			$PATRO_NAME=$PARISH['p_spatron'];
       			$AVAILABLE_PLACES=$PARISH['e_numberofseat'];
       		}

       	$Mass_reference=$row['ed_eref'];
       	$date=$row['ed_date'];

}

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage('L','A4',180);

$pdf->SetFont('Arial','B',12);

// $pdf->Cell(40,10,'Hello World!');

$pdf->Cell(100,20,'',0,0);
$pdf->Image('../photo/icon1.jpg',10,10,20,30,'jpg');
$pdf->Cell(70,20,'CELEBRATION OF EUCHARIST',0,0,'C');
$pdf->Cell(100,20,'',0,1);
$pdf->Image('../photo/mk.jpg',260,10,20,30,'jpg');


$pdf->Ln(20);
$pdf->Cell(200,10,'Mass Reference :'.$Mass_reference,0,1,'L');
$pdf->Cell(200,10,'Date :'.$date,0,1,'L');
$pdf->Cell(150,10,'Available Place :'.$AVAILABLE_PLACES.' Seats',0,1,'L');
$pdf->Cell(35,10,'Diocese  : '.$DIOCESE_NAME,0,1,'L');
$pdf->Cell(35,10,'Parish : '.$PARI_NAME,0,1,'L');
$pdf->Cell(35,10,'St Patron : '.$PATRO_NAME,0,1,'L');



$pdf->Ln(30);

$pdf ->Cell(50,10,'ADULT:',0,1,'C');

$pdf->SetFillColor(255,224,0);

$pdf->Cell(5,10,'#',1,0,'C',true);
$pdf->Cell(64,10,'Names',1,0,'C',true);
$pdf->Cell(30,10,'Telephone',1,0,'C',true);
$pdf->Cell(40,10,'ID Number',1,0,'C',true);
$pdf->Cell(40,10,'Village',1,0,'C',true);
$pdf->Cell(35,10,'Cell',1,0,'C',true);
$pdf->Cell(30,10,'Sector',1,0,'C',true);
$pdf->Cell(30,10,'District',1,1,'C',true);

$num=0;

$P_e_details=mysqli_query($db,"SELECT eucharist_details.*,bands.* FROM eucharist_details JOIN bands ON eucharist_details.ed_bsid=bands.bs_id WHERE eucharist_details.ed_eref='$e_reference' ");
while ($row=mysqli_fetch_assoc($P_e_details)){

	$Names=$row['bs_lname']." ".$row['bs_fname'];

	 $num++; 
	 $pdf->Cell(5,10,$num,1,0,'C');
	 $pdf->Cell(64,10,$Names,1,0,'C');
	 $pdf->Cell(30,10,$row["bs_phone"],1,0,'C');
	 $pdf->Cell(40,10,$row["bs_idnumber"],1,0,'C');
	 $pdf->Cell(40,10,$row["bs_village"],1,0,'C');
	 $pdf->Cell(35,10,$row["bs_cell"],1,0,'C');
	 $pdf->Cell(30,10,$row["bs_sector"],1,0,'C');
	 $pdf->Cell(30,10,$row["bs_district"],1,1,'C');
	 
}



$pdf->Ln(30);

$pdf ->Cell(50,10,'CHILDREN:',0,1,'C');

$pdf->SetFillColor(255,224,0);

$pdf->Cell(5,10,'#',1,0,'C',true);
$pdf->Cell(80,10,'Child Names',1,0,'C',true);
$pdf->Cell(80,10,'Parent Contact',1,1,'C',true);
// $pdf->Cell(40,10,'ID Number',1,0,'C',true);
// $pdf->Cell(30,10,'Village',1,0,'C',true);
// $pdf->Cell(35,10,'Cell',1,0,'C',true);
// $pdf->Cell(35,10,'Sector',1,0,'C',true);
// $pdf->Cell(35,10,'District',1,1,'C',true);

// $numb=0;

$P_e_details=mysqli_query($db,"SELECT eucharistc_details.*,children.* FROM eucharistc_details JOIN children ON eucharistc_details.edc_chid=children.ch_id WHERE eucharistc_details.edc_eref='$e_reference' ");
while ($row=mysqli_fetch_assoc($P_e_details)){

	$Namesc=$row['ch_lname']." ".$row['ch_fname'];

	 $num++; 
	 $pdf->Cell(5,10,$num,1,0,'C');
	 $pdf->Cell(80,10,$Namesc,1,0,'C');
	 $pdf->Cell(80,10,$row["edc_bsphone"],1,1,'C');
	 // $pdf->Cell(40,10,$row["bs_idnumber"],1,0,'C');
	 // $pdf->Cell(30,10,$row["bs_village"],1,0,'C');
	 // $pdf->Cell(35,10,$row["bs_cell"],1,0,'C');
	 // $pdf->Cell(35,10,$row["bs_sector"],1,0,'C');
	 // $pdf->Cell(35,10,$row["bs_district"],1,1,'C');
	 
}

$pdf->Output();

 ?>
