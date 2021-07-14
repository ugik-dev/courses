<style>
    .radioabsensi input:checked {
        background-color: green;
    }
</style>


<div class="container">
   
    <div class="wrapperwrapper-content animated fadeInRight">
        <div class="ibox section-container">
            <div class="ibox-content">
                <div class="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a class="nav-link active" data-toggle="tab" href="#tab-11">Data Tugas </a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#tab-22">Data Siswa</a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#chat">Chat Room</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" id="tab-11" class="tab-pane active">
                            <div class="panel-body">
                                <div class="ibox">
                                    <div id="profil">
                                        <div class="form-group">
                                            <form class="form-inline" id="toolbar_form" onsubmit="return false;">
                                                <button class="save btn btn-success my-1 mr-sm-2" type="" id="add_task" data-loading-text="Loading..."><strong>Tambah Tugas</strong></button>
                                                <a type="" class="btn btn-light my-1 mr-sm-2" id="export_btn" href=""><i class="fal fa-download"></i> Export PDF</a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table id="FDataTableTask" class="table table-bordered table-hover" style="padding:0px;font-size:11px">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 19%; text-align:center!important">Nama Tugas</th>
                                                        <th style="width: 19%; text-align:center!important">Batas Awal Pengerjaan</th>
                                                        <th style="width: 19%; text-align:center!important">Batas Akhir Pengerjaan</th>
                                                        <th style="width: 19%; text-align:center!important">Dokumen</th>
                                                        <th style="width: 19%; text-align:center!important">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" id="chat" class="tab-pane">
                            <div class="panel-body">
                                <div class="ibox">
                                    <!--    PANEL CHAT -->
                                    <div class="col-lg-12">

                                        <div class="ibox chat-view">

                                            <div class="ibox-title">
                                                <small class="float-right text-muted"></small>

                                            </div>
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <div class="chat-discussion" id='chat-discussion' style="height : 500px">
                                                            <a class="alert alert-info d-flex justify-content-center" id="load_more"> Load More</a>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="chat-message-form">

                                                            <div class="form-group">
                                                                <form id="form_message">
                                                                    <input type="hidden" id="id_mapping_kelas_message" name="id_mapping_kelas">

                                                                    <textarea class="form-control message-input" id="message" name="text_message" placeholder="Enter message text"></textarea>
                                                                </form>
                                                                <button type="button" class="btn btn-success float-right" id="sent_message_btn" data-loading-text="Mengirim ..."><i class="fal fa-paper-plane"></i> Kirim</button>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                    </div>

                                    <!-- END CHAT -->
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" id="tab-22" class="tab-pane">
                            <div class="panel-body">
                                <div class="ibox">
                                    <div class="ibox-content" id="input_modal">
                                        <div class="form-inline">
                                        </div>

                                        <div class="form-group">
                                            <div class="row m-t-sm">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table id="FDataTableSiswa" class="table table-bordered table-hover" style="padding:0px;font-size:11px">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 50%; text-align:center!important">Nama Siswa</th>
                                                                    <th style="width: 40%; text-align:center!important">Nomor Induk</th>
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
</div>

<div class="modal inmodal" id="pdf_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="container" style="padding-bottom: 10%"><br><br>
                <div id="iframepdf"> </div>
                </object>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="task_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Tambah TASK</h4>
                <span class="info"></span>
            </div>
            <div class="modal-body" id="modal-body">
                <form role="form" id="task_form" onsubmit="return false;" type="multipart" autocomplete="off">
                    <input type="hidden" id="id_mapping_kelas" name="id_mapping_kelas">
                    <input type="hidden" id="id_task" name="id_task">
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea rows="6" type="text" class="form-control" id="deskripsi" name="deskripsi"></textarea>
                    </div>
                    <div class="form-group" id="task_dokumen_form">
                        <label for="task_dokumen">Dokumen Tambahan</label>
                        <p class="no-margins"><span id="task_dokumen">-</span></p>
                    </div>
                    <div class="form-group">
                        <label for="start_task">Batas Awal Pengerjaan </label>
                        <input type="datetime-local" placeholder="" class="form-control" id="start_task" name="start_task" required="required">
                    </div>
                    <div class="form-group">
                        <label for="end_task">Batas Akhir Pengerjaan </label>
                        <input type="datetime-local" placeholder="" class="form-control" id="end_task" name="end_task" required="required">
                    </div>
                    <div id='show_dokumen'>

                    </div>
                    <button class="btn btn-success my-1 mr-sm-2" type="submit" id="add_task_btn" data-loading-text="Loading..." onclick="this.form.target='add'"><strong>Tambah Tugas</strong></button>
                    <button class="btn btn-success my-1 mr-sm-2" type="submit" id="edit_task_btn" data-loading-text="Loading..." onclick="this.form.target='edit'"><strong>Simpan Perubahan</strong></button>

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
        // $('#Mapping').addClass('active');
         $('#forum_saya').addClass('active');
        var id_mapping_kelas = "<?= $contentData['id_mapping_kelas'] ?>";
        var me = "<?= $this->session->userdata('id_user') ?>";
        var id_mapping = "<?= $contentData['id_mapping'] ?>";

        var dataProfil;
        var dataTahun;
        var dataV0 = {};
        var dataChat = {};
        var first_chat = 0;
        var last_chat = 0;

        chatHTML = $('#chat-discussion');
        //     document.getElementById("export_btn").href = '<?= site_url('AdminController/PdfMapping?id_mapping=') ?>' + id_mapping;

        var form_message = $('#form_message');
        var message = $('#message');
        var sent_message_btn = $('#sent_message_btn');
        var load_more = $('#load_more');
        $('#id_mapping_kelas_message').val(id_mapping_kelas)
        var toolbar = {
            'form': $('#toolbar_form'),
            'add_task': $('#add_task'),
        }

        var add_siswa = $('#add_siswa');

        var LayerModal = {
            'form': $('#LayerModal'),
            'nama_wali_kelas': $('#LayerModal').find('#nama_wali_kelas'),
            'id_wali_kelas': $('#LayerModal').find('#id_wali_kelas'),
            'jumlah_mapel': $('#LayerModal').find('#jumlah_mapel'),
            'save_profil_btn': $('#save_profil_btn')
        }

        pdf_modal = $('#pdf_modal');

        var TaskModal = {
            'self': $('#task_modal'),
            'info': $('#task_modal').find('.info'),
            'form': $('#task_modal').find('#task_form'),
            'add_task_btn': $('#task_form').find('#add_task_btn'),
            'edit_task_btn': $('#task_form').find('#edit_task_btn'),
            'start_task': $('#task_form').find('#start_task'),
            'end_task': $('#task_form').find('#end_task'),
            'deskripsi': $('#task_form').find('#deskripsi'),
            'show_dokumen': $('#task_form').find('#show_dokumen'),
            'id_mapping_kelas': $('#task_form').find('#id_mapping_kelas'),
            'id_mapping': $('#task_form').find('#id_mapping'),
            'id_task': $('#task_form').find('#id_task'),
            'task_dokumen': new FileUploader($('#task_form').find('#task_dokumen'), "", "task_dokumen", ".png , .pdf , .jpg , .jpeg , .doc, .docx ", false, true),
            // 'task_dokumen_form': $('#task_form').find('#task_dokumen_form'),

        }

        var FDataTableSiswa = $('#FDataTableSiswa').DataTable({
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

        var FDataTableTask = $('#FDataTableTask').DataTable({
            'columnDefs': [{
                targets: [2],
                className: 'text-center'
            }, ],
            deferRender: true,
            "order": [
                [1, "asc"]
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

        swalAddTaskConfigure = {
            title: "Konfirmasi Tambah",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#red",
            confirmButtonText: "Ya, Tambah!",
        };

        var swalDeleteConfigure = {
            title: "Konfirmasi Hapus Tugas",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#18a689",
            confirmButtonText: "Ya, Hapus!",
        };
        var dataMapping = {};
        var dataTask = {};
        var dataSiswa = {};
        var dataSiswaMapping = {};

        getAllTask();

        function getAllTask() {
            return $.ajax({
                url: `<?php echo site_url('GuruController/getAllTask/') ?>`,
                'type': 'POST',
                data: {
                    id_mapping_kelas: id_mapping_kelas
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dataTask = json['data'];
                    renderTask(dataTask);
                },
                error: function(e) {}
            });
        }



        getChat();

        function getChat() {
            return $.ajax({
                url: `<?php echo site_url('ParameterController/getAllMappingKelasChat/') ?>`,
                'type': 'get',
                data: {
                    id_mapping_kelas: id_mapping_kelas
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dataChat = json['data'];
                    renderChat(dataChat);
                },
                error: function(e) {}
            });
        }

        getAllSiswaMapping();

        function getAllSiswaMapping() {
            return $.ajax({
                url: `<?php echo site_url('GuruController/getAllSiswaMapping/') ?>`,
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

        TaskModal.form.submit(function(event) {

            event.preventDefault();
            switch (TaskModal.form[0].target) {
                case 'add':
                    addTask();
                    break;
                case 'edit':
                    editTask();
                    break;
            }
        })

        function addTask() {
            event.preventDefault();
            swal(swalAddTaskConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                buttonLoading(TaskModal.add_task_btn);
                $.ajax({
                    url: `<?= site_url('GuruController/create_task') ?>`,
                    'type': 'POST',
                    data: new FormData(TaskModal.form[0]),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        buttonIdle(TaskModal.add_task_btn);
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swal("Simpan Gagal", json['message'], "error");
                            return;
                        }
                        TaskModal.self.modal('hide');
                        getAllTask();
                        swal("Simpan Berhasil", "", "success");
                        // getInputPengunjung();
                    },
                    error: function(e) {}
                });
            });
        }

        function editTask() {
            event.preventDefault();
            swal(swalAddTaskConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                buttonLoading(TaskModal.edit_task_btn);
                $.ajax({
                    url: `<?= site_url('GuruController/edit_task') ?>`,
                    'type': 'POST',
                    data: new FormData(TaskModal.form[0]),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        buttonIdle(TaskModal.edit_task_btn);
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swal("Simpan Gagal", json['message'], "error");
                            return;
                        }
                        TaskModal.self.modal('hide');
                        getAllTask();
                        swal("Simpan Berhasil", "", "success");
                        // getInputPengunjung();
                    },
                    error: function(e) {}
                });
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
                stat = `<input type="text" placeholder="" class="form-control" id="guru_mapel_${i}" name="guru_mapel_${i}" value='${d['id_tenaga_kerja'] ? ( d['id_tenaga_kerja'] != '0' ? dataTask[d['id_tenaga_kerja']]['nama'] : '' ) : ''}'>
               
                <input type="hidden"  id='mapping_kelas_mapel_${i}' name='mapping_kelas_mapel_${i}' value='${d['id_mapel_jurusan']}' >
       
                <input type="hidden" id='id_guru_${i}' name='id_guru_${i}' value='${d['id_tenaga_kerja'] ? ( d['id_tenaga_kerja'] != '0' ? dataTask[d['id_tenaga_kerja']]['id_user'] : '' ) : ''}'>
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

        function renderTask(data) {
            if (data == null || typeof data != "object") {
                // console.log("UNKNOWN DATA");
                return;
            }
            var i = 0;
            var renderData = [];
            Object.values(data).forEach((d) => {
                var sh = d['task_dokumen'] ? ` <a class="open_file active btn btn-success btn-sm " data-id_task="${d['id_task']}"><i class='fa fa-eye'></i></a>` : '';
                var fl = downloadButtonV2("<?= base_url('upload/task_dokumen/') ?>", d['task_dokumen'], "Dokumen");
                btn = `<a class="delete active btn btn-success btn-sm " data-id_task="${d['id_task']}"><i class='fa fa-trash'></i></a>
                   <a class="edit active btn btn-success btn-sm " data-id_task="${d['id_task']}"><i class='fa fa-pencil'></i></a>
               
                   <a class="active btn btn-success btn-sm" href="<?= site_url() ?>GuruController/task?id_task=${d['id_task']}"><i class='fa fa-braille'></i></a>`;
                renderData.push([d['deskripsi'], d['start_task'], d['end_task'], fl + sh, btn]);
                i++;
            });
            console.log(renderData)
            FDataTableTask.clear().rows.add(renderData).draw('full-hold');
        };


        function renderChat(data) {
            i = 0;
            Object.values(data).forEach((d) => {
                if (i == 0) {
                    first_chat = d['id_chat'];
                    last_chat = d['id_chat'];
                }
                last_chat = d['id_chat'];
                var date = new Date(d['date']);
                console.log(date)
                var tahun = date.getFullYear();
                var tanggal = date.getDate();
                var bulan = date.getMonth();
                var tanggal = date.getDate();
                var hari = date.getDay();
                switch (hari) {
                    case 0:
                        hari = "Ming";
                        break;
                    case 1:
                        hari = "Sen";
                        break;
                    case 2:
                        hari = "Sel";
                        break;
                    case 3:
                        hari = "Rab";
                        break;
                    case 4:
                        hari = "Kam";
                        break;
                    case 5:
                        hari = "Jum";
                        break;
                    case 6:
                        hari = "Sab";
                        break;
                }
                switch (bulan) {
                    case 0:
                        bulan = "Jan";
                        break;
                    case 1:
                        bulan = "Feb";
                        break;
                    case 2:
                        bulan = "Mar";
                        break;
                    case 3:
                        bulan = "Apr";
                        break;
                    case 4:
                        bulan = "Mei";
                        break;
                    case 5:
                        bulan = "Jun";
                        break;
                    case 6:
                        bulan = "Jul";
                        break;
                    case 7:
                        bulan = "Ags";
                        break;
                    case 8:
                        bulan = "Sep";
                        break;
                    case 9:
                        bulan = "Okt";
                        break;
                    case 10:
                        bulan = "Nov";
                        break;
                    case 11:
                        bulan = "Des";
                        break;
                }
                html_go = `
                <div id='row_id_${d['id_chat']}' class="chat-message ${ me == d['id_user'] ? 'left' : 'right' }">
                <img class="message-avatar" src="${ d['photo']  ? '<?= base_url('upload/profile/') ?>'+d['photo'] :  '<?= base_url('upload/profile_small.jpg') ?>' }" alt="">
                            <div class="message">
                        
                                <a class="message-author" href="#"> ${d['nama']} - ${d['username']}</a>
                                <span class="message-date"> ${hari}, ${tanggal} ${bulan} ${tahun} - ${d['date'].split(" ")[1]} </span>
                                <span class="message-content">
                              ${d['text_message']}   </span>
                             </div>
                </div>`
                last_chat = d['id_chat'];
                chatHTML.append(html_go);
                i++;
            });
        }
        setInterval(function() {
            getReload();
        }, 4000);


        function reloadChat(data) {
            Object.values(data).forEach((d) => {

                last_chat = d['id_chat'];
                var date = new Date(d['date']);
                console.log(date)
                var tahun = date.getFullYear();
                var tanggal = date.getDate();
                var bulan = date.getMonth();
                var tanggal = date.getDate();
                var hari = date.getDay();
                switch (hari) {
                    case 0:
                        hari = "Ming";
                        break;
                    case 1:
                        hari = "Sen";
                        break;
                    case 2:
                        hari = "Sel";
                        break;
                    case 3:
                        hari = "Rab";
                        break;
                    case 4:
                        hari = "Kam";
                        break;
                    case 5:
                        hari = "Jum";
                        break;
                    case 6:
                        hari = "Sab";
                        break;
                }
                switch (bulan) {
                    case 0:
                        bulan = "Jan";
                        break;
                    case 1:
                        bulan = "Feb";
                        break;
                    case 2:
                        bulan = "Mar";
                        break;
                    case 3:
                        bulan = "Apr";
                        break;
                    case 4:
                        bulan = "Mei";
                        break;
                    case 5:
                        bulan = "Jun";
                        break;
                    case 6:
                        bulan = "Jul";
                        break;
                    case 7:
                        bulan = "Ags";
                        break;
                    case 8:
                        bulan = "Sep";
                        break;
                    case 9:
                        bulan = "Okt";
                        break;
                    case 10:
                        bulan = "Nov";
                        break;
                    case 11:
                        bulan = "Des";
                        break;
                }
                <?php $img = base_url('upload/profile/') . $this->session->userdata('photo');
                if (empty($this->session->userdata('photo'))) {
                    $img = base_url('upload/profile_small.jpg');
                }  ?>
                html_go = `
                <div id='row_id_${d['id_chat']}' class="chat-message ${ me == d['id_user'] ? 'left' : 'right' }">
                <img class="message-avatar" src="${d['photo'] ?  '<?= base_url('upload/profile/') ?>'+d['photo'] : '<?= base_url('upload/profile_small.jpg') ?>' }" alt="">
                            <div class="message">
                        
                                <a class="message-author" href="#"> ${d['nama']} - ${d['username']}</a>
                                <span class="message-date"> ${hari}, ${tanggal} ${bulan} ${tahun} - ${d['date'].split(" ")[1]} </span>
                                <span class="message-content">
                              ${d['text_message']}   </span>
                             </div>
                </div>`
                last_chat = d['id_chat'];
                chatHTML.append(html_go);
            });
        }

        load_more.on('click', function() {
            console.log('load more');
            LoadMore();

        });

        function LoadMore() {
            return $.ajax({
                url: `<?php echo site_url('MessageController/getLoadMoreMappingKelasChat/') ?>`,
                'type': 'get',
                data: {
                    id_mapping_kelas: id_mapping_kelas,
                    first: first_chat
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dat = json['data'];
                    renderLoadMore(dat)
                },
                error: function(e) {}
            });
        }

        function renderLoadMore(data) {
            var html_go = ``;
            var i = 0;

            Object.values(data).forEach((d) => {
                if (i == 0) f = d['id_chat'];
                i++;
                var date = new Date(d['date']);
                console.log(date)
                var tahun = date.getFullYear();
                var tanggal = date.getDate();
                var bulan = date.getMonth();
                var tanggal = date.getDate();
                var hari = date.getDay();
                switch (hari) {
                    case 0:
                        hari = "Ming";
                        break;
                    case 1:
                        hari = "Sen";
                        break;
                    case 2:
                        hari = "Sel";
                        break;
                    case 3:
                        hari = "Rab";
                        break;
                    case 4:
                        hari = "Kam";
                        break;
                    case 5:
                        hari = "Jum";
                        break;
                    case 6:
                        hari = "Sab";
                        break;
                }
                switch (bulan) {
                    case 0:
                        bulan = "Jan";
                        break;
                    case 1:
                        bulan = "Feb";
                        break;
                    case 2:
                        bulan = "Mar";
                        break;
                    case 3:
                        bulan = "Apr";
                        break;
                    case 4:
                        bulan = "Mei";
                        break;
                    case 5:
                        bulan = "Jun";
                        break;
                    case 6:
                        bulan = "Jul";
                        break;
                    case 7:
                        bulan = "Ags";
                        break;
                    case 8:
                        bulan = "Sep";
                        break;
                    case 9:
                        bulan = "Okt";
                        break;
                    case 10:
                        bulan = "Nov";
                        break;
                    case 11:
                        bulan = "Des";
                        break;
                }
                html_go = html_go + `
            <div id='row_id_${d['id_chat']}' class="chat-message ${ me == d['id_user'] ? 'left' : 'right' }">
            <img class="message-avatar" src="${d['photo'] ? '<?= base_url('upload/profile/') ?>'+d['photo'] : '<?= base_url('upload/profile_small.jpg') ?>' }" alt="">
                        <div class="message">
                    
                            <a class="message-author" href="#"> ${d['nama']} - ${d['username']}</a>
                            <span class="message-date"> ${hari}, ${tanggal} ${bulan} ${tahun} - ${d['date'].split(" ")[1]} </span>
                            <span class="message-content">
                          ${d['text_message']}   </span>
                         </div>
            </div>`

            });
            var newItem = document.createElement("div");
            newItem.setAttribute("id", "row_id_" + f);
            newItem.innerHTML = html_go;
            document.getElementById('chat-discussion').insertBefore(newItem, document.getElementById(`row_id_` + first_chat)); //menambahkan element paragraf p sebelum element paragraf yg memiliki identitas id dua
            first_chat = f;
            console.log(first_chat)
        }

        function getReload() {
            return $.ajax({
                url: `<?php echo site_url('MessageController/getReloadMappingKelasChat/') ?>`,
                'type': 'get',
                data: {
                    id_mapping_kelas: id_mapping_kelas,
                    last: last_chat
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dat = json['data'];
                    reloadChat(dat);
                },
                error: function(e) {}
            });
        }

        sent_message_btn.on('click', function() {
            buttonLoading(sent_message_btn);
            $.ajax({
                url: `<?= site_url('MessageController/sent_mapping_kelas') ?>`,
                'type': 'POST',
                data: form_message.serialize(),
                success: function(data) {
                    buttonIdle(sent_message_btn);
                    var json = JSON.parse(data);
                    if (json['error']) {
                        swal("Gagal mengirim pesan", json['message'], "error");
                        return;
                    }
                    message.val('');
                    getReload()
                },
                error: function(e) {}
            });
        });

        FDataTableTask.on('click', '.open_file', function() {
            var id_task = $(this).data('id_task');
            pdf_modal.modal('show');
            if (!empty(dataTask[id_task]['task_dokumen'])) {
                tmp = '<?= base_url('/upload/task_dokumen/') ?>' + dataTask[id_task]['task_dokumen'];
                pdfHTML = `
                <iframe id="iframepdf" src="${tmp}" width = "100%" height = "900px"></iframe>
                `;
                var iframepdf = document.getElementById("iframepdf");
                iframepdf.innerHTML = pdfHTML;
            };
        })

        FDataTableTask.on('click', '.delete', function() {
            var id_task = $(this).data('id_task');
            swal(swalDeleteConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                $.ajax({
                    url: `<?= site_url('GuruController/delete_task') ?>`,
                    'type': 'POST',
                    data: {
                        id_task: id_task
                    },
                    success: function(data) {
                        // buttonIdle(LayerModal.save_profil_btn);
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swal("Hapus Gagal", json['message'], "error");
                            return;
                        }
                        getAllTask();

                        swal("Berhasil di Hapus", "", "success");
                    },
                    error: function(e) {}
                });
            });
        });

        FDataTableTask.on('click', '.edit', function() {

            TaskModal.form.trigger('reset');
            TaskModal.add_task_btn.hide();
            TaskModal.edit_task_btn.show();
            var id_task = $(this).data('id_task');
            TaskModal.self.modal('show');
            console.log(dataTask[id_task]['end_task'])
            TaskModal.id_task.val(id_task);
            TaskModal.id_mapping_kelas.val(dataTask[id_task]['id_mapping_kelas']);
            TaskModal.start_task.val(dataTask[id_task]['start_task'].replace(" ", "T"));
            TaskModal.deskripsi.val(dataTask[id_task]['deskripsi']);
            TaskModal.end_task.val(dataTask[id_task]['end_task'].replace(" ", "T"));
            var fl = downloadButtonV2("<?= base_url('upload/task_dokumen/') ?>", dataTask[id_task]['task_dokumen'], "Dokumen");
            TaskModal.show_dokumen.html(fl);
        });

        toolbar.add_task.on('click', function() {
            TaskModal.form.trigger('reset');
            TaskModal.add_task_btn.show();
            TaskModal.edit_task_btn.hide();
            TaskModal.show_dokumen.html('');

            TaskModal.self.modal('show');
            TaskModal.id_mapping.val(id_mapping);
            TaskModal.id_mapping_kelas.val(id_mapping_kelas);
            TaskModal.start_task.val("");
            TaskModal.end_task.val("");
        })

        function renderSiswaMapping(data) {
            if (data == null || typeof data != "object") {
                return;
            }
            var i = 0;
            var renderData = [];
            Object.values(data).forEach((d) => {
                console.log(d)
                renderData.push([d['nama'], d['username']]);
            });
            FDataTableSiswa.clear().rows.add(renderData).draw('full-hold');
        }
    });
</script>