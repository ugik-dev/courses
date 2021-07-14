<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox ssection-container">
        <div class="ibox-content">
            <form class="form-inline" id="toolbar_form" onsubmit="return false;">

                <select class="form-control mr-sm-2" name="id_tahun_ajaran" id="id_tahun_ajaran"></select>
                <select class="form-control mr-sm-2" name="id_jenis_jurusan" id="id_jenis_jurusan"></select>
                <select class="form-control mr-sm-2" name="id_kelas" id="id_kelas"></select>
               
                <!-- <button type="submit" class="btn btn-success my-1 mr-sm-2" id="show_btn" data-loading-text="Loading..." onclick="this.form.target='show'"><i class="fal fa-eye"></i> Tampilkan</button> -->
                <!-- <button type="submit" class="btn btn-primary my-1 mr-sm-2" id="add_btn" data-loading-text="Loading..." onclick="this.form.target='add'"><i class="fal fa-plus"></i> Tambah</button> -->
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
                                    <th style="width: 12%; text-align:center!important">Tahun Ajaran</th>
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


<div class="modal inmodal" id="mapel_modal" tabindex="-1" role="dialog" aria-hidden="true">
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

        $('#mapping').addClass('active');


        var toolbar = {
            'form': $('#toolbar_form'),
            'showBtn': $('#show_btn'),
            'id_tahun_ajaran': $('#id_tahun_ajaran'),
            'id_jenis_jurusan': $('#id_jenis_jurusan'),
            'id_kelas': $('#id_kelas'),
            // 'addBtn': $('#show_btn'),
        }

        var FDataTable = $('#FDataTable').DataTable({
            'columnDefs': [],
            deferRender: true,
            "order": [
                [0, "desc"]
            ]
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

        function confirmPasswordRule(password, rePassword) {
            if (password.val() != rePassword.val()) {
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

        var swalActiveConfigure = {
            title: "Konfirmasi Aktifasi Kelas",
            text: "Yakin akan mengaktifkan kelas ini?",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#18a689",
            confirmButtonText: "Ya, Aktifkan!",
        };

        var swalNonActiveConfigure = {
            title: "Konfirmasi Non Aktifasi Kelas",
            text: "Yakin akan menonaktifkan kelas ini?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Non Aktifkan!",
        };

        var dataMapping = {};
        var dataRole = {};

        function status(status) {
            if (status == '1')
                return `<i class='fa fa-edit text-success'> Aktif</i>`;
            else
                return `<i class='fa fa-file text-danger'> Tidak Aktif</i>`;
        }


        toolbar.form.submit(function(event) {
            event.preventDefault();
            switch (toolbar.form[0].target) {
                case 'show':
                    getKelolahmapel();
                    break;
                case 'add':
                    showKelolahmapelModal();
                    break;
            }
        });

        toolbar.id_tahun_ajaran.on('change', function() {
            getAllMapping();
        });
        toolbar.id_jenis_jurusan.on('change', function() {
            getAllMapping();
        });
        toolbar.id_kelas.on('change', function() {
            getAllMapping();
        });

        getAllTahunPelajaran();

        function getAllTahunPelajaran() {
            return $.ajax({
                url: `<?php echo site_url('ParameterController/getAllTahunAjaran/') ?>`,
                'type': 'GET',
                data: {},
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dataTA = json['data'];
                    renderTA(dataTA);
                },
                error: function(e) {}
            });
        }

        // getAllMapping();

        function getAllMapping() {
            return $.ajax({
                url: `<?php echo site_url('ParameterController/getAllMapping/') ?>`,
                'type': 'POST',
                data: toolbar.form.serialize(),
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dataMapping = json['data'];
                    renderMapping(dataMapping);
                },
                error: function(e) {}
            });
        }

        function renderTA(data) {
            // toolbar.id_tahun_ajaran
            toolbar.id_tahun_ajaran.empty();
            toolbar.id_tahun_ajaran.append($('<option>', {
                value: "",
                text: "-- Pilih Tahun Ajaran --"
            }));
            Object.values(data).forEach((d) => {
                toolbar.id_tahun_ajaran.append($('<option>', {
                    value: d['id_tahun_ajaran'],
                    text: d['deskripsi'] + ' :: Semester ' + d['semester'],
                    selected: d['current'] == '2' ? true : false,
                }));
            });

            // toolbar.id_jenis_jurusan
            toolbar.id_jenis_jurusan.empty();
            toolbar.id_jenis_jurusan.append($('<option>', {
                value: "",
                text: "-- Pilih Jurusan --"
            }));
            toolbar.id_jenis_jurusan.append($('<option>', {
                value: '1',
                text: 'MIPA',
            }));
            toolbar.id_jenis_jurusan.append($('<option>', {
                value: '2',
                text: 'IPS',
            }));

            toolbar.id_kelas
            toolbar.id_kelas.empty();
            toolbar.id_kelas.append($('<option>', {
                value: "",
                text: "-- Pilih id_kelas --"
            }));
            toolbar.id_kelas.append($('<option>', {
                value: '10',
                text: '10',
            }));
            toolbar.id_kelas.append($('<option>', {
                value: '11',
                text: '11',
            }));
            toolbar.id_kelas.append($('<option>', {
                value: '12',
                text: '12',
            }));

            getAllMapping();
        }


        function renderRoleSelection(data) {
            KelolahmapelModal.id_role.empty();
            KelolahmapelModal.id_role.append($('<option>', {
                value: "",
                text: "-- Pilih Role --"
            }));
            Object.values(data).forEach((d) => {
                KelolahmapelModal.id_role.append($('<option>', {
                    value: d['id_role'],
                    text: d['id_role'] + ' :: ' + d['title_role'],
                }));
            });
        }


        function renderMapping(data) {
            if (data == null || typeof data != "object") {
                console.log("Mapel::UNKNOWN DATA");
                return;
            }

            var i = 0;

            var renderData = [];
            Object.values(data).forEach((mapel) => {

                if (mapel['status_mapping'] == '1') {
                    button = `<a class="detail active btn btn-success btn-sm" href='<?= site_url() ?>AdminController/DetailMapping?id_mapping=${mapel['id_mapping']}'><i class='fa fa-angle-double-right'> Detail </i></a> 
                    <a class="nonact active btn btn-success btn-sm kpb_rek" data-id_mapping="${mapel['id_mapping']}"><i class='fa fa-angle-double-right'> NonActive </i></a>`;
            
                } else if (mapel['status_mapping'] == '2') {
                    button = `<a class="act active btn btn-success btn-sm kpb_rek" data-id_mapping="${mapel['id_mapping']}"><i class='fa fa-angle-double-right'> Active </i></a>`;
                } else {
                    button = `<a class="create active btn btn-success btn-sm kpb_rek" data-ta="${mapel['id_tahun_ajaran']}" data-jenis_kelas="${mapel['id_jenis_kelas']}" ><i class='fa fa-angle-double-right'> Active </i></a>`;
                }

                renderData.push([mapel['nama_jenis_kelas'] + ' ' + mapel['nama_jenis_jurusan'] + ' ' + mapel['sub_kelas'], mapel['deskripsi'] + ' :: Semester ' + mapel['semester'], status(mapel['status_mapping']), button]);
            });
            FDataTable.clear().rows.add(renderData).draw('full-hold');
        }

        FDataTable.on('click', '.create', function() {
            console.log('create');
            var ta = $(this).data('ta');
            var jenis_kelas = $(this).data('jenis_kelas');

            swal(swalActiveConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                // buttonLoading(KelolahmapelModal.saveEditBtn);
                $.ajax({
                    url: `<?= site_url('KelolahmapelController/create_kelas') ?>`,
                    'type': 'POST',
                    data: { id_tahun_ajaran : ta, 
                        id_jenis_kelas : jenis_kelas },
                    success: function(data) {
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swal("Simpan Gagal", json['message'], "error");
                            return;
                        }
                        getAllMapping()
                    },
                    error: function(e) {}
                });
            });
        });

        FDataTable.on('click', '.nonact', function() {
            console.log('reset');
            var id_mapping = $(this).data('id_mapping');
            swal(swalNonActiveConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                // buttonLoading(KelolahmapelModal.saveEditBtn);
                $.ajax({
                    url: `<?= site_url('KelolahmapelController/nonactive_kelas') ?>`,
                    'type': 'POST',
                    data: { id_mapping : id_mapping, 
                       },
                    success: function(data) {
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swal("Simpan Gagal", json['message'], "error");
                            return;
                        }
                        getAllMapping()
                    },
                    error: function(e) {}
                });
            });
        });

        FDataTable.on('click', '.act', function() {
            console.log('reset');
            var id_mapping = $(this).data('id_mapping');
            swal(swalActiveConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                // buttonLoading(KelolahmapelModal.saveEditBtn);
                $.ajax({
                    url: `<?= site_url('KelolahmapelController/active_kelas') ?>`,
                    'type': 'POST',
                    data: { id_mapping : id_mapping, 
                       },
                    success: function(data) {
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swal("Simpan Gagal", json['message'], "error");
                            return;
                        }
                        getAllMapping()
                    },
                    error: function(e) {}
                });
            });
        });



        KelolahmapelModal.id_role.on('change', () => {
            if (KelolahmapelModal.id_role.val() == '1') {
                KelolahmapelModal.kabupaten.prop('disabled', true);
            } else {
                KelolahmapelModal.kabupaten.prop('disabled', false);
            }
        });

        FDataTable.on('click', '.delete', function() {
            event.preventDefault();
            var id = $(this).data('id');
            swal(swalDeleteConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                $.ajax({
                    url: "<?= site_url('KelolahmapelController/deleteKelolahmapel') ?>",
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
                        delete dataMapping[id];
                        swal("Delete Berhasil", "", "success");
                        renderMapping(dataMapping);
                    },
                    error: function(e) {}
                });
            });
        });

        function showKelolahmapelModal() {
            KelolahmapelModal.self.modal('show');
            KelolahmapelModal.addBtn.show();
            KelolahmapelModal.saveEditBtn.hide();
            KelolahmapelModal.form.trigger('reset');
            KelolahmapelModal.password.prop('disabled', false);
            KelolahmapelModal.repassword.prop('disabled', false);
        }

        ResetModal.form.submit(function(event) {
            event.preventDefault();
            switch (ResetModal.form[0].target) {
                case 'edit':
                    editPassword();
                    break;
            }
        });

        KelolahmapelModal.form.submit(function(event) {
            event.preventDefault();
            switch (KelolahmapelModal.form[0].target) {
                case 'add':
                    addKelolahmapel();
                    break;
                case 'edit':
                    editKelolahmapel();
                    break;
            }
        });

        function addKelolahmapel() {
            swal(swalSaveConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                buttonLoading(KelolahmapelModal.addBtn);
                $.ajax({
                    url: `<?= site_url('KelolahmapelController/addMapel') ?>`,
                    'type': 'POST',
                    data: KelolahmapelModal.form.serialize(),
                    success: function(data) {
                        buttonIdle(KelolahmapelModal.addBtn);
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swal("Simpan Gagal", json['message'], "error");
                            return;
                        }
                        var mapel = json['data']
                        dataMapping[mapel['id_mapel']] = mapel;
                        swal("Simpan Berhasil", "", "success");
                        renderMapping(dataMapping);
                        KelolahmapelModal.self.modal('hide');
                    },
                    error: function(e) {}
                });
            });
        }

        function editKelolahmapel() {
            swal(swalSaveConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                buttonLoading(KelolahmapelModal.saveEditBtn);
                $.ajax({
                    url: `<?= site_url('KelolahmapelController/editKelolahmapel') ?>`,
                    'type': 'POST',
                    data: KelolahmapelModal.form.serialize(),
                    success: function(data) {
                        buttonIdle(KelolahmapelModal.saveEditBtn);
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swal("Simpan Gagal", json['message'], "error");
                            return;
                        }
                        var mapel = json['data']
                        dataMapping[mapel['id_mapel']] = mapel;
                        swal("Simpan Berhasil", "", "success");
                        renderMapping(dataMapping);
                        KelolahmapelModal.self.modal('hide');
                    },
                    error: function(e) {}
                });
            });
        }

        function editPassword() {
            swal(swalSaveConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                buttonLoading(ResetModal.saveEditBtn);
                $.ajax({
                    url: `<?= site_url('KelolahmapelController/editPassword') ?>`,
                    'type': 'POST',
                    data: ResetModal.form.serialize(),
                    success: function(data) {
                        buttonIdle(ResetModal.saveEditBtn);
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swal("Simpan Gagal", json['message'], "error");
                            return;
                        }
                        var mapel = json['data']
                        dataMapping[mapel['id_mapel']] = mapel;
                        swal("Simpan Berhasil", "", "success");
                        renderMapping(dataMapping);
                        ResetModal.self.modal('hide');
                    },
                    error: function(e) {}
                });
            });
        }
    });
</script>