<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="toolbar_form" onsubmit="return false;">
        
        <button type="submit" class="btn btn-success my-1 mr-sm-2" id="show_btn"  data-loading-text="Loading..." onclick="this.form.target='show'"><i class="fal fa-eye"></i> Tampilkan</button>
        <button type="submit" class="btn btn-primary my-1 mr-sm-2" id="add_btn"  data-loading-text="Loading..." onclick="this.form.target='add'"><i class="fal fa-plus"></i> Tambah</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
              <thead>
                <tr>
         
                  <th style="width: 15%; text-align:center!important">Nama Mata Pelajaran</th>
                  <th style="width: 12%; text-align:center!important">Status</th>
                  <!-- <th style="width: 12%; text-align:center!important">Role</th> -->
                  <!-- <th style="width: 10%; text-align:center!important">Kabupaten / Kota</th> -->
                  <th style="width: 7%; text-align:center!important">Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal inmodal" id="mapel_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Kelola Mapel</h4>
        <span class="info"></span>
      </div>
      <div class="modal-body" id="modal-body">              
        <form role="form" id="mapel_form" onsubmit="return false;" type="multipart" autocomplete="off">
          <input type="hidden" id="id_mapel" name="id_mapel">
          <div class="form-group">
            <label for="nama">Nama Mapel</label> 
            <input type="text" placeholder="" class="form-control" id="nama" name="nama" required="required">
          </div>
          <div class="form-group">
            <label for="id_status">Status</label> 
            <select class="form-control mr-sm-2" id="id_status" name="id_status" required="required">
            </select>
          </div>
          <button class="btn btn-success my-1 mr-sm-2" type="submit" id="add_btn" data-loading-text="Loading..." onclick="this.form.target='add'"><strong>Tambah Data</strong></button>
          <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_edit_btn" data-loading-text="Loading..." onclick="this.form.target='edit'"><strong>Simpan Perubahan</strong></button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script>
$(document).ready(function() {

  $('#kelolahmapel').addClass('active');


  var toolbar = {
    'form': $('#toolbar_form'),
    'showBtn': $('#show_btn'),
    'addBtn': $('#show_btn'),
  }

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [],
    deferRender: true,
    "order": [[ 0, "desc" ]]
  });

  var ResetModal = {
    'self': $('#reset_modal'),
    'info': $('#reset_modal').find('.info'),
    'form': $('#reset_modal').find('#reset_form'),
    'addBtn': $('#reset_modal').find('#add_btn'),
    'saveEditBtn': $('#reset_modal').find('#save_edit_btn'),
    'id_mapel': $('#reset_modal').find('#id_mapel'),
    'password': $('#reset_modal').find('#password'),
    'repassword': $('#reset_modal').find('#repassword'),
  }
  var KelolahmapelModal = {
    'self': $('#mapel_modal'),
    'info': $('#mapel_modal').find('.info'),
    'form': $('#mapel_modal').find('#mapel_form'),
    'addBtn': $('#mapel_modal').find('#add_btn'),
    'saveEditBtn': $('#mapel_modal').find('#save_edit_btn'),
    'id_mapel': $('#mapel_modal').find('#id_mapel'),
    'nama': $('#mapel_modal').find('#nama'),
    'mapelname': $('#mapel_modal').find('#mapelname'),
    'id_role': $('#mapel_modal').find('#id_role'),
    'password': $('#mapel_modal').find('#password'),
    'repassword': $('#mapel_modal').find('#repassword'),
    'lokasi': $('#mapel_modal').find('#lokasi'),
    'deskripsi': $('#mapel_modal').find('#deskripsi'),
    'kabupaten': $('#mapel_modal').find('#kabupaten'),
  }
  KelolahmapelModal.password.on('change', () => {
    confirmPasswordRule(KelolahmapelModal.password, KelolahmapelModal.repassword);
  });

  KelolahmapelModal.repassword.on('keyup', () => {
    confirmPasswordRule(KelolahmapelModal.password, KelolahmapelModal.repassword);
  });

  function confirmPasswordRule(password, rePassword){
    if(password.val() != rePassword.val()){
      rePassword[0].setCustomValidity('Password tidak sama');
    } else {
      rePassword[0].setCustomValidity('');
    }
  }
  
  ResetModal.password.on('change', () => {
    confirmPasswordRule(ResetModal.password, ResetModal.repassword);
  });

  ResetModal.repassword.on('keyup', () => {
    confirmPasswordRule(ResetModal.password, ResetModal.repassword);
  });

 
  var swalSaveConfigure = {
    title: "Konfirmasi simpan",
    text: "Yakin akan menyimpan data ini?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#18a689",
    confirmButtonText: "Ya, Simpan!",
  };

  var swalDeleteConfigure = {
    title: "Konfirmasi hapus",
    text: "Yakin akan menghapus data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya, Hapus!",
  };

  var dataKelolahmapel = {};
  var dataRole = {};

  toolbar.form.submit(function(event){
    event.preventDefault();
    switch(toolbar.form[0].target){
      case 'show':
        getKelolahmapel();
        break;
      case 'add':
        showKelolahmapelModal();
        break;
    }
  });

  getAllRole();  
  function getAllRole(){
    return $.ajax({
      url: `<?php echo site_url('KelolahmapelController/getAllRoleOption/')?>`, 'type': 'GET',
      data: {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRole = json['data'];
        renderRoleSelection(dataRole);
      },
      error: function(e) {}
    });
  }


  getAllMapel();  
  function getAllMapel(){
    return $.ajax({
      url: `<?php echo site_url('KelolahmapelController/getAllKelolahMapel/')?>`, 'type': 'GET',
      data: {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataMapel = json['data'];
        renderKelolahmapel(dataMapel);
      },
      error: function(e) {}
    });
  }


   function renderRoleSelection(data){
    KelolahmapelModal.id_role.empty();
    KelolahmapelModal.id_role.append($('<option>', { value: "", text: "-- Pilih Role --"}));
    Object.values(data).forEach((d) => {
      KelolahmapelModal.id_role.append($('<option>', {
        value: d['id_role'],
        text: d['id_role'] + ' :: ' + d['title_role'],
      }));
    });
  }
  

  function renderKelolahmapel(data){
    if(data == null || typeof data != "object"){
      console.log("Mapel::UNKNOWN DATA");
      return;
    }

    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((mapel) => {
     
      var detailButton =`
      <a class="detail dropdown-item" href='<?=site_url()?>AdminController/DetailKelolahmapel?id_mapel=${mapel['id_mapel']}&nama_mapel=${mapel['nama']}'><i class='fa fa-share'></i> Detail Desa Wisata</a>
      `; 
      var editButton = `
        <a class="edit dropdown-item" data-id='${mapel['id_mapel']}'><i class='fa fa-pencil'></i> Edit Data Mapel</a>
      `;
      var resetButton = `
        <a class="resetpassword dropdown-item" data-id='${mapel['id_mapel']}'><i class='fa fa-pencil'></i>Reset Password</a>
      `;
      var deleteButton = `
        <a class="delete dropdown-item" data-id='${mapel['id_mapel']}'><i class='fa fa-trash'></i> Hapus Mapel</a>
      `;
      var button = `
        <div class="btn-group" role="group">
          <button id="action" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
          ${resetButton}
            ${editButton}
            ${deleteButton}
          </div>
        </div>
      `;
      renderData.push([mapel['mapelname'],mapel['nama'], mapel['nama_role'], button]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  FDataTable.on('click','.resetpassword', function(){
  console.log('reset');
  var id = $(this).data('id');
    var mapel = dataKelolahmapel[id];
    ResetModal.form.trigger('reset');
    ResetModal.self.modal('show');
    ResetModal.addBtn.hide();
    ResetModal.saveEditBtn.show();
    var id = $(this).data('id');
    var mapel = dataKelolahmapel[id];
    ResetModal.id_mapel.val(mapel['id_mapel']);
  });

  FDataTable.on('click','.edit', function(){
    event.preventDefault();
    KelolahmapelModal.form.trigger('reset');
    KelolahmapelModal.self.modal('show');
    KelolahmapelModal.addBtn.hide();
    KelolahmapelModal.saveEditBtn.show();
    var id = $(this).data('id');
    var mapel = dataKelolahmapel[id];
    KelolahmapelModal.password.prop('disabled',true);   
    KelolahmapelModal.repassword.prop('disabled',true);   
    KelolahmapelModal.id_mapel.val(mapel['id_mapel']);
    KelolahmapelModal.nama.val(mapel['nama']);
    KelolahmapelModal.mapelname.val(mapel['mapelname']);
    KelolahmapelModal.id_role.val(mapel['id_role']);
    if(KelolahmapelModal.id_role.val()=='1'){
        KelolahmapelModal.kabupaten.prop('disabled',true);   
    }else{
        KelolahmapelModal.kabupaten.prop('disabled',false); 
        KelolahmapelModal.kabupaten.val(mapel['id_kabupaten']);  
    }
    
  });
  KelolahmapelModal.id_role.on('change', () => {
    if(KelolahmapelModal.id_role.val()=='1'){
        KelolahmapelModal.kabupaten.prop('disabled',true);   
    }else{
        KelolahmapelModal.kabupaten.prop('disabled',false); 
    }
  });

  FDataTable.on('click','.delete', function(){
    event.preventDefault();
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('KelolahmapelController/deleteKelolahmapel')?>", 'type': 'POST',
        data: {'id_mapel': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataKelolahmapel[id];
          swal("Delete Berhasil", "", "success");
          renderKelolahmapel(dataKelolahmapel);
        },
        error: function(e) {}
      });
    });
  });

  function showKelolahmapelModal(){
    KelolahmapelModal.self.modal('show');
    KelolahmapelModal.addBtn.show();
    KelolahmapelModal.saveEditBtn.hide();
    KelolahmapelModal.form.trigger('reset');
    KelolahmapelModal.password.prop('disabled',false);   
    KelolahmapelModal.repassword.prop('disabled',false);   
  }

  ResetModal.form.submit(function(event){
    event.preventDefault();
    switch(ResetModal.form[0].target){    
      case 'edit':
        editPassword();
        break;
    }
  });

  KelolahmapelModal.form.submit(function(event){
    event.preventDefault();
    switch(KelolahmapelModal.form[0].target){
      case 'add':
        addKelolahmapel();
        break;
      case 'edit':
        editKelolahmapel();
        break;
    }
  });

  function addKelolahmapel(){
    swal(swalSaveConfigure).then((result) => {
      if(!result.value){ return; }
      buttonLoading(KelolahmapelModal.addBtn);
      $.ajax({
        url: `<?=site_url('KelolahmapelController/addMapel')?>`, 'type': 'POST',
        data: KelolahmapelModal.form.serialize(),
        success: function (data){
          buttonIdle(KelolahmapelModal.addBtn);
          var json = JSON.parse(data);
          if(json['error']){
            swal("Simpan Gagal", json['message'], "error");
            return;
          }
          var mapel = json['data']
          dataKelolahmapel[mapel['id_mapel']] = mapel;
          swal("Simpan Berhasil", "", "success");
          renderKelolahmapel(dataKelolahmapel);
          KelolahmapelModal.self.modal('hide');
        },
        error: function(e) {}
      });
    });
  }
  function editKelolahmapel(){
    swal(swalSaveConfigure).then((result) => {
      if(!result.value){ return; }
      buttonLoading(KelolahmapelModal.saveEditBtn);
      $.ajax({
        url: `<?=site_url('KelolahmapelController/editKelolahmapel')?>`, 'type': 'POST',
        data: KelolahmapelModal.form.serialize(),
        success: function (data){
          buttonIdle(KelolahmapelModal.saveEditBtn);
          var json = JSON.parse(data);
          if(json['error']){
            swal("Simpan Gagal", json['message'], "error");
            return;
          }
          var mapel = json['data']
          dataKelolahmapel[mapel['id_mapel']] = mapel;
          swal("Simpan Berhasil", "", "success");
          renderKelolahmapel(dataKelolahmapel);
          KelolahmapelModal.self.modal('hide');
        },
        error: function(e) {}
      });
    });
  }
  function editPassword(){
    swal(swalSaveConfigure).then((result) => {
      if(!result.value){ return; }
      buttonLoading(ResetModal.saveEditBtn);
      $.ajax({
        url: `<?=site_url('KelolahmapelController/editPassword')?>`, 'type': 'POST',
        data: ResetModal.form.serialize(),
        success: function (data){
          buttonIdle(ResetModal.saveEditBtn);
          var json = JSON.parse(data);
          if(json['error']){
            swal("Simpan Gagal", json['message'], "error");
            return;
          }
          var mapel = json['data']
          dataKelolahmapel[mapel['id_mapel']] = mapel;
          swal("Simpan Berhasil", "", "success");
          renderKelolahmapel(dataKelolahmapel);
          ResetModal.self.modal('hide');
        },
        error: function(e) {}
      });
    });
  }
});
</script> 