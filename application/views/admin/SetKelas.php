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

                                    <th style="width: 15%; text-align:center!important">Kelas</th>
                                    <th style="width: 12%; text-align:center!important">Jurusan</th>
                                    <th style="width: 12%; text-align:center!important">Sub Kelas</th>
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


<div class="modal inmodal" id="kelas_modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <input type="hidden" id="id_jenis_kelas" name="id_jenis_kelas">
                            <div class="form-group">
                                <label for="nama_jenis_kelas">Kelas</label>
                                <select class="form-control mr-sm-2" id="nama_jenis_kelas" name="nama_jenis_kelas" required="required">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_jenis_jurusan">Jurusan</label>
                                <select class="form-control mr-sm-2" id="id_jenis_jurusan" name="id_jenis_jurusan" required="required">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_kelas">Sub Kelas</label>
                                <input type="text" placeholder="Nama Mata Pelajaran" class="form-control" id="sub_kelas" name="sub_kelas" required="required">
                            </div>

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
                $('#set_kelas').addClass('active');

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


                var KelasModal = {
                    'self': $('#kelas_modal'),
                    'info': $('#kelas_modal').find('.info'),
                    'form': $('#kelas_modal').find('#user_form'),
                    'addBtn': $('#kelas_modal').find('#add_btn_x'),
                    'saveEditBtn': $('#kelas_modal').find('#save_edit_btn_x'),
                    'id_jenis_kelas': $('#kelas_modal').find('#id_jenis_kelas'),
                    'sub_kelas': $('#kelas_modal').find('#sub_kelas'),
                    'id_jenis_jurusan': $('#kelas_modal').find('#id_jenis_jurusan'),      
                    'nama_jenis_kelas': $('#kelas_modal').find('#nama_jenis_kelas'),
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

                var dataKelas = {};
                var dataJ = {};
                var dataJ2 = {};

                toolbar.form.submit(function(event) {
                    event.preventDefault();
                    switch (toolbar.form[0].target) {
                        case 'show':
                            getKelas();
                            break;
                        case 'add':
                            add_new();
                            // document.getElementById("id_jenis_kelas").value = "";
                            break;
                    }
                });

                function renderKelas(data) {
                    if (data == null || typeof data != "object") {
                        console.log("User::UNKNOWN DATA");
                        return;
                    }
                    var i = 0;

                    var renderData = [];
                    Object.values(data).forEach((kelas) => {
                        var editButton = `
        <a class="edit dropdown-item" data-id='${kelas['id_jenis_kelas']}'><i class='fa fa-pencil'></i> Edit Mata Pelajaran</a>
      `;
                        var deleteButton = `
        <a class="delete dropdown-item" data-id='${kelas['id_jenis_kelas']}'><i class='fa fa-trash'></i> Hapus Mata Pelajaran</a>
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
                        renderData.push([kelas['nama_jenis_kelas'], kelas['nama_jenis_jurusan'], kelas['sub_kelas'], button]);
                    });
                    FDataTable.clear().rows.add(renderData).draw('full-hold');
                }

                function add_new() {
                    event.preventDefault();
                    KelasModal.form.trigger('reset');
                    KelasModal.self.modal('show');
                    KelasModal.addBtn.show();
                    KelasModal.saveEditBtn.hide();
                };

                FDataTable.on('click', '.edit', function() {
                    event.preventDefault();
                    KelasModal.form.trigger('reset');
                    KelasModal.self.modal('show');
                    KelasModal.addBtn.hide();
                    KelasModal.saveEditBtn.show();
                    var id = $(this).data('id');
                    var kelas = dataKelas[id];
                    // console.log(kelas);

                    KelasModal.id_jenis_kelas.val(kelas['id_jenis_kelas']);
                    KelasModal.nama_jenis_kelas.val(kelas['nama_jenis_kelas']);
                    KelasModal.id_jenis_jurusan.val(kelas['id_jenis_jurusan']);

                    KelasModal.sub_kelas.val(kelas['sub_kelas']);
                });

                FDataTable.on('click', '.delete', function() {
                    event.preventDefault();
                    var id = $(this).data('id');
                    swal(swalDeleteConfigure).then((result) => {
                        if (!result.value) {
                            return;
                        }
                        $.ajax({
                            url: "<?= site_url('ParameterController/deleteKelas') ?>",
                            'type': 'POST',
                            data: {
                                'id_jenis_kelas': id
                            },
                            success: function(data) {
                                var json = JSON.parse(data);
                                if (json['error']) {
                                    swal("Delete Gagal", json['message'], "error");
                                    return;
                                }
                                delete dataKelas[id];
                                swal("Delete Berhasil", "", "success");
                                renderKelas(dataKelas);
                            },
                            error: function(e) {}
                        });
                    });
                });

                function showKelasModal() {
                    KelasModal.self.modal('show');
                    KelasModal.addBtn.show();
                    KelasModal.saveEditBtn.hide();
                    KelasModal.form.trigger('reset');
                }

                KelasModal.form.submit(function(event) {
                    event.preventDefault();
                    switch (KelasModal.form[0].target) {
                        case 'add':
                            addKelas();
                            break;
                        case 'edit':
                            editKelas();
                            break;
                    }
                });

                function addKelas() {
                    swal(swalSaveConfigure).then((result) => {
                        if (!result.value) {
                            return;
                        }
                        buttonLoading(KelasModal.addBtn);
                        $.ajax({
                            url: `<?= site_url('ParameterController/addKelas') ?>`,
                            'type': 'POST',
                            data: KelasModal.form.serialize(),
                            success: function(data) {
                                buttonIdle(KelasModal.addBtn);
                                var json = JSON.parse(data);
                                if (json['error']) {
                                    swal("Simpan Gagal", json['message'], "error");
                                    return;
                                }
                                var kelas = json['data']
                                dataKelas[kelas['id_jenis_kelas']] = kelas;
                                swal("Simpan Berhasil", "", "success");
                                renderKelas(dataKelas);
                                KelasModal.saveEditBtn.show();
                                KelasModal.self.modal('hide');
                            },
                            error: function(e) {}
                        });
                    });
                }


                function editKelas() {
                    swal(swalSaveConfigure).then((result) => {
                        if (!result.value) {
                            return;
                        }
                        buttonLoading(KelasModal.saveEditBtn);
                        $.ajax({
                            url: `<?= site_url('ParameterController/editKelas') ?>`,
                            'type': 'POST',
                            data: KelasModal.form.serialize(),
                            success: function(data) {
                                buttonIdle(KelasModal.saveEditBtn);
                                var json = JSON.parse(data);
                                if (json['error']) {
                                    swal("Simpan Gagal", json['message'], "error");
                                    return;
                                }
                                var kelas = json['data']
                                dataKelas[kelas['id_jenis_kelas']] = kelas;
                                swal("Simpan Berhasil", "", "success");
                                renderKelas(dataKelas);
                                KelasModal.self.modal('hide');
                            },
                            error: function(e) {}
                        });
                    });
                }
                getJurusan();

                function getJurusan() {
                    return $.ajax({
                        url: `<?php echo site_url('ParameterController/getAllJurusan/') ?>`,
                        'type': 'GET',
                        data: {},
                        success: function(data) {
                            var json = JSON.parse(data);

                            dataJurusan = json['data'];
                            renderJenisJurusan(dataJurusan);
                        },
                        error: function(e) {}
                    });
                }

                

                function renderJenisJurusan(data) {
                    
                    
                    KelasModal.id_jenis_jurusan.empty();
                    KelasModal.id_jenis_jurusan.append($('<option>', {
                        value: "",
                        text: "-- Pilih Kelas --"
                    }));
                    Object.values(data).forEach((d) => {
                        KelasModal.id_jenis_jurusan.append($('<option>', {
                        value: d['id_jenis_jurusan'],
                        text: d['nama_jenis_jurusan']
                    }));
                   
                    });

                    KelasModal.nama_jenis_kelas.empty();
                    KelasModal.nama_jenis_kelas.append($('<option>', {
                        value: "",
                        text: "-- Pilih Status --"
                    }));
                    KelasModal.nama_jenis_kelas.append($('<option>', {
                        value: '10',
                        text: ' 10 ',
                    }));
                    KelasModal.nama_jenis_kelas.append($('<option>', {
                        value: '11',
                        text: ' 11 ',
                    }));
                    
                    KelasModal.nama_jenis_kelas.append($('<option>', {
                        value: '12',
                        text: ' 12 ',
                    }));
                }

                function getKelas() {
                    buttonLoading(toolbar.showBtn);
                    $.ajax({
                        url: `<?= site_url('ParameterController/getAllKelas') ?>`,
                        'type': 'GET',
                        data: {},
                        success: function(data) {
                            buttonIdle(toolbar.showBtn);
                            var json = JSON.parse(data);
                            if (json['error']) {
                                swal("Simpan Gagal", json['message'], "error");
                                return;
                            }
                            dataKelas = json['data'];
                            renderKelas(dataKelas);
                        },
                        error: function(e) {}
                    });
                }
            });
        </script>