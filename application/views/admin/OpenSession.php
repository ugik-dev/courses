<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox ssection-container">
        <div class="ibox-content">
            <form class="form-inline" id="toolbar_form" onsubmit="return false;">
                <select class="form-control mr-sm-2" name="id_mapel" id="id_mapel" required></select>

                <!-- <input type="hidden" placeholder="" class="form-control" id="id_role" name="id_role" value="3"> -->
                <input type="text" placeholder="Search" class="form-control my-1 mr-sm-2" id="search" name="search">

                <button type="submit" class="btn btn-success my-1 mr-sm-2" id="show_btn" data-loading-text="Loading..." onclick="this.form.target='show'"><i class="fal fa-search"></i> Cari</button>
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

                                    <th style="width: 15%; text-align:center!important">Date Session</th>
                                    <th style="width: 12%; text-align:center!important">Name</th>
                                    <th style="width: 12%; text-align:center!important">Mapel</th>
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


<div class="modal inmodal" id="bank_soal_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Kelolah Session</h4>
                <span class="info"></span>
            </div>
            <div class="modal-body" id="modal-body">
                <form role="form" id="bank_soal_form" onsubmit="return false;" type="multipart" autocomplete="off">
                    <input type="" id="id_session_exam" name="id_session_exam">

                    <div class="form-group">
                        <label for="nama">Mata Pelajaran</label>
                        <select class="form-control mr-sm-2" name="id_mapel" id="id_mapel"></select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Session Name</label>
                        <input type="text" placeholder="" class="form-control" id="name_session_exam" name="name_session_exam" required="required"></input>
                    </div>
                    <label for="open_start">Avaliable</label>
                    <div class="col-lg-12">

                        <div class="row">

                            <div class="form-group">
                                <label for="open_start"> From</label>
                                <input type="datetime-local" placeholder="" class="form-control" id="open_start" name="open_start" required="required"></input>
                            </div>
                            <div class="form-group">
                                <label for="open_start"> To</label>
                                <input type="datetime-local" placeholder="" class="form-control" id="open_end" name="open_end" required="required"></input>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Waktu Ujian (Menit)</label>
                        <input type="number" placeholder="" class="form-control" id="limit_time" name="limit_time" required="required"></input>
                    </div>
                    <div class="form-group">
                        <label for="password">Jumlah Soal</label>
                        <input type="number" placeholder="" class="form-control" id="limit_soal" name="limit_soal" required="required"></input>
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

        $('#open_session').addClass('active');


        var toolbar = {
            'form': $('#toolbar_form'),
            'showBtn': $('#show_btn'),
            'addBtn': $('#show_btn'),
            'id_mapel': $('#toolbar_form').find('#id_mapel'),
            'search': $('#toolbar_form').find('#search'),
        }

        var FDataTable = $('#FDataTable').DataTable({
            'columnDefs': [],
            deferRender: true,
            "order": [
                [0, "desc"]
            ]
        });

        var Kelolahbank_soalModal = {
            'self': $('#bank_soal_modal'),
            'info': $('#bank_soal_modal').find('.info'),
            'form': $('#bank_soal_modal').find('#bank_soal_form'),
            'addBtn': $('#bank_soal_modal').find('#add_btn'),
            'saveEditBtn': $('#bank_soal_modal').find('#save_edit_btn'),
            'id_session_exam': $('#bank_soal_modal').find('#id_session_exam'),
            'id_mapel': $('#bank_soal_modal').find('#id_mapel'),
            'name_session_exam': $('#bank_soal_modal').find('#name_session_exam'),
            'open_start': $('#bank_soal_modal').find('#open_start'),
            'open_end': $('#bank_soal_modal').find('#open_end'),
            'limit_soal': $('#bank_soal_modal').find('#limit_soal'),
            'limit_time': $('#bank_soal_modal').find('#limit_time'),
        }

        getAllMapel();

        function getAllMapel() {
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

        var dataKelolahbank_soal = {};
        var dataRole = {};

        toolbar.form.submit(function(event) {
            event.preventDefault();
            switch (toolbar.form[0].target) {
                case 'show':
                    getKelolahbank_soal();
                    break;
                case 'add':
                    showKelolahbank_soalModal();
                    break;
            }
        });

        getKelolahbank_soal()

        function getKelolahbank_soal() {
            return $.ajax({
                url: `<?php echo site_url('AdminController/getAllSession/') ?>`,
                'type': 'POST',
                data: toolbar.form.serialize(),
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dataKelolahbank_soal = json['data'];
                    renderKelolahbank_soal(dataKelolahbank_soal);
                },
                error: function(e) {}
            });
        }


        function renderMapel(data) {
            toolbar.id_mapel.empty();
            toolbar.id_mapel.append($('<option>', {
                value: "",
                text: "-- Pilih Mapel --"
            }));

            Kelolahbank_soalModal.id_mapel.empty();
            Kelolahbank_soalModal.id_mapel.append($('<option>', {
                value: "",
                text: "-- Pilih Mapel --"
            }));

            Object.values(data).forEach((d) => {
                toolbar.id_mapel.append($('<option>', {
                    value: d['id_mapel'],
                    text: d['nama_mapel'],
                }));
                Kelolahbank_soalModal.id_mapel.append($('<option>', {
                    value: d['id_mapel'],
                    text: d['nama_mapel'],
                }));
            });
        }

        function renderKelolahbank_soal(data) {
            if (data == null || typeof data != "object") {
                console.log("User::UNKNOWN DATA");
                return;
            }

            var i = 0;

            var renderData = [];
            Object.values(data).forEach((bank_soal) => {

                var detailButton = `
      <a class="detail dropdown-item" href='<?= site_url() ?>AdminController/DetailKelolahbank_soal?id_bank_soal=${bank_soal['id_bank_soal']}&nama_bank_soal=${bank_soal['nama']}'><i class='fa fa-share'></i> Detail Desa Wisata</a>
      `;
                var editButton = `
        <a class="edit dropdown-item" data-id='${bank_soal['id_session_exam']}'><i class='fa fa-pencil'></i> Edit </a>
      `;
                var deleteButton = `
        <a class="delete dropdown-item" data-id='${bank_soal['id_session_exam']}'><i class='fa fa-trash'></i> Hapus </a>
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

                renderData.push(['From' + bank_soal['open_start'] + '<br> To : ' + bank_soal['open_start'], bank_soal['nama_mapel'], bank_soal['name_session_exam'], button]);
            });
            FDataTable.clear().rows.add(renderData).draw('full-hold');
        }

        FDataTable.on('click', '.edit', function() {
            event.preventDefault();
            Kelolahbank_soalModal.form.trigger('reset');
            Kelolahbank_soalModal.addBtn.hide();
            Kelolahbank_soalModal.saveEditBtn.show();
            var id = $(this).data('id');
            var bank_soal = dataKelolahbank_soal[id];
            Kelolahbank_soalModal.id_session_exam.val(bank_soal['id_session_exam']);
            Kelolahbank_soalModal.id_mapel.val(bank_soal['id_mapel']);
            Kelolahbank_soalModal.open_start.val(bank_soal['open_start'].replace(' ', 'T'));
            Kelolahbank_soalModal.open_end.val(bank_soal['open_end'].replace(' ', 'T'));
            Kelolahbank_soalModal.name_session_exam.val(bank_soal['name_session_exam']);
            Kelolahbank_soalModal.limit_soal.val(bank_soal['limit_soal']);

            Kelolahbank_soalModal.limit_time.val(bank_soal['limit_time']);
            Kelolahbank_soalModal.self.modal('show');
        });

        FDataTable.on('click', '.delete', function() {
            event.preventDefault();
            var id = $(this).data('id');
            swal(swalDeleteConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                $.ajax({
                    url: "<?= site_url('Kelolahbank_soalController/deleteKelolahbank_soal') ?>",
                    'type': 'POST',
                    data: {
                        'id_bank_soal': id
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swal("Delete Gagal", json['message'], "error");
                            return;
                        }
                        delete dataKelolahbank_soal[id];
                        swal("Delete Berhasil", "", "success");
                        renderKelolahbank_soal(dataKelolahbank_soal);
                    },
                    error: function(e) {}
                });
            });
        });

        function showKelolahbank_soalModal() {
            Kelolahbank_soalModal.self.modal('show');
            Kelolahbank_soalModal.addBtn.show();
            Kelolahbank_soalModal.saveEditBtn.hide();
            Kelolahbank_soalModal.form.trigger('reset');
            Kelolahbank_soalModal.id_mapel.val(toolbar.id_mapel.val());
        }

        Kelolahbank_soalModal.form.submit(function(event) {
            event.preventDefault();
            switch (Kelolahbank_soalModal.form[0].target) {
                case 'add':
                    addKelolahbank_soal();
                    break;
                case 'edit':
                    editKelolahbank_soal();
                    break;
            }
        });

        function addKelolahbank_soal() {
            swal(swalSaveConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                buttonLoading(Kelolahbank_soalModal.addBtn);
                $.ajax({
                    url: `<?= site_url('AdminController/addSessionExam') ?>`,
                    'type': 'POST',
                    data: Kelolahbank_soalModal.form.serialize(),
                    success: function(data) {
                        buttonIdle(Kelolahbank_soalModal.addBtn);
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swal("Simpan Gagal", json['message'], "error");
                            return;
                        }
                        var bank_soal = json['data']
                        dataKelolahbank_soal[bank_soal['id_session_exam']] = bank_soal;
                        swal("Simpan Berhasil", "", "success");
                        renderKelolahbank_soal(dataKelolahbank_soal);
                        Kelolahbank_soalModal.self.modal('hide');
                    },
                    error: function(e) {}
                });
            });
        }

        function editKelolahbank_soal() {
            swal(swalSaveConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                buttonLoading(Kelolahbank_soalModal.saveEditBtn);
                $.ajax({
                    url: `<?= site_url('AdminController/editSessionExam') ?>`,
                    'type': 'POST',
                    data: Kelolahbank_soalModal.form.serialize(),
                    success: function(data) {
                        buttonIdle(Kelolahbank_soalModal.saveEditBtn);
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swal("Simpan Gagal", json['message'], "error");
                            return;
                        }
                        var bank_soal = json['data']
                        dataKelolahbank_soal[bank_soal['id_session_exam']] = bank_soal;
                        swal("Simpan Berhasil", "", "success");
                        renderKelolahbank_soal(dataKelolahbank_soal);
                        Kelolahbank_soalModal.self.modal('hide');
                    },
                    error: function(e) {}
                });
            });
        }
    });
</script>