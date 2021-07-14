<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="toolbar_form" onsubmit="return false;">

        <button type="submit" class="btn btn-success my-1 mr-sm-2" id="show_btn" data-loading-text="Loading..." onclick="this.form.target='show'"><i class="fal fa-eye"></i> Tampilkan</button>
        <button type="submit" class="btn btn-primary my-1 mr-sm-2" id="add_btn" data-loading-text="Loading..." onclick="this.form.target='add'"><i class="fal fa-plus"></i> Tambah</button>
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
                  <!-- <th style="width: 12%; text-align:center!important">Status</th> -->
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


<div class="modal inmodal" id="mapel_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Kelola Mata Pelajaran Kerja</h4>
        <span class="info"></span>
      </div>
      <div class="modal-body" id="modal-body">
        <div class="ibox ssection-container">
          <div class="ibox-content">

            <form role="form" id="user_form" onsubmit="return false;" type="multipart" autocomplete="off">
              <input type="hidden" id="id_mapel" name="id_mapel">
              <div class="form-group">
                <label for="nama_mapel">Nama</label>
                <input type="text" placeholder="Nama Mata Pelajaran" class="form-control" id="nama_mapel" name="nama_mapel" required="required">
              </div>
              <!-- <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control mr-sm-2" id="status" name="status" required="required">
              </select>
            </div> -->

              <button class="btn btn-success my-1 mr-sm-2" type="submit" id="add_btn_x" data-loading-text="Loading..." onclick="this.form.target='add'"><strong>Tambah Data</strong></button>
              <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_edit_btn_x" data-loading-text="Loading..." onclick="this.form.target='edit'"><strong>Simpan Perubahan</strong></button>
            </form>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
      </div>
    </div>

    <script>
      $(document).ready(function() {

        $('#setting').addClass('active');
        $('#set_mapel').addClass('active');

        // <?php if ($this->session->userdata('id_role') == '3') { ?>
        //   $('#add_btn').hide();
        // <?php }  ?>

        var toolbar = {
          'form': $('#toolbar_form'),
          'showBtn': $('#show_btn'),
          'addBtn': $('#show_btn'),
        }

        var FDataTable = $('#FDataTable').DataTable({
          'columnDefs': [],
          deferRender: true,
          "order": [
            [0, "desc"]
          ]
        });


        var MapelModal = {
          'self': $('#mapel_modal'),
          'info': $('#mapel_modal').find('.info'),
          'form': $('#mapel_modal').find('#user_form'),
          'addBtn': $('#mapel_modal').find('#add_btn_x'),
          'saveEditBtn': $('#mapel_modal').find('#save_edit_btn_x'),
          'id_mapel': $('#mapel_modal').find('#id_mapel'),
          'nama_mapel': $('#mapel_modal').find('#nama_mapel'),
          'status': $('#mapel_modal').find('#status'),
        }

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

        var dataMapel = {};
        var dataJ = {};
        var dataJ2 = {};

        toolbar.form.submit(function(event) {
          event.preventDefault();
          switch (toolbar.form[0].target) {
            case 'show':
              getMapel();
              break;
            case 'add':
              add_new();
              // document.getElementById("id_mapel").value = "";
              break;
          }
        });

        function renderMapel(data) {
          if (data == null || typeof data != "object") {
            console.log("User::UNKNOWN DATA");
            return;
          }
          var i = 0;

          var renderData = [];
          Object.values(data).forEach((mapel) => {
            var editButton = `
        <a class="edit dropdown-item" data-id='${mapel['id_mapel']}'><i class='fa fa-pencil'></i> Edit Mata Pelajaran</a>
      `;
            var deleteButton = `
        <a class="delete dropdown-item" data-id='${mapel['id_mapel']}'><i class='fa fa-trash'></i> Hapus Mata Pelajaran</a>
      `;
            var button = `
        <div class="btn-group" role="group">
          <button id="action" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${editButton}
            ${deleteButton}
          </div>
        </div>
      `;
            renderData.push([mapel['nama_mapel'], button]);
          });
          FDataTable.clear().rows.add(renderData).draw('full-hold');
        }

        function add_new() {
          event.preventDefault();
          MapelModal.form.trigger('reset');
          MapelModal.self.modal('show');
          MapelModal.addBtn.show();
          MapelModal.saveEditBtn.hide();
        };

        FDataTable.on('click', '.edit', function() {
          event.preventDefault();
          MapelModal.form.trigger('reset');
          MapelModal.self.modal('show');
          MapelModal.addBtn.hide();
          MapelModal.saveEditBtn.show();
          var id = $(this).data('id');
          var mapel = dataMapel[id];
          // console.log(mapel);

          MapelModal.id_mapel.val(mapel['id_mapel']);
          // MapelModal.status.val(mapel['status']);

          MapelModal.nama_mapel.val(mapel['nama_mapel']);
        });

        FDataTable.on('click', '.delete', function() {
          event.preventDefault();
          var id = $(this).data('id');
          swal(swalDeleteConfigure).then((result) => {
            if (!result.value) {
              return;
            }
            $.ajax({
              url: "<?= site_url('ParameterController/deleteMapel') ?>",
              'type': 'POST',
              data: {
                'id_mapel': id
              },
              success: function(data) {
                var json = JSON.parse(data);
                if (json['error']) {
                  swal("Delete Gagal", json['message'], "error");
                  return;
                }
                delete dataMapel[id];
                swal("Delete Berhasil", "", "success");
                renderMapel(dataMapel);
              },
              error: function(e) {}
            });
          });
        });

        function showMapelModal() {
          MapelModal.self.modal('show');
          MapelModal.addBtn.show();
          MapelModal.saveEditBtn.hide();
          MapelModal.form.trigger('reset');
        }

        MapelModal.form.submit(function(event) {
          event.preventDefault();
          switch (MapelModal.form[0].target) {
            case 'add':
              addMapel();
              break;
            case 'edit':
              editMapel();
              break;
          }
        });

        function addMapel() {
          swal(swalSaveConfigure).then((result) => {
            if (!result.value) {
              return;
            }
            buttonLoading(MapelModal.addBtn);
            $.ajax({
              url: `<?= site_url('ParameterController/addMapel') ?>`,
              'type': 'POST',
              data: MapelModal.form.serialize(),
              success: function(data) {
                buttonIdle(MapelModal.addBtn);
                var json = JSON.parse(data);
                if (json['error']) {
                  swal("Simpan Gagal", json['message'], "error");
                  return;
                }
                var mapel = json['data']
                dataMapel[mapel['id_mapel']] = mapel;
                swal("Simpan Berhasil", "", "success");
                renderMapel(dataMapel);
                MapelModal.saveEditBtn.show();
                MapelModal.self.modal('hide');
              },
              error: function(e) {}
            });
          });
        }


        function editMapel() {
          swal(swalSaveConfigure).then((result) => {
            if (!result.value) {
              return;
            }
            buttonLoading(MapelModal.saveEditBtn);
            $.ajax({
              url: `<?= site_url('ParameterController/editMapel') ?>`,
              'type': 'POST',
              data: MapelModal.form.serialize(),
              success: function(data) {
                buttonIdle(MapelModal.saveEditBtn);
                var json = JSON.parse(data);
                if (json['error']) {
                  swal("Simpan Gagal", json['message'], "error");
                  return;
                }
                var mapel = json['data']
                dataMapel[mapel['id_mapel']] = mapel;
                swal("Simpan Berhasil", "", "success");
                renderMapel(dataMapel);
                MapelModal.self.modal('hide');
              },
              error: function(e) {}
            });
          });
        }
        renderPendidikanSelection();

        function renderPendidikanSelection() {
          MapelModal.status.empty();
          MapelModal.status.append($('<option>', {
            value: "",
            text: "-- Pilih Status --"
          }));
          MapelModal.status.append($('<option>', {
            value: '1',
            text: ' Aktif ',
          }));
          MapelModal.status.append($('<option>', {
            value: '2',
            text: ' Tidak Aktif ',
          }));
        }

        function getMapel() {
          buttonLoading(toolbar.showBtn);
          $.ajax({
            url: `<?= site_url('ParameterController/getAllMapel') ?>`,
            'type': 'GET',
            data: {},
            success: function(data) {
              buttonIdle(toolbar.showBtn);
              var json = JSON.parse(data);
              if (json['error']) {
                swal("Simpan Gagal", json['message'], "error");
                return;
              }
              dataMapel = json['data'];
              renderMapel(dataMapel);
            },
            error: function(e) {}
          });
        }
      });
    </script>