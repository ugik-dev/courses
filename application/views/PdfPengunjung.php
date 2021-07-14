<?php 
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
    }else if($N=='8'){
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
   
$pdf = new FPDF('l','mm','A4');
// Menambah halaman baru
$pdf->AddPage();
// Setting jenis font
$pdf->SetFont('Arial','B',11);
// Membuat string
$tmpdl = 0;
$tmpdp = 0;
$tmpml = 0;
$tmpmp = 0;
$tmppajak = 0;
$tmpretribusi = 0;
if($getdata['tb']=='biro'){
$pdf->Cell(272,3,'Data Penumpang '.$header,0,1,'C');
}else{
    $pdf->Cell(272,3,'Data Pengunjung '.$header,0,1,'C');
}
$pdf->SetFont('Arial','B',10);
$pdf->Cell(90,7,' ',0,1);
$pdf->Cell(50,7,'Nama '.$header,0,0);
$pdf->Cell(3,7,': '.$data_profil['nama'],0,0);
$pdf->Cell(100,7,' ',0,0);
$pdf->Cell(50,7,'Nama Pimpinan',0,0);
$pdf->Cell(3,7,': '.$nama_approv,0,1);
$pdf->Cell(50,1,'Kabupaten :',0,0);
$pdf->Cell(3,1,': '.$data_profil['nama_kabupaten'],0,0);
$pdf->Cell(100,1,' ',0,0);
$pdf->Cell(50,1,'Nama Operator',0,0);
$pdf->Cell(3,1,': '.$nama_entry,0,1);
$pdf->Cell(50,7,'Tahun',0,0);
$pdf->Cell(3,7,': '.$tahun,0,1);
$pdf->Cell(100,2,' ',0,1);
// Setting spasi kebawah supaya tidak rapat
//$pdf->MultiCell($cellWidth,$cellHeight,$hasil['pesan'],1);
//$pdf->MultiCell(50,13,'test',1);
$pdf->MultiCell(50,12,'Bulan',1,'C',0);
$pdf->SetXY(40 + 20 , 24+13);
$pdf->Cell(60,6,'Domestik',1,'','C'); 
$pdf->Cell(60,6,'Mancanegara',1,'','C'); 
$pdf->Cell(50,12,'Pajak',1,'','C');
$pdf->Cell(50,12,'Retribusi',1,1,'C');
$pdf->SetXY(40 + 20 , 30+13);


$pdf->Cell(30,6,'Perempuan',1,0,'C'); 
$pdf->Cell(30,6,'Laki-laki',1,0,'C'); 
$pdf->Cell(30,6,'Perempuan',1,0,'C'); 
$pdf->Cell(30,6,'Laki-laki',1,1,'C'); 
$pdf->SetFont('Arial','',10);
foreach ($data as $key => $value){

$pdf->Cell(50,6,getBulan($value['bulan']),1,0);
$pdf->Cell(30,6,$value['domestik_p'],1,0); 
$pdf->Cell(30,6,$value['domestik_l'],1,0); 
$pdf->Cell(30,6,$value['mancanegara_p'],1,0); 
$pdf->Cell(30,6,$value['mancanegara_l'],1,0); 
$pdf->Cell(50,6, "Rp " . number_format($value['pajak'],2,',','.'),1,0); 
$pdf->Cell(50,6, "Rp " . number_format($value['retribusi'],2,',','.'),1,1); 

$tmpdl += $value['domestik_l'];
$tmpdp += $value['domestik_p'];
$tmpml += $value['mancanegara_l'];
$tmpmp += $value['mancanegara_p'];
$tmppajak += $value['pajak'];
$tmpretribusi += $value['retribusi'];

}
$pdf->Cell(50,6,'Jumlah',1,0);

// $pdf->Cell(50,6,getBulan($value['bulan']),1,0);
 $pdf->Cell(30,6,$tmpdp,1,0); 
$pdf->Cell(30,6,$tmpdl,1,0); 
$pdf->Cell(30,6,$tmpmp,1,0); 
$pdf->Cell(30,6,$tmpml,1,0); 
$pdf->Cell(50,6, "Rp " . number_format($tmppajak,2,',','.'),1,0); 
$pdf->Cell(50,6, "Rp " . number_format($tmpretribusi,2,',','.'),1,1); 
//foreach (array_expression as $key => $value)
$tmpdate = explode('-',$today);

$pdf->Cell(10,7,' ',0,1);
$pdf->Cell(150,3," ",0,0); 
$pdf->Cell(100,7,$data_profil['nama_kabupaten'].', '.$tmpdate[1].' '.getBulan($tmpdate[2]).' '.$tmpdate[3],0,1,'C'); 
$pdf->Cell(150,3," ",0,0); 
$pdf->Cell(100,3,'Approval',0,1,'C'); 
$pdf->Cell(150,45," ",0,0); 
$pdf->Cell(100,45,'(  '.$nama_approv.'  )',0,1,'C');
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