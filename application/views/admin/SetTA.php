<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox ssection-container">
        <div class="ibox-content">
            <form class="form-inline" id="toolbar_form" onsubmit="return false;">

                <button type="submit" class="btn btn-success my-1 mr-sm-2" id="show_btn" data-loading-text="Loading..." onclick="this.form.target='show'"><i class="fal fa-eye"></i> Tampilkan</button>
                <button type="submit" class="btn btn-primary my-1 mr-sm-2" id="add_btn" data-loading-text="Loading..." onclick="this.form.target='add'"><i class="fal fa-plus"></i> Tambah</button>
            </form>
        </div>
        <!-- </div> -->

        <!-- <div class="ibox ssection-container"> -->
        <div class="ibox-content">
            <form class="form-inline" id="current_form" onsubmit="return false;">
                <select class="form-control mr-sm-2" name="id_tahun_ajaran" id="id_tahun_ajaran_cur"></select>

                <button type="submit" class="btn btn-success my-1 mr-sm-2" id="set_current" data-loading-text="Loading..."><i class="fal fa-cogs"></i> Set To Curret Tahun Ajaran</button>
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

                                    <th style="width: 5%; text-align:center!important">TA</th>
                                    <th style="width: 5%; text-align:center!important">Semester</th>
                                    <th style="width: 12%; text-align:center!important">Rentan Waktu</th>
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


<div class="modal inmodal" id="ta_modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <input type="hidden" id="id_tahun_ajaran" name="id_tahun_ajaran">
                            <div class="form-group">
                                <label for="deskripsi">Label Tahun</label>
                                <input type="text" placeholder="Label Tahun" class="form-control" id="deskripsi" name="deskripsi" required="required">
                            </div>
                            <div class="form-group">
                                <label for="start">Tanggal Mulai</label>
                                <input type="date" class="form-control mr-sm-2" id="start" name="start" required="required">
                            </div>
                            <div class="form-group">
                                <label for="end">Tanggal Berakhir</label>
                                <input type="date" class="form-control mr-sm-2" id="end" name="end" required="required">
                            </div>

                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <input type="number" class="form-control mr-sm-2" max="2" min="1" id="semester" name="semester" required="required">
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
                $('#set_ta').addClass('active');

                // <?php if ($this->session->userdata('id_role') == '3') { ?>
                //   $('#add_btn').hide();
                // <?php }  ?>

                var toolbar = {
                    'form': $('#toolbar_form'),
                    'showBtn': $('#show_btn'),
                    'addBtn': $('#show_btn'),
                }

                var current = {
                    'form': $('#current_form'),
                    'set_current': $('#set_current'),
                    'id_tahun_ajaran': $('#id_tahun_ajaran_cur'),

                }

                current.form.on('submit', function() {
                    swal(swalCurrentConfigure).then((result) => {
                        if (!result.value) {
                            return;
                        }
                        buttonLoading(current.set_current);
                        $.ajax({
                            url: `<?= site_url('ParameterController/set_current_ta') ?>`,
                            'type': 'POST',
                            data: current.form.serialize(),
                            success: function(data) {
                                buttonIdle(current.set_current);
                                var json = JSON.parse(data);
                                if (json['error']) {
                                    swal("Set Tahun Ajaran Gagal", json['message'], "error");
                                    return;
                                }
                                // var kelas = json['data']
                                // dataTA[kelas['id_tahun_ajaran']] = kelas;
                                swal("Set Tahun Ajaran Berhasil", "", "success");
                                // renderTA(dataTA);
                                // TAModal.saveEditBtn.show();
                                // TAModal.self.modal('hide');
                            },
                            error: function(e) {}
                        });
                    });
                });

                var FDataTable = $('#FDataTable').DataTable({
                    'columnDefs': [],
                    deferRender: true,
                    "order": [
                        [0, "desc"]
                    ]
                });


                var TAModal = {
                    'self': $('#ta_modal'),
                    'info': $('#ta_modal').find('.info'),
                    'form': $('#ta_modal').find('#user_form'),
                    'addBtn': $('#ta_modal').find('#add_btn_x'),
                    'saveEditBtn': $('#ta_modal').find('#save_edit_btn_x'),
                    'id_tahun_ajaran': $('#ta_modal').find('#id_tahun_ajaran'),
                    'deskripsi': $('#ta_modal').find('#deskripsi'),
                    'semester': $('#ta_modal').find('#semester'),
                    'start': $('#ta_modal').find('#start'),
                    'end': $('#ta_modal').find('#end'),
                 }

                var swalSaveConfigure = {
                    title: "Konfirmasi simpan",
                    text: "Yakin akan menyimpan data ini?",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#18a689",
                    confirmButtonText: "Ya, Simpan!",
                };

                var swalCurrentConfigure = {
                    title: "Konfirmasi Set",
                    text: "Tahun ajaran ini akan di atur sebagai tahun ajaran sekarang?",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#18a689",
                    confirmButtonText: "Ya!",
                };

                var swalDeleteConfigure = {
                    title: "Konfirmasi hapus",
                    text: "Yakin akan menghapus data ini?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Hapus!",
                };

                var dataTA = {};
                var dataJ = {};
                var dataJ2 = {};

                toolbar.form.submit(function(event) {
                    event.preventDefault();
                    switch (toolbar.form[0].target) {
                        case 'show':
                            getTA();
                            break;
                        case 'add':
                            add_new();
                            // document.getElementById("id_tahun_ajaran").value = "";
                            break;
                    }
                });

                getTA();

                function renderTA(data) {
                    if (data == null || typeof data != "object") {
                        console.log("User::UNKNOWN DATA");
                        return;
                    }
                    var i = 0;

                    var renderData = [];
                    Object.values(data).forEach((kelas) => {
                        var editButton = `
                            <a class="edit dropdown-item" data-id='${kelas['id_tahun_ajaran']}'><i class='fa fa-pencil'></i> Edit Mata Pelajaran</a>
                            `;
                        var deleteButton = `
                            <a class="delete dropdown-item" data-id='${kelas['id_tahun_ajaran']}'><i class='fa fa-trash'></i> Hapus Mata Pelajaran</a>
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
                        renderData.push([kelas['deskripsi'], kelas['semester'], kelas['start'] + ' :: ' + kelas['end'], button]);
                    });
                    FDataTable.clear().rows.add(renderData).draw('full-hold');

                    renderTACurrent(data);
                }

                function renderTACurrent(data) {
                    // toolbar.id_tahun_ajaran
                    current.id_tahun_ajaran.empty();
                    current.id_tahun_ajaran.append($('<option>', {
                        value: "",
                        text: "-- Pilih Tahun Ajaran --"
                    }));
                    Object.values(data).forEach((d) => {
                        current.id_tahun_ajaran.append($('<option>', {
                            value: d['id_tahun_ajaran'],
                            text: d['deskripsi'] + ' :: Semester ' + d['semester'],
                            selected: d['current'] == '2' ? true : false,
                        }));
                    });
                }

                function add_new() {
                    event.preventDefault();
                    TAModal.form.trigger('reset');
                    TAModal.self.modal('show');
                    TAModal.addBtn.show();
                    TAModal.saveEditBtn.hide();
                };

                FDataTable.on('click', '.edit', function() {
                    event.preventDefault();
                    TAModal.form.trigger('reset');
                    TAModal.self.modal('show');
                    TAModal.addBtn.hide();
                    TAModal.saveEditBtn.show();
                    var id = $(this).data('id');
                    var kelas = dataTA[id];
                    // console.log(kelas);

                    TAModal.id_tahun_ajaran.val(kelas['id_tahun_ajaran']);
                    TAModal.start.val(kelas['start']);
                    TAModal.end.val(kelas['end']);
                    TAModal.semester.val(kelas['semester']);

                    TAModal.deskripsi.val(kelas['deskripsi']);
                });

                FDataTable.on('click', '.delete', function() {
                    event.preventDefault();
                    var id = $(this).data('id');
                    swal(swalDeleteConfigure).then((result) => {
                        if (!result.value) {
                            return;
                        }
                        $.ajax({
                            url: "<?= site_url('ParameterController/deleteTA') ?>",
                            'type': 'POST',
                            data: {
                                'id_tahun_ajaran': id
                            },
                            success: function(data) {
                                var json = JSON.parse(data);
                                if (json['error']) {
                                    swal("Delete Gagal", json['message'], "error");
                                    return;
                                }
                                delete dataTA[id];
                                swal("Delete Berhasil", "", "success");
                                renderTA(dataTA);
                            },
                            error: function(e) {}
                        });
                    });
                });

                function showTAModal() {
                    TAModal.self.modal('show');
                    TAModal.addBtn.show();
                    TAModal.saveEditBtn.hide();
                    TAModal.form.trigger('reset');
                }

                TAModal.form.submit(function(event) {
                    event.preventDefault();
                    switch (TAModal.form[0].target) {
                        case 'add':
                            addTA();
                            break;
                        case 'edit':
                            editTA();
                            break;
                    }
                });

                function addTA() {
                    swal(swalSaveConfigure).then((result) => {
                        if (!result.value) {
                            return;
                        }
                        buttonLoading(TAModal.addBtn);
                        $.ajax({
                            url: `<?= site_url('ParameterController/addTA') ?>`,
                            'type': 'POST',
                            data: TAModal.form.serialize(),
                            success: function(data) {
                                buttonIdle(TAModal.addBtn);
                                var json = JSON.parse(data);
                                if (json['error']) {
                                    swal("Simpan Gagal", json['message'], "error");
                                    return;
                                }
                                var kelas = json['data']
                                dataTA[kelas['id_tahun_ajaran']] = kelas;
                                swal("Simpan Berhasil", "", "success");
                                renderTA(dataTA);
                                TAModal.saveEditBtn.show();
                                TAModal.self.modal('hide');
                            },
                            error: function(e) {}
                        });
                    });
                }


                function editTA() {
                    swal(swalSaveConfigure).then((result) => {
                        if (!result.value) {
                            return;
                        }
                        buttonLoading(TAModal.saveEditBtn);
                        $.ajax({
                            url: `<?= site_url('ParameterController/editTA') ?>`,
                            'type': 'POST',
                            data: TAModal.form.serialize(),
                            success: function(data) {
                                buttonIdle(TAModal.saveEditBtn);
                                var json = JSON.parse(data);
                                if (json['error']) {
                                    swal("Simpan Gagal", json['message'], "error");
                                    return;
                                }
                                var kelas = json['data']
                                dataTA[kelas['id_tahun_ajaran']] = kelas;
                                swal("Simpan Berhasil", "", "success");
                                renderTA(dataTA);
                                TAModal.self.modal('hide');
                            },
                            error: function(e) {}
                        });
                    });
                }



                function getTA() {
                    buttonLoading(toolbar.showBtn);
                    $.ajax({
                        url: `<?= site_url('ParameterController/getAllTahunAjaran') ?>`,
                        'type': 'GET',
                        data: {},
                        success: function(data) {
                            buttonIdle(toolbar.showBtn);
                            var json = JSON.parse(data);
                            if (json['error']) {
                                swal("Simpan Gagal", json['message'], "error");
                                return;
                            }
                            dataTA = json['data'];
                            renderTA(dataTA);
                        },
                        error: function(e) {}
                    });
                }
            });
        </script>