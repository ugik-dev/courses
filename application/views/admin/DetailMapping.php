<style>

</style>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="tabs-container">
    <ul class="nav nav-tabs" role="tablist">
      <li><a class="nav-link active" data-toggle="tab" href="#tab-11">Data Tenaga Kerja</a></li>
      <li><a class="nav-link" data-toggle="tab" href="#tab-22">Data Siswa</a></li>
    </ul>
    <div class="tab-content">
      <div role="tabpanel" id="tab-11" class="tab-pane active">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="ibox">
                <div class="ibox-content">
                  <div id="profil">
                    <form id="LayerModal">
                      <input type="hidden" placeholder="" id="id_mapping" name="id_mapping">
                      <input type="hidden" placeholder="" id="id_wali_kelas" name="id_wali_kelas">
                      <input type="hidden" placeholder="" id="jumlah_mapel" name="jumlah_mapel">

                      <div class="form-group col-lg-6">
                        <label for="nama_wali_kelas">Nama Wali Kelas</label>
                        <input type="text" placeholder="" class="form-control" id="nama_wali_kelas" name="nama_wali_kelas" required='required'>
                      </div>

                      <div class="form-group">
                        <div class="row m-t-sm">
                          <div class="col-lg-12">
                            <div class="table-responsive">
                              <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px;font-size:11px">
                                <thead>
                                  <tr>
                                    <th style="width: 19%; text-align:center!important">Mata Pelajaran</th>
                                    <th style="width: 19%; text-align:center!important">Tenaga Kerja</th>
                                  </tr>
                                </thead>
                                <tbody></tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <button class="save btn btn-success my-1 mr-sm-2" type="submit" id="save_profil_btn" data-loading-text="Loading..."><strong>Save</strong></button>
                    </form>
                    <form class="form-inline" id="toolbar_form" onsubmit="return false;">
                      <a type="" class="btn btn-light my-1 mr-sm-2" id="export_btn" href=""><i class="fal fa-download"></i> Export PDF</a>
                    </form>



                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div role="tabpanel" id="tab-22" class="tab-pane">
      <div class="panel-body">
        <div class="ibox">
          <div class="ibox-content" id="input_modal">
            <div class="form-inline">
              <div class="form-group mb-2">
                <button class="btn btn-success my-1 mr-sm-2" id="add_siswa" data-loading-text="Loading..."><i class="fal fa-plus"></i> <strong>Tambah Siswa</strong></button>
                <a type="" class="btn btn-light my-1 mr-sm-2" id="export_pengunjung_btn" href=""><i class="fal fa-download"></i> Export PDF</a>
              </div>
            </div>

            <form class="form" id="pengujung_form" onsubmit="return false;">
              <input type="hidden" id="id_mapping" name="id_mapping" readonly="readonly">
              <div id="input_data_pengunjung">

              </div>
            </form>
            <div class="form-group">
              <div class="row m-t-sm">
                <div class="col-lg-12">
                  <div class="table-responsive">
                    <table id="FDataTableSiswa" class="table table-bordered table-hover" style="padding:0px;font-size:11px">
                      <thead>
                        <tr>
                          <th style="width: 50%; text-align:center!important">Nama Siswa</th>
                          <th style="width: 40%; text-align:center!important">Nomor Induk</th>
                          <th style="width: 10%; text-align:center!important">Hapus</th>

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
      </div>
    </div>
  </div>



  <div class="modal inmodal" id="siswa_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content animated fadeIn">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Tambah Siswa</h4>
          <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">
          <form role="form" id="user_form" onsubmit="return false;" type="multipart" autocomplete="off">
            <input type="hidden" id="id_siswa" name="id_siswa">
            <input type="hidden" id="id_mapping" name="id_mapping">

            <div class="form-group">
              <label for="nama">Nama / Nomor Induk </label>
              <input type="text" placeholder="Nama / Nomor Induk" class="form-control" id="nama_nis" name="nama_nis" required="required">
            </div>

            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_siswa_btn" data-loading-text="Loading..." onclick="this.form.target='send'"><strong>Kirim</strong></button>
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
      $('#mapping').addClass('active');
      var id_mapping = "<?= $contentData['id_mapping'] ?>";
      var dataProfil;
      var dataTahun;
      var dataMapping = {};
      var dataTenagaKerja = {};
      var dataSiswa = {};



      var toolbar = {
        'form': $('#toolbar_form'),
        'saveBtn': $('#save_profil_btn'),
        'editBtn': $('#edit_profil_btn'),

        'id_mapping': $('#id_mapping'),
      }
      toolbar.id_mapping.val(id_mapping);

      var add_siswa = $('#add_siswa');

      var LayerModal = {
        'form': $('#LayerModal'),
        'nama_wali_kelas': $('#LayerModal').find('#nama_wali_kelas'),
        'id_wali_kelas': $('#LayerModal').find('#id_wali_kelas'),
        'jumlah_mapel': $('#LayerModal').find('#jumlah_mapel'),
        'save_profil_btn': $('#save_profil_btn')
      }

      var SiswaModal = {
        'self': $('#siswa_modal'),
        'info': $('#siswa_modal').find('.info'),
        'form': $('#siswa_modal').find('#user_form'),
        'save_siswa_btn': $('#siswa_modal').find('#save_siswa_btn'),
        'id_mapping': $('#siswa_modal').find('#id_mapping'),
        'nama_nis': $('#siswa_modal').find('#nama_nis'),
        'id_siswa': $('#siswa_modal').find('#id_siswa'),
        'nama_operator': $('#siswa_modal').find('#nama_operator'),
        'message': $('#siswa_modal').find('#message'),
        'format_message': $('#siswa_modal').find('#format_message'),
      }

      var FDataTable = $('#FDataTable').DataTable({
        'columnDefs': [{
          targets: [1],
          className: 'text-center'
        }, ],
        deferRender: true,
        "order": [
          [0, "desc"]
        ],
        paging: false,
        ordering: false,
        searching: false
      });

      var FDataTableSiswa = $('#FDataTableSiswa').DataTable({
        'columnDefs': [{
          targets: [2],
          className: 'text-center'
        }, ],
        deferRender: true,
        "order": [
          [0, "asc"]
        ],
        paging: false,
        ordering: true,
        searching: false
      });


      var swalApprovConfigure = {
        title: "Konfirmasi Approv",
        text: "Yakin akan Approv data profil ini?",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#18a689",
        confirmButtonText: "Ya, Approv!",
      };

      var swalSaveConfigure = {
        title: "Konfirmasi simpan",
        text: "Yakin akan menyimpan data ini?",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#18a689",
        confirmButtonText: "Ya, Simpan!",
      };

      swalAddSiswaConfigure = {
        title: "Konfirmasi Tambah",
        // text: "Yakin akan menyimpan data ini?",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#red",
        confirmButtonText: "Ya, Tambah!",
      };

      var swalDeleteConfigure = {
        title: "Konfirmasi Hapus Siswa",
        // text: "Yakin akan menghapus foto ini?",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#18a689",
        confirmButtonText: "Ya, Hapus!",
      };

      document.getElementById("export_btn").href = '<?= site_url('AdminController/PdfMapping?id_mapping=') ?>' + id_mapping;
      // initNavbar(200);
      $.when(getAllTenagaKerja()).then((e) => {}).fail((e) => {
        console.log(e)
      });


      function getAllTenagaKerja() {
        return $.ajax({
          url: `<?php echo site_url('KelolahuserController/getAllKelolahUser/') ?>`,
          'type': 'POST',
          data: {
            id_role: '2'
          },
          success: function(data) {
            var json = JSON.parse(data);
            if (json['error']) {
              return;
            }
            dataTenagaKerja = json['data'];
            renderTenagaKerja(dataTenagaKerja);


          },
          error: function(e) {}
        });
      }


      

      function getAllSiswa() {
        return $.ajax({
          url: `<?php echo site_url('ParameterController/getAllSiswa/') ?>`,
          'type': 'POST',
          data: {},
          success: function(data) {
            var json = JSON.parse(data);
            if (json['error']) {
              return;
            }
            dataSiswa = json['data'];
            getAllSiswaMapping()
            getAllMapping()
            SiswaModal.nama_nis.typeahead('destroy');
            SiswaModal.nama_nis.typeahead({
              source: Object.values(dataSiswa).map((e) => {
                return `${e['nama']} -- ${e['username']} -- ${e['id_user']}`;
              }),
              afterSelect: function(data) {
                strArrayData = data.split(" -- ")[2];
                // strArrayData2 = data.split(" -- ")[3];
                console.log(strArrayData)
                SiswaModal.id_siswa.val(strArrayData);
              }
            });
          },
          error: function(e) {}
        });
      }

      SiswaModal.form.submit(function(event) {
        event.preventDefault();
        swal(swalAddSiswaConfigure).then((result) => {
          if (!result.value) {
            return;
          }
          buttonLoading(SiswaModal.save_siswa_btn);
          $.ajax({
            url: `<?= site_url('KelolahmapelController/add_siswa') ?>`,
            'type': 'POST',
            data: SiswaModal.form.serialize(),
            success: function(data) {
              buttonIdle(SiswaModal.save_siswa_btn);
              var json = JSON.parse(data);
              if (json['error']) {
                swal("Simpan Gagal", json['message'], "error");
                return;
              }
              getAllSiswaMapping();
              SiswaModal.self.modal('hide');
              swal("Simpan Berhasil", "", "success");
              // getInputPengunjung();
            },
            error: function(e) {}
          });
        });

        console.log('submot')
      })

      function getAllSiswaMapping() {
        return $.ajax({
          url: `<?php echo site_url('ParameterController/getAllSiswaMapping/') ?>`,
          'type': 'POST',
          data: {
            id_mapping: id_mapping
          },
          success: function(data) {
            var json = JSON.parse(data);
            if (json['error']) {
              return;
            }
            dataSiswaMapping = json['data'];
            renderSiswaMapping(dataSiswaMapping);
          },
          error: function(e) {}
        });
      }



      toolbar.form.submit(function(event) {
        event.preventDefault();
        switch (toolbar.form[0].target) {
          case 'show':
            getDetailMapping();
            break;
          case 'add':
            showDetailMappingModal();
            break;
        }
      });


      LayerModal.form.submit(function(event) {
        event.preventDefault();
        // console.log('asd')
        swal(swalSaveConfigure).then((result) => {
          if (!result.value) {
            return;
          }
          buttonLoading(LayerModal.save_profil_btn);
          $.ajax({
            url: `<?= site_url('KelolahmapelController/saveMapping') ?>`,
            'type': 'POST',
            data: LayerModal.form.serialize(),
            success: function(data) {
              buttonIdle(LayerModal.save_profil_btn);
              var json = JSON.parse(data);
              if (json['error']) {
                swal("Simpan Gagal", json['message'], "error");
                return;
              }
              getAllMapping();

              swal("Simpan Berhasil", "", "success");
              // getInputPengunjung();
            },
            error: function(e) {}
          });
        });
      });

      function getAllMapping() {
        $.ajax({
          url: `<?= site_url('ParameterController/getAllV5Mapping') ?>`,
          'type': 'POST',
          data: {
            id_mapping: id_mapping
          },
          success: function(data) {
            var json = JSON.parse(data);
            dataMapping = json['data'];
            renderMapping(dataMapping);
            getAllV0Mapping();
          },
          error: function(e) {}
        });
      }

      function getAllV0Mapping() {
        $.ajax({
          url: `<?= site_url('ParameterController/getAllV0Mapping') ?>`,
          'type': 'POST',
          data: {
            id_mapping: id_mapping
          },
          success: function(data) {
            var json = JSON.parse(data);
            data = json['data'];
            console.log('ge' + data);
            LayerModal.nama_wali_kelas.val(data['0']['id_wali_kelas'] ?  dataTenagaKerja[data['0']['id_wali_kelas']]['nama'] : '')
            LayerModal.id_wali_kelas.val(data['0']['id_wali_kelas'] ? dataTenagaKerja[data['0']['id_wali_kelas']]['id_user'] : '')
          },
          error: function(e) {}
        });
      }

      function renderMapping(data) {
        console.log(data)
        if (data == null || typeof data != "object") {
          console.log("UNKNOWN DATA");
          return;
        }
        var i = 0;
        var renderData = [];
        LayerModal.id_wali_kelas.val()
        Object.values(data).forEach((d) => {
          console.log(d);
          console.log(dataTenagaKerja)
          stat = 's'
          stat = `<input type="text" placeholder="" class="form-control" id="guru_mapel_${i}" name="guru_mapel_${i}" value='${d['id_tenaga_kerja'] ? ( d['id_tenaga_kerja'] != '0' ? dataTenagaKerja[d['id_tenaga_kerja']]['nama'] : '' ) : ''}'>
               
                <input type="hidden"  id='mapping_kelas_mapel_${i}' name='mapping_kelas_mapel_${i}' value='${d['id_mapel_jurusan']}' >
       
                <input type="hidden" id='id_guru_${i}' name='id_guru_${i}' value='${d['id_tenaga_kerja'] ?  ( d['id_tenaga_kerja'] != '0' ? dataTenagaKerja[d['id_tenaga_kerja']]['id_user'] : '' ) : ''}'>
                <input type="hidden" id='id_mapping_kelas_${i}' name='id_mapping_kelas_${i}' value=${d['id_mapping_kelas'] ? d['id_mapping_kelas'] : 'new' }>`;

          if (d['status_mj'] == '1') {
            btn = `<a class="nonactive active btn btn-success btn-sm" data-id="${d['id_mapel_jurusan']}"><i class='fa fa-angle-double-right'></i></a>`;
          } else if (d['status_mj'] == '2') {
            btn = `<a class="act active btn btn-success btn-sm kpb_rek" data-id="${d['id_mapel_jurusan']}"><i class='fa fa-angle-double-right'></i></a>`;
          } else {
            btn = `<a class="create active btn btn-success btn-sm kpb_rek" data-kelas="${d['kelas']}" data-jurusan="${d['id_jenis_jurusan']}" data-mapel="${d['id_mapel']}"><i class='fa fa-angle-double-right'></i></a>`;
          }
          renderData.push([d['nama_mapel'], stat, btn]);
          i++;
        });
        FDataTable.clear().rows.add(renderData).draw('full-hold');
        typehead(i);
        LayerModal.jumlah_mapel.val(i);
      };

      function renderSiswaMapping(data) {
        console.log(data)
        if (data == null || typeof data != "object") {
          console.log("UNKNOWN DATA");
          return;
        }
        var i = 0;
        var renderData = [];
        // LayerModal.id_wali_kelas.val()
        Object.values(data).forEach((d) => {
          btn = `<a class="delete active btn btn-success btn-sm kpb_rek" data-id_mapping_siswa="${d['id_mapping_siswa']}"><i class='fa fa-trash'></i></a>`;
          renderData.push([dataSiswa[d['id_siswa']]['nama'], dataSiswa[d['id_siswa']]['username'], btn]);
          i++;
        });
        FDataTableSiswa.clear().rows.add(renderData).draw('full-hold');
      };

      FDataTableSiswa.on('click', '.delete', function() {
        var id_mapping_siswa = $(this).data('id_mapping_siswa');
        swal(swalDeleteConfigure).then((result) => {
          if (!result.value) {
            return;
          }
          // buttonLoading(LayerModal.save_profil_btn);
          $.ajax({
            url: `<?= site_url('KelolahmapelController/delete_mapping_siswa') ?>`,
            'type': 'POST',
            data: {
              id_mapping_siswa: id_mapping_siswa
            },
            success: function(data) {
              // buttonIdle(LayerModal.save_profil_btn);
              var json = JSON.parse(data);
              if (json['error']) {
                swal("Hapus Gagal", json['message'], "error");
                return;
              }
              getAllSiswaMapping();
              swal("Berhasil di Hapus", "", "success");
            },
            error: function(e) {}
          });
        });
      });


      function typehead(i) {
        // dataTenagaKerja
        var j;
        for (j = 0; j < i; j++) {
          console.log(dataTenagaKerja)
          $('#guru_mapel_' + j).typeahead('destroy');
          $('#guru_mapel_' + j).typeahead({
            source: Object.values(dataTenagaKerja).map((e) => {
              return `${e['nama']} -- ${e['username']} -- ${e['id_user']} -- ${j}`;
            }),
            afterSelect: function(data) {
              console.log('asd')
              strArrayData = data.split(" -- ")[2];
              strArrayData2 = data.split(" -- ")[3];
              console.log(strArrayData)
              $('#id_guru_' + strArrayData2).val(strArrayData);
            }

          });
        }
      }


      function renderTenagaKerja(i) {
        // dataTenagaKerja
        LayerModal.nama_wali_kelas.typeahead('destroy');
        LayerModal.nama_wali_kelas.typeahead({
          source: Object.values(dataTenagaKerja).map((e) => {
            return `${e['nama']} -- ${e['username']} -- ${e['id_user']}`;
          }),
          afterSelect: function(data) {
            strArrayData = data.split(" -- ")[2];
            LayerModal.id_wali_kelas.val(strArrayData)
          }
        });
        LayerModal.nama_wali_kelas.on('blur', function(e) {});
        getAllSiswa();
      }


      function renderPdf() {
        if (!empty(dataProfil['dokumen'])) {
          tmp = '<?= base_url('/upload/dokumen/') ?>' + dataProfil['dokumen'];
          pdfHTML = `
      <iframe id="iframepdf" src="${tmp}" width = "100%" height = "900px"></iframe>
       `;
          var iframepdf = document.getElementById("iframepdf");

          iframepdf.innerHTML = pdfHTML;
        };
      };

      function getDetailMapping() {
        buttonLoading(toolbar.showBtn);
        // console.log(toolbar.form.serialize());
        $.ajax({
          url: `<?= site_url('DetailMappingController/getAllDetailMapping') ?>`,
          'type': 'GET',
          data: {
            id_mapping: id_mapping
          },
          success: function(data) {
            buttonIdle(toolbar.showBtn);
            var json = JSON.parse(data);
            if (json['error']) {
              swal("Simpan Gagal", json['message'], "error");
              return;
            }
            dataDetailMapping = json['data'];
            renderDetailMapping(dataDetailMapping);
          },
          error: function(e) {}
        });
      }


      function renderDetailMapping(data) {
        if (data == null || typeof data != "object") {
          console.log("User::UNKNOWN DATA");
          return;
        }
        var i = 0;

        var renderData = [];
        Object.values(data).forEach((detailMapping) => {
          renderData.push([detailMapping['nomor'], detailMapping['tahun'], detailMapping['nama_bulan'], detailMapping['domestik'], detailMapping['mancanegara'], detailMapping['jumlah']]);
        });
        FDataTable.clear().rows.add(renderData).draw('full-hold');
      }


      add_siswa.on('click', function() {
        console.log('add siswa')
        SiswaModal.self.modal('show');
        SiswaModal.id_mapping.val(id_mapping);
        SiswaModal.nama_nis.val("");
        SiswaModal.id_siswa.val("");
      })


      // document.getElementById("message_btn").onclick = function() {
      //   MessageFunction()
      // }

      //     function MessageFunction() {
      //       console.log('cok');
      //       MessageModal.nama_operator.val(nama_user_entry.value);
      //       MessageModal.id_operator.val(dataProfil['id_user_entry']);
      //       formatMessage = `Pada Desa Wisata - ` + dataProfil['nama'] + `
      // `;
      //       MessageModal.format_message.val(formatMessage);
      //       MessageModal.self.modal('show');
      //     }

      //     MessageModal.form.submit(function(event) {
      //       event.preventDefault();
      //       switch (MessageModal.form[0].target) {
      //         case 'send':
      //           sendMessage();
      //           break;
      //       }
      //     });

      //     function sendMessage() {
      //       buttonLoading(MessageModal.sendBtn);
      //       console.log(toolbar.form.serialize());
      //       $.ajax({
      //         url: `<?= site_url('MessageController/sendMessage') ?>`,
      //         'type': 'GET',
      //         data: MessageModal.form.serialize(),
      //         success: function(data) {
      //           buttonIdle(MessageModal.sendBtn);
      //           var json = JSON.parse(data);
      //           if (json['error']) {
      //             swal("Simpan Gagal", json['message'], "error");
      //             return;
      //           }
      //           swal("Pesan Terkirim", "", "success");
      //           MessageModal.form.trigger('reset');
      //           MessageModal.self.modal('hide');
      //         },
      //         error: function(e) {}
      //       });
      //     }


    });
  </script>