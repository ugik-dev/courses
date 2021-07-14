<?php if($this->session->userdata('id_role') == '1'){?>
<a class="btn btn-light my-1 mr-sm-2" href="<?=site_url('AdminController/Laporan')?>"> <i class="fal fa-download"></i> Export Excel</a>
<?php }else if($this->session->userdata('id_role') == '2'){ ?>
<a class="btn btn-light my-1 mr-sm-2" href="<?=site_url('OperatorController/Laporan')?>"> <i class="fal fa-download"></i> Export Excel</a>
<?php }else{ ?>
<a class="btn btn-light my-1 mr-sm-2" href="<?=site_url('PimpinanController/Laporan')?>"> <i class="fal fa-download"></i> Export Excel</a>
<?php };?>
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
 
 <br>
 <br>


  <!-- <div class="col-lg-12">
      <div class="tabs-container">
          <ul class="nav nav-tabs" role="tablist">
              <li><a class="nav-link active" data-toggle="tab" href="#tab-1"> Urusan Kewajiban Kebudayaan</a></li>
              <li><a class="nav-link" data-toggle="tab" href="#tab-2">Urusan Pilihan Pariwisata</a></li>
          </ul>
          <div class="tab-content">
              <div role="tabpanel" id="tab-1" class="tab-pane active">
                <div class="panel-body" id="input_modal2">
                  <form id="kebudayaan_form">

                          <div class="form-inline">
                            <div class="form-group mb-2">
                              <select class="dropdown-item" id="tahun_input2" name="tahun_input" required="required"></select>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                              <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_edit_btn2" data-loading-text="Loading..." onclick="this.form.target='edit'"><strong><i class="fal fa-save"></i> Simpan Data</strong></button>
                            </div>
                            <div class="form-group mx-sm-3 mb-2" id="header_approv2">
                            </div>
                          </div>
                    <div id="form_kebudayaan">   </div>
                  </form>
                </div>
              </div>
              <div role="tabpanel" id="tab-2" class="tab-pane">
                  <div class="panel-body" id="input_modal">
                  <form id="pariwisata_form">

                        <div class="form-inline">
                            <div class="form-group mb-2">
                              <select class="dropdown-item" id="tahun_input" name="tahun_input" required="required"></select>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                              <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_edit_btn" data-loading-text="Loading..." onclick="this.form.target='edit'"><strong><i class="fal fa-save"></i> Simpan Data</strong></button>
                            </div>
                            <div class="form-group mx-sm-3 mb-2" id="header_approv">
                            </div>
                          </div>

                      <div id="form_pariwisata">   </div>

                    </form>
                  </div>
              </div>
          </div>
        </div>
    </div> -->

    <!-- <div class="row">                
    <div class="col-lg-6">
      <div class="ibox" id="input_modal2">
      
        <div class="ibox-content" id=""><h5></h5>
          
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="ibox" id="input_modal">
      
        <div class="ibox-content" id=""><h5></h5>
          <form id="pariwisata_form">

            <select class="dropdown-item" id="tahun_input" name="tahun_input" required="required"></select>
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_edit_btn" data-loading-text="Loading..." onclick="this.form.target='edit'"><strong>Simpan Perubahan</strong></button>
            <div id="form_pariwisata">   </div>
            
          </form>
        </div>
      </div>
    </div>
   -->

<script>
$(document).ready(function() {
  $('#laporan').addClass('active');
  $('#tablelaporan').dataTable();
  $('#tablelaporan2').dataTable();
  dataFormat = {};
  dataFormat2 = {};
  function getExport(){
      $.ajax({
        url: `<?=site_url('AdminController/Laporan')?>`, 'type': 'Get',
        data: {},
        success: function (data){
          
        },
        error: function(e) {}
      });
    }
    var InputModal = {
       'form': $('#input_modal').find('#pariwisata_form'),
       'tahun': $('#input_modal').find('#tahun_input'),
       'saveBtn': $('#input_modal').find('#save_edit_btn'),
       
    }
    var InputModal2 = {
       'form': $('#input_modal2').find('#kebudayaan_form'),
       'tahun': $('#input_modal2').find('#tahun_input2'),
       'saveBtn': $('#input_modal2').find('#save_edit_btn2'),
       
    }
    InputModal.saveBtn.hide();
    InputModal2.saveBtn.hide();
  var swalSaveConfigure = {
    title: "Konfirmasi simpan",
    text: "Yakin akan menyimpan data ini?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#18a689",
    confirmButtonText: "Ya, Simpan!",
  };

    InputModal.form.submit(function(event){
    event.preventDefault();
    switch(InputModal.form[0].target){
      case 'edit':
       console.log("masuk");
       saveForm()
        break;
    }
    });



    InputModal2.form.submit(function(event){
    event.preventDefault();
    switch(InputModal2.form[0].target){
      case 'edit':
       console.log("masuk");
       saveForm2()
        break;
    }
    });

   function saveForm(){
    swal(swalSaveConfigure).then((result) => {
      if(!result.value){ return; }
     // buttonLoading(ObjekModal.addBtn);
      $.ajax({
        url: `<?=site_url('LaporanPariwisataController/saveForm')?>`, 'type': 'POST',
        data: InputModal.form.serialize(),
        success: function (data){
          buttonIdle(InputModal.saveBtn);
          var json = JSON.parse(data);
          if(json['error']){
            swal("Simpan Gagal", json['message'], "error");
            return;
          }
         
          swal("Simpan Berhasil", "", "success");
         
        },
        error: function(e) {}
      });
    });
   };

   function saveForm2(){
    swal(swalSaveConfigure).then((result) => {
      if(!result.value){ return; }
      buttonLoading(InputModal2.saveBtn);
      $.ajax({
        url: `<?=site_url('LaporanPariwisataController/saveForm2')?>`, 'type': 'POST',
        data: InputModal2.form.serialize(),
        success: function (data){
          buttonIdle(InputModal2.saveBtn);
          var json = JSON.parse(data);
          if(json['error']){
            swal("Simpan Gagal", json['message'], "error");
            return;
          }
          swal("Simpan Berhasil", "", "success");        
        },
        error: function(e) {}
      });
    });
   };

    function getFormat(){
    return $.ajax({
      url: `<?php echo site_url('LaporanPariwisataController/getFormat')?>`, 'type': 'GET',
      data: {tahun: InputModal.tahun.val()},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataFormat = json['data'];
        //console.log(dataFormat['0']);
        renderFormat();
          },
          error: function(e) {}
        });
      };

      function getFormat2(){
      return $.ajax({
      url: `<?php echo site_url('LaporanPariwisataController/getFormat2')?>`, 'type': 'GET',
      data: {tahun: InputModal2.tahun.val()},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataFormat2 = json['data'];
        //console.log(dataFormat['0']);
        renderFormat2();
          },
          error: function(e) {}
        });
      };
      
      function renderFormat2(){
        var html = ''; 
        for(var i=0; i<70 ; i++ ){
          var tmp = dataFormat2[i]['id_elemen'];
          var tmp2 = tmp.split(".");
       
          if(tmp2.length == 1){
            col1="0";
            col2="7";
          }else if(tmp2.length == 2){ 
            col1="1";
            col2="6";
          }else{
            col1="2";
            col2="5";
          };
          html +=`
          <div class="form-group row">
            <div class="col-sm-${col1}"></div>
            <label for="" class="col-sm-${col2} col-form-label">${dataFormat2[i]['id_elemen']} - ${dataFormat2[i]['nama_elemen']}</label>
            <div class="col-sm-4">
                <div class="row">
                  <input type="number" class="form-control" value="${dataFormat2[i]['id_data']}" name="id_data${dataFormat2[i]['id_format']}" style="width: 0%" hidden>
                  <input type="number" class="form-control" value="${dataFormat2[i]['value']}" name="${dataFormat2[i]['id_format']}" id="" style="width: 60%"  placeholder="${dataFormat2[i]['satuan']}">
                  <div class="container" style="width: 20%"><label style="width: 100%" > ${dataFormat2[i]['satuan']}</label>
                  </div>
                </div> 
            </div>         
          </div>
          `;
          }
          var header_approv2 = document.getElementById("header_approv2");  
          //if(false){
         if(dataFormat2[1]['id_approv']=='0' ||dataFormat2[1]['id_approv']== null){
            header_approv2.innerHTML = `<h5><span class="badge badge-warning">Data Belum di Approv</span></h5>`;
          }else{
            header_approv2.innerHTML = `<h5><span class="badge badge-info">Data Sudah Approv</span></h5>`;  

          }
          html +=` 
          <br>
          `;
          $('#form_kebudayaan').html(html);
      }

      function renderFormat(){
        var html = ''; 
        for(var i=0; i<132 ; i++ ){
          var tmp = dataFormat[i]['id_elemen'];
          var tmp2 = tmp.split(".");
       
          if(tmp2.length == 1){
            col1="0";
            col2="7";
          }else if(tmp2.length == 2){ 
            col1="1";
            col2="6";
          }else{
            col1="2";
            col2="5";
          };
          html +=`
          <div class="form-group row">
            <div class="col-sm-${col1}"></div>
              <label for="" class="col-sm-${col2} col-form-label">${dataFormat[i]['id_elemen']} - ${dataFormat[i]['nama_elemen']}</label>
                <div class="col-sm-4">
                <div class="row">
                <input type="number" class="form-control" value="${dataFormat[i]['id_data']}" name="id_data${dataFormat[i]['id_format']}" hidden>
                <input type="number" class="form-control" value="${dataFormat[i]['value']}" name="${dataFormat[i]['id_format']}" id="" placeholder="${dataFormat[i]['nama_elemen']}" style="width: 60%">
                <div class="container" style="width: 20%"><label style="width: 100%" > ${dataFormat[i]['satuan']}</label>
                  </div>
                </div>
              </div>         
          </div>
          
          `;
          }
        var header_approv = document.getElementById("header_approv");  
          //if(false){
         if(dataFormat[1]['id_approv']=='0' ||dataFormat[1]['id_approv']== null){
            header_approv.innerHTML = `<h5><span class="badge badge-warning">Data Belum di Approv</span></h5>`;
          }else{
            header_approv.innerHTML = `<h5><span class="badge badge-info">Data Sudah Approv</span></h5>`;  
           
          }

          html +=` 
         
          `;
          $('#form_pariwisata').html(html);
      }
      
    getTahun();  
    function getTahun(){
    return $.ajax({
      url: `<?php echo site_url('LaporanPariwisataController/getTahun/')?>`, 'type': 'GET',
      data: {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataTahun = json['data'];
        renderTahunSelection(dataTahun);
      },
        error: function(e) {}
      });
    }


  function renderTahunSelection(data){  
    InputModal.tahun.empty();
    InputModal.tahun.append($('<option>', { value: "", text: "Tahun"}));
    data.forEach((d) => {
      InputModal.tahun.append($('<option>', {
        value: d['tahun'],
        text: d['tahun'],
      }));  
    });

    InputModal2.tahun.empty();
    InputModal2.tahun.append($('<option>', { value: "", text: "Tahun"}));
    data.forEach((d) => {
      InputModal2.tahun.append($('<option>', {
        value: d['tahun'],
        text: d['tahun'],
      }));  
    });
   }

  $("#tahun_input").click(function(e) {
    
      registerTahunSelectionChange();
   //   console.log("fungsi clik tahun aktif" );

  });
  $("#tahun_input2").click(function(e) {
    
    registerTahunSelectionChange2();
     console.log("fungsi clik tahun aktif" );

  });

  function registerTahunSelectionChange2(){
    InputModal2.tahun.on('change', function(e){
      InputModal2.saveBtn.show();
       getFormat2(); 
      console.log('regis run thun :',InputModal2.tahun.val());
  });
  };

  function registerTahunSelectionChange(){
    InputModal.tahun.on('change', function(e){
      InputModal.saveBtn.show();
      getFormat(); 
     // console.log('regis run thun :',InputModal.tahun.val());
  });
  };

 // document.getElementById("export_btn").onclick = function() {getExport()};
 

});
</script>
