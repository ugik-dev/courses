<?php 
// var_dump($dataProfil);
function getBulan($N)
{
    if($N=='1'){
        return 'Januari';
    }else if($N=='2'){
        return 'Februari';
    }else if($N=='3'){
        return 'Maret';
    }else if($N=='4'){
        return 'April';
    }else if($N=='5'){
        return 'Mei';
    }else if($N=='6'){
        return 'Juni';
    }else if($N=='7'){
        return 'Juli';
    }else if($N=='87'){
        return 'Agustus';
    }else if($N=='9'){
        return 'September';
    }else if($N=='10'){
        return 'Oktober';
    }else if($N=='11'){
        return 'November';
    }else if($N=='12'){
        return 'Desember';
    }
}

$today = date('N-d-m-Y');

?>
<?php
 require('assets/fpdf/fpdf.php');
   //var_dump($dataProfil);
   // echo $dataProfil['nama'];
   
$pdf = new FPDF('p','mm','A4');
// Menambah halaman baru
$pdf->AddPage();
// Setting jenis font
$pdf->SetFont('Arial','B',16);
// Membuat string
$pdf->Cell(195,7,$dataProfil['nama'],0,1,'C');
$pdf->SetFont('Arial','B',9);
$pdf->Cell(195,7,$dataProfil['alamat'],0,1,'C');
// Setting spasi kebawah supaya tidak rapat
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(50,7,'Jenis ',0,0); 
$pdf->Cell(10,7,' : '.$dataProfil['nama_j_senibudaya'],0,1); 
$pdf->Cell(50,7,'Sub - Jenis ',0,0); 
$pdf->Cell(10,7,' : '.$dataProfil['nama_j2_senibudaya'],0,1); 

$pdf->Cell(50,7,'Kabupaten',0,0); 
$pdf->Cell(10,7,' : '.$dataProfil['nama_kabupaten'],0,1);
$pdf->Cell(50,7,'Kordinat Lokasi',0,0); 
$pdf->Cell(10,7,' : '.$dataProfil['lokasi'],0,1);  
$pdf->Cell(50,7,'Data Entry',0,0); 
$pdf->Cell(10,7,' : '.$entry,0,1); 
$pdf->Cell(50,7,'Approval',0,0); 
$pdf->Cell(10,7,' : '.$approv,0,1);
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(10,7,'',0,1);
$tmpdate = explode('-',$today);
$pdf->Cell(250,7,'Pangkalpinang, '.$tmpdate[1].' '.getBulan($tmpdate[2]).' '.$tmpdate[3],0,1,'C'); 
$pdf->Cell(250,3,'Approval',0,1,'C'); 
$pdf->Cell(250,50,'( '.$approv.' )',0,1,'C');
// $url = 'upload\file/'.$dataProfil['file'];
// $pdf->Image($url,43,190,130,50); 

// $pdf->SetFont('Arial','B',10);
// $pdf->Cell(10,6,'NO',1,0);
// $pdf->Cell(50,6,'NAMA MOTOR',1,0);
// $pdf->Cell(35,6,'WARNA',1,0);
// $pdf->Cell(30,6,'BRAND',1,0);
// $pdf->Cell(25,6,'HARGA',1,0);
// $pdf->Cell(25,6,'CICILAN',1,1);
 
$pdf->SetFont('Arial','',10);
$pdf->Output();
?>

<html><head><title>PARIWISATA - PDF DETAIL CAGAR BUDAYA -</title></head></html>