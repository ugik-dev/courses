<style>
    .radioabsensi input:checked {
        background-color: green;
    }
</style>
<div class="container">
    <!-- <br> -->
    <div class="wrapperwrapper-content animated fadeInRight">
        <div class="ibox section-container">
            <div class="ibox-content">
                <div class="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a class="nav-link active" data-toggle="tab" href="#tab-11">Data Tenaga Kerja</a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#tab-22">Data Siswa</a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#absensi">Absensi</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" id="tab-11" class="tab-pane active">
                            <div class="panel-body">
                                <!-- <div class="row"> -->
                                <!-- <div class="col-lg-12"> -->
                                <div class="ibox">
                                    <!-- <div class="ibox-content"> -->
                                    <div id="profil">
                                        <form id="LayerModal">
                                        <button class="save btn btn-success form-control my-1 mr-sm-2" type="submit" id="save_profil_btn" data-loading-text="Loading..."><strong>Save</strong></button>
                                              <input type="hidden" placeholder="" id="id_mapping" name="id_mapping">
                                            <input type="hidden" placeholder="" id="id_wali_kelas" name="id_wali_kelas">
                                            <input type="hidden" placeholder="" id="jumlah_mapel" name="jumlah_mapel">

                                            <div class="form-group col-lg-6">
                                                <label for="nama_wali_kelas">Nama Wali Kelas</label>
                                                <!-- <span class="">sad</span> -->
                                                <input type="text" placeholder="" class="form-control" id="nama_wali_kelas" name="nama_wali_kelas" disabled='disabled'>
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
                                         </form>
                                        <form class="form-inline" id="toolbar_form" onsubmit="return false;">
                                            <a type="" class="btn btn-light my-1 mr-sm-2" id="export_btn" href=""><i class="fal fa-download"></i> Export PDF</a>
                                        </form>
                                    </div>
                                </div>
                                <!-- </div> -->
                                <!-- </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" id="absensi" class="tab-pane">
                        <form id="absen_form" role="form" onsubmit="return false;" type="multipart" autocomplete="off">
                            <button class="save-absen btn btn-success form-control my-1 mr-sm-2 " type="submit" id="save_absen" data-loading-text="Loading..."><strong><span> <i class="fas fa-save"></i> Save</span></strong></button>

                            <div class="panel-body" id="tabAbseni">
                        </form>
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
        $('#kelas_saya').addClass('active');
        var id_mapping = "<?= $contentData['id_mapping'] ?>";
        var dataProfil;
        var dataTahun;
        var dataV0 = {};

        document.getElementById("export_btn").href = '<?= site_url('AdminController/PdfMapping?id_mapping=') ?>' + id_mapping;

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



        var dataMapping = {};
        var dataTenagaKerja = {};
        var dataSiswa = {};
        var dataSiswaMapping = {};

        getAllTenagaKerja();

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
                    getAllMapping();

                },
                error: function(e) {}
            });
        }


        getAllSiswa();

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

                    SiswaModal.nama_nis.typeahead('destroy');
                    SiswaModal.nama_nis.typeahead({
                        source: Object.values(dataSiswa).map((e) => {
                            return `${e['nama']} -- ${e['username']} -- ${e['id_user']}`;
                        }),
                        afterSelect: function(data) {
                            strArrayData = data.split(" -- ")[2];
                            // strArrayData2 = data.split(" -- ")[3];
                            // console.log(strArrayData)
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

            // console.log('submot')
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
                    dataV0 = json['data'][0];
                    renderHeaderAbsensi()
                    // console.log(dataV0)
                    LayerModal.nama_wali_kelas.val(dataV0['id_wali_kelas'] ? dataTenagaKerja[dataV0['id_wali_kelas']]['nama'] : '')
                    LayerModal.id_wali_kelas.val(dataV0['id_wali_kelas'] ? dataTenagaKerja[dataV0['id_wali_kelas']]['id_user'] : '')
                },
                error: function(e) {}
            });
        }

        function renderMapping(data) {
            if (data == null || typeof data != "object") {
                // console.log("UNKNOWN DATA");
                return;
            }
            var i = 0;
            var renderData = [];
            LayerModal.id_wali_kelas.val()

            Object.values(data).forEach((d) => {
                stat = `<input type="text" placeholder="" class="form-control" id="guru_mapel_${i}" name="guru_mapel_${i}" value='${d['id_tenaga_kerja'] ? ( d['id_tenaga_kerja'] != '0' ? dataTenagaKerja[d['id_tenaga_kerja']]['nama'] : '' ) : ''}'>
                <input type="hidden"  id='mapping_kelas_mapel_${i}' name='mapping_kelas_mapel_${i}' value='${d['id_mapel_jurusan']}' >      
                <input type="hidden" id='id_guru_${i}' name='id_guru_${i}' value='${d['id_tenaga_kerja'] ? ( d['id_tenaga_kerja'] != '0' ? dataTenagaKerja[d['id_tenaga_kerja']]['id_user'] : '' ) : ''}'>
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
            if (data == null || typeof data != "object") {
                // console.log("UNKNOWN DATA");
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
                $('#guru_mapel_' + j).typeahead('destroy');
                $('#guru_mapel_' + j).typeahead({
                    source: Object.values(dataTenagaKerja).map((e) => {
                        return `${e['nama']} -- ${e['username']} -- ${e['id_user']} -- ${j}`;
                    }),
                    afterSelect: function(data) {
                        strArrayData = data.split(" -- ")[2];
                        strArrayData2 = data.split(" -- ")[3];

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
                return;
            }
            var i = 0;

            var renderData = [];
            Object.values(data).forEach((detailMapping) => {
                renderData.push([detailMapping['nomor'], detailMapping['tahun'], detailMapping['nama_bulan'], detailMapping['domestik'], detailMapping['mancanegara'], detailMapping['jumlah']]);
            });
            FDataTable.clear().rows.add(renderData).draw('full-hold');
        }


        function renderHeaderAbsensi(def = null) {
            arr = [];
            p = 0;
            Object.values(dataSiswaMapping).forEach((d) => {
                arr[d['id_siswa']] = [];
                arr[d['id_siswa']][0] = dataSiswa[d['id_siswa']]['nama'] + ' ' + dataSiswa[d['id_siswa']]['username'] + `
                <input type="hidden" placeholder="" class="" id="row_${p}" name="row_${p}" value='${d['id_siswa']}'>
                <input type="hidden" placeholder="" class="" id="ims_${p}" name="ims_${p}" value='${d['id_mapping_siswa']}'>
`
                p++;
            });
            // tmp = ['asd','asdasd','asdas'];
            // arr[] = tmp;
            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
            var months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            if (def != null && def != dataV0['start'].split("-")[1]) {
                if (def > 12) {
                    def = def - 12
                    if (def.toString().length == 1) {
                        def = '0' + def
                    }
                    dataTEMP = parseInt(dataV0['start'].split("-")[0]) + 1 + '-' + (def) + '-01';
                } else {
                    if (def.toString().length == 1) {
                        def = '0' + def
                    }
                    dataTEMP = dataV0['start'].split("-")[0] + '-' + (def) + '-01';
                }
                var i = Date.parse(dataTEMP)
                bln = new Date(i);

            } else {
                dataTEMP = dataV0['start'];
            }

            var i = Date.parse(dataTEMP)
            var l = new Date(i);
            l = l.toLocaleString();
            var end = Date.parse(dataV0['end'])
            oneday = 60 * 1000 * 60 * 24;
            bln = new Date(Date.parse(dataV0['start']));
            bln = bln.toLocaleString();
            bln = bln.split("/")[1]
            end = new Date(end);
            end = end.toLocaleString();
            // end_day = end.split("/")[0] //new
            // end_bln = end.split("/")[1] //new
            // stat_day = l.split("/")[0] //new
            // stat_bln = l.split("/")[1] //new
            end = end.split("/")[1]

            bulantabs = ``;
            tahun = l.split("/")[2]
            tahun = tahun.split(" ")[0]
            var tb;
            tb = tahun + '-' + dataTEMP.split("-")[1] + '-';

            if (end < bln) {
                end = parseInt(end) + 12;
                for (p = bln; p <= end; p++) {
                    if (p > 12) {
                        bulantabs = bulantabs + `<button class="changebulan btn active btn-success btn-sm  my-1 mr-sm-2" data-id="${p}"  id="btn_bln_${p}" >${months[parseInt(p)-12]}</button>`
                    } else {

                        bulantabs = bulantabs + `<button class="changebulan btn active btn-success btn-sm  my-1 mr-sm-2" data-id="${p}"  id="btn_bln_${p}" >${months[p]}</button>`
                    }
                }
                end = parseInt(end) - 12;
            } else {
                for (p = bln; p <= end; p++) {

                    if (p > 12) {
                        bulantabs = bulantabs + `<button class="changebulan btn active btn-success btn-sm  my-1 mr-sm-2" data-id="${p}"  id="btn_bln_${p}" >${months[parseInt(p)-12]}</button>`
                    } else {
                        bulantabs = bulantabs + `<button class="changebulan btn active btn-success btn-sm  my-1 mr-sm-2" data-id="${p}"  id="btn_bln_${p}" >${months[p]}</button>`
                    }
                }
            }
            var inputhtmml = `  ${bulantabs} <div class="table-responsive">
           
            <input type="hidden" placeholder="" class="form-control" id="id_mapping_siswa" name="id_mapping_siswa" value='${id_mapping}'>
            <input type="hidden" placeholder="" class="form-control" id="count_siswa" name="count_siswa" value=''>
            <input type="hidden" placeholder="" class="form-control" id="count_date" name="count_date" value=''>
                              
                                    <table id="FDataTableAbsen" class="table table-bordered table-hover" style="padding:0px;font-size:11px">
                                        <thead>
                                            <tr>
                                                <td rowspan="2" style="width: 10%; text-align:center!important">Nama / Nomor Induk</td>
                                                <td colspan="31" style="width: 100%; text-align:center!important">${months[l.split('/')[1]]}</td>
                                            </tr>
                                            <tr> `

            var u = 0;
            var arr2 = [];
            var datatgl = [];
            for (z = 0; z < 33; z++) {
                tmp = parseInt(i) + z * parseInt(oneday);
                // k = i.setMonth((i.getMonth() + 1))
                tmp = new Date(tmp);
                mday = myDays[tmp.getDay()];
                if (mday != 'Minggu') {
                    tmp = tmp.toLocaleString()
                    if (l.split('/')[1] != tmp.split("/")[1]) break

                    last = tmp;
                    tmp2 = tmp.split("/")[0];
                    if (tmp2.toString().length == 1) {
                        tmp2 = '0' + tmp2;

                    }
                    var inputhtmml = inputhtmml + `<td style="width: 5%; text-align:center!important">${tmp2},  ${mday} <br>
                    <input type="hidden" placeholder="" class="" id="date_${u}" name="date_${u}" value='${tb+tmp2}'> ______________<br>
                    <a class="select_all form-check-input2 position-static" type="radio" data-tgl='${tb}${tmp2}' data-abs="1" aria-label="..."><span class="badge badge-success">H</span></a>
                    <a class="select_all form-check-input2 position-static" type="radio" data-tgl='${tb}${tmp2}' data-abs="2"  aria-label="..."><span class="badge badge-primary">I</span></a>
                    <a class="select_all form-check-input2 position-static" type="radio" data-tgl='${tb}${tmp2}' data-abs="3"  aria-label="..."><span class="badge badge-warning">S</span></a>
                    <a class="select_all form-check-input2 position-static" type="radio" data-tgl='${tb}${tmp2}' data-abs="4"  aria-label="..."><span class="badge badge-danger">A</span></a>
                    </td>`;
                    u++;
                    // background-color: green;
                    datatgl.push(tb + tmp2)
                    Object.values(dataSiswaMapping).forEach((d) => {

                        tmp3 = `<div class="radioabsensi form-check form-check-inline">
                             <input type="hidden" placeholder="" class="" id="${d['id_siswa']}_${tb}${tmp2}_id_absensi" name="${d['id_siswa']}_${tb}${tmp2}_id_absensi" value=''>
                            
                                <input class="form-check-input position-static" type="radio" name="${d['id_siswa']}_${tb}${tmp2}" id="${d['id_siswa']}_${tb}${tmp2}_val_1" value="1">
                                <input class="form-check-input position-static" type="radio" name="${d['id_siswa']}_${tb}${tmp2}" id="${d['id_siswa']}_${tb}${tmp2}_val_2" value="2">
                                <input class="form-check-input position-static" type="radio" name="${d['id_siswa']}_${tb}${tmp2}" id="${d['id_siswa']}_${tb}${tmp2}_val_3" value="3">
                                <input class="form-check-input position-static" type="radio" name="${d['id_siswa']}_${tb}${tmp2}" id="${d['id_siswa']}_${tb}${tmp2}_val_4" value="4">
                          
                            </div>
                            `

                        arr[d['id_siswa']][u] = tmp3;
                    });

                }
                // arr[d['id_siswa']]=1;
            }
            console.log(datatgl)

            var inputhtmml = inputhtmml + `</tr></thead><tbody></tbody></table>
            
                                  </div>`;
            var tab_absen = document.getElementById("tabAbseni");
            tabAbseni.innerHTML = inputhtmml;

            if (end < bln) {
                end = parseInt(end) + 12;
                for (p = bln; p <= end; p++) {
                    document.getElementById("btn_bln_" + p).onclick = function() {
                        var id = $(this).data('id');
                        renderHeaderAbsensi(id)
                    };
                }
            } else {
                for (p = bln; p <= end; p++) {
                    document.getElementById("btn_bln_" + p).onclick = function() {
                        var id = $(this).data('id');
                        renderHeaderAbsensi(id)
                    };
                }
            }
            renderFDataTableAbsen(arr, u, tb);
        }


        function renderFDataTableAbsen(arr, u, tb) {

            var FDataTableAbsen = $('#FDataTableAbsen').DataTable({
                'columnDefs': [{
                    targets: [1, 2, 3],
                    className: 'text-center'
                }, ],
                deferRender: true,
                "order": [
                    [0, "asc"]
                ],
                paging: false,
                ordering: false,
                searching: true
            });


            if (dataSiswaMapping == null || typeof dataSiswaMapping != "object") {
                console.log("User::UNKNOWN DATA");
                return;
            }
            var k = 1;

            var renderData = [];
            count_siswa = 0
            Object.values(dataSiswaMapping).forEach((d) => {
                renderData.push(arr[d['id_siswa']]);
                count_siswa++;
            });
            $('#count_date').val(u);
            $('#count_siswa').val(count_siswa);
            FDataTableAbsen.clear().rows.add(renderData).draw('full-hold');

            var AbsenModal = {
                'form': $('#absen_form'),
                'id_mapping_siswa': $('#absen_form').find('#id_mapping_siswa'),
                'id_wali_kelas': $('#absen_form').find('#id_wali_kelas'),
                'jumlah_mapel': $('#absen_form').find('#jumlah_mapel'),
                'save_absen': $('#save_absen')
            }
            getAllAbsen(tb);
            AbsenModal.form.submit(function(event) {
                event.preventDefault();
                swal(swalSaveConfigure).then((result) => {
                    if (!result.value) {
                        return;
                    }
                    buttonLoading(AbsenModal.save_absen);
                    $.ajax({
                        url: `<?= site_url('GuruController/save_absen') ?>`,
                        'type': 'POST',
                        data: AbsenModal.form.serialize(),
                        success: function(data) {
                            buttonIdle(AbsenModal.save_absen);
                            var json = JSON.parse(data);
                            if (json['error']) {
                                swal("Simpan Gagal", json['message'], "error");
                                return;
                            }
                            // getAllSiswaMapping();
                            // SiswaModal.self.modal('hide');
                            swal("Simpan Berhasil", "", "success");
                            // getInputPengunjung();
                        },
                        error: function(e) {}
                    });

                });
            });


            FDataTableAbsen.on('click', '.select_all', function() {
                event.preventDefault();
                // KelolahuserModal.form.trigger('reset');
                // KelolahuserModal.self.modal('show');
                // KelolahuserModal.addBtn.hide();
                // KelolahuserModal.saveEditBtn.show();
                var tgl = $(this).data('tgl');
                var abs = $(this).data('abs');
                console.log(tgl + abs)
                tescek(tgl, abs)
                // var user = dataKelolahuser[id];

            })
        }

        function getAllAbsen(tb) {
            return $.ajax({
                url: `<?php echo site_url('ParameterController/getAllAbsen/') ?>`,
                'type': 'POST',
                data: {
                    id_mapping: id_mapping,
                    tb: tb
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dataSiswaAbsen = json['data'];
                    renderFDataDataAbsen(dataSiswaAbsen);
                },
                error: function(e) {}
            });
        }



        function renderFDataDataAbsen(data) {

            if (data == null || typeof data != "object") {
                console.log("User::UNKNOWN DATA");
                return;
            }
            // console.log(data)
            // data = data[53];
            var i = 0;

            // var renderData = [];
            // console.log(data);

            Object.values(data).forEach((ds) => {
                Object.values(ds).forEach((dx) => {
                    Object.values(dx).forEach((dz) => {
                        $('#' + dz['id_siswa'] + '_' + dz['tgl'] + '_id_absensi').val(dz['id_absen']);
                        radiobtn = document.getElementById(dz['id_siswa'] + '_' + dz['tgl'] + '_val_' + dz['status_absensi']);
                        radiobtn.checked = true;
                    });
                });
            });
            // tescek();
        }



        function tescek(tgl, status) {
            // tgl = "2020-07-24";
            // status = '2';
            // dataSiswaMapping
            // console.log('s')
            Object.values(dataSiswaMapping).forEach((ds) => {
                console.log(ds['id_siswa'] + '_' + tgl + '_val_' + status)
                radiobtn = document.getElementById(ds['id_siswa'] + '_' + tgl + '_val_' + status);
                radiobtn.checked = true;
            });


        }

        add_siswa.on('click', function() {
            SiswaModal.self.modal('show');
            SiswaModal.id_mapping.val(id_mapping);
            SiswaModal.nama_nis.val("");
            SiswaModal.id_siswa.val("");
        })

        // $('')

    });
</script>