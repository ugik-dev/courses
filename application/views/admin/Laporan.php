<?php 

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=laporan.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Pariwisata</title>
</head>
<body>

      <div> <h5>Urusan Pilihan Pariwisata</h5>
      </div>
      <style>
.elemen1 { padding-left: 0.5em }
.elemen2 { padding-left: 2.5em }
.elemen3 { padding-left: 4.5em }
</style>
  <div> <h5>Urusan Pilihan Pariwisata</h5>
      </div>
      <table border="1px solid" width="100%">
        <thead>
          <tr align=center >
            <th >#</th>
            <th colspan="1">Element</th>

            <?php foreach($tahun as $th){?>
            <th>  <?php echo $th['tahun']; ?> </th>
            <?php }; ?>
            <th > Satuan</th> 
            <th > Kewenangan</th> 
            <th > Data</th> 
            <th > Data</th>   
          </tr>
        </thead>
        
 
        <tbody id="kebudayaan">  
        <?php 
         $i = 0;
        foreach($datapariwisata[$tahun[0]['tahun']] as $tmp){
          $elemen=explode('.',$tmp['id_elemen']);
          $elemenx=count($elemen);
          if($elemenx == '1'){
            $col = 'elemen1';
          }else if($elemenx == '2'){
            $col = 'elemen2';
          }else{
            $col = 'elemen3';
          };

          ?>
          <tr>
            <td style="width: 50px;" class="elemen1"><?php echo  $tmp['id_elemen'];?> </td>
            <td style="width: 400px;" class="<?php echo $col;?>"><?php echo $tmp['nama_elemen'];?> </td>
              
              <?php 
             
              foreach($tahun as $th){?>
                    <td style="width: 200px;" align=center><?php 
                    if(!empty($vp[$th['tahun']][$i])){echo $vp[$th['tahun']][$i];}else{ echo '0'; } 
                    ?>  
                    <?php
                     //echo $datapariwisata[$th['tahun']][$i]['value']
                     ?> 
                    
                    </td>          
              <?php };
              $i++;
              ?>
              
              <td style="width: 80px;"><?php echo $tmp['satuan'];?> </td>
              <td style="width: 200px;"><?php echo $tmp['kewenangan'];?> </td>
              <td style="width: 150px;"><?php echo $tmp['data_tunggal'];?> </td>
              <td style="width: 150px;"><?php echo $tmp['data_sektoral'];?> </td>
          </tr>
         
        <?php }; ?>
        </tbody>
      </table>
 
 <br>
 <br>
 <div> 
      <h5>Urusan Kewajiban Kebudayaan</h5>
      </div>
      <table border="1px solid" width="100%">
        <thead>
          <tr>
            <th >#</th>
            <th colspan="1">Element</th>

            <?php foreach($tahun as $th){?>
            <th>  <?php echo $th['tahun']; ?> </th>
            <?php }; ?>
            <th > Satuan</th> 
            <th > Kewenangan</th> 
            <th > Data</th> 
            <th > Data</th>   
          </tr>
        </thead>
        
 
        <tbody id="kebudayaan"> 
         
        <?php 
         $i = 0;
        foreach($datakebudayaan[$tahun[0]['tahun']] as $tmp){
          $elemen=explode('.',$tmp['id_elemen']);
          $elemenx=count($elemen);
          if($elemenx == '1'){
            $col = 'elemen1';
          }else if($elemenx == '2'){
            $col = 'elemen2';
          }else{
            $col = 'elemen3';
          };
          ?>
          <tr>
            <td style="width: 50px;" class="elemen1"><?php echo  $tmp['id_elemen'];?> </td>
            <td style="width: 400px;" class="<?php echo $col;?>"><?php echo $tmp['nama_elemen'];?> </td>
              
              <?php 
             
              foreach($tahun as $th){?>
                    <td style="width: 200px;" align=center><?php 
                    if(!empty($vb[$th['tahun']][$i])){echo $vb[$th['tahun']][$i];}else{ echo '0'; } 
                   // echo $datakebudayaan[$th['tahun']][$i]['value']
                    ?> </td>          
              <?php };
              $i++;
              ?>
              
              <td style="width: 80px;"><?php echo $tmp['satuan'];?> </td>
              <td style="width: 200px;"><?php echo $tmp['kewenangan'];?> </td>
              <td style="width: 150px;"><?php echo $tmp['data_tunggal'];?> </td>
              <td style="width: 150px;"><?php echo $tmp['data_sektoral'];?> </td>
          </tr>
         
        <?php }; ?>
        </tbody>
      </table>
 


</body>
</html>
<script>
