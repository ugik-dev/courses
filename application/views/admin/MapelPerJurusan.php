<div class="wrapper wrapper-content animated fadeInRight">
    <div class="tabs-container">
        <ul class="nav nav-tabs" role="tablist">
            <li><a class="nav-link active" data-toggle="tab" href="#tab-11">10 MIPA</a></li>
            <li><a class="nav-link" data-toggle="tab" href="#tab-22">10 IPS</a></li>
            <li><a class="nav-link" data-toggle="tab" href="#tab-33">11 MIPA</a></li>
            <li><a class="nav-link" data-toggle="tab" href="#tab-44">11 IPS</a></li>
            <li><a class="nav-link" data-toggle="tab" href="#tab-55">12 MIPA</a></li>
            <li><a class="nav-link" data-toggle="tab" href="#tab-66">12 IPS</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" id="tab-11" class="tab-pane active">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row m-t-sm">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="FDataTable_10mipa" class="table table-bordered table-hover" style="padding:0px">
                                        <thead>
                                            <tr>
                                                <th style="width: 90%; text-align:center!important">Mata Pelajaran</th>
                                                <th style="width: 10%; text-align:center!important">Status</th>
                                                <th style="width: 10%; text-align:center!important">Act</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                    <button type="submit" class="btn btn-primary my-1 mr-sm-2" id="add_10_mipa"><i class="fal fa-plus"></i> Tambah</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" id="tab-22" class="tab-pane">
                <div class="panel-body">
                    sad
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="message_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Kirim Pesan</h4>
                <span class="info"></span>
            </div>
            <div class="modal-body" id="modal-body">
                <form role="form" id="user_form" onsubmit="return false;" type="multipart" autocomplete="off">
                    <input hidden type="text" id="id_operator" name="id_user_reciver">
                    <div class="form-group">
                        <label for="nama">Ke : </label>
                        <input type="text" placeholder="Nama" class="form-control" id="nama_operator" name="" required="required" readonly>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Pesan</label>
                        <textarea rows="5" type="text" placeholder="" class="form-control" id="" name="message" required="required"></textarea>
                    </div>
                    <div class="form-group">

                        <textarea hidden rows="5" type="text" placeholder="" class="form-control" id="format_message" name="format_message" required="required"></textarea>
                    </div>
                    <button class="btn btn-success my-1 mr-sm-2" type="submit" id="send_btn" data-loading-text="Loading..." onclick="this.form.target='send'"><strong>Kirim</strong></button>
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

        var FDataTable_10mipa = $('#FDataTable_10mipa').DataTable({
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

        var KelolahuserModal = {
            'self': $('#user_modal'),
            'info': $('#user_modal').find('.info'),
            'form': $('#user_modal').find('#user_form'),
            'addBtn': $('#user_modal').find('#add_btn'),
            'saveEditBtn': $('#user_modal').find('#save_edit_btn'),
            'id_user': $('#user_modal').find('#id_user'),
            'nama': $('#user_modal').find('#nama'),
            'username': $('#user_modal').find('#username'),
            'id_role': $('#user_modal').find('#id_role'),
            'password': $('#user_modal').find('#password'),
            'repassword': $('#user_modal').find('#repassword'),
            'lokasi': $('#user_modal').find('#lokasi'),
            'deskripsi': $('#user_modal').find('#deskripsi'),
            'kabupaten': $('#user_modal').find('#kabupaten'),
        }
        dataMapel = [];

        function getAllMapel() {
            swal({
                title: 'Loading..',
                allowOutsideClick: false
            });
            swal.showLoading();
            return $.ajax({
                url: `<?php echo site_url('ParameterController/getAllMapel/') ?>`,
                'type': 'GET',
                data: {},
                success: function(data) {
                    swal.close();
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dataMapel = json['data'];
                    // renderReqKPB(dataReqKPB);
                },
                error: function(e) {}
            });
        }
        getAllMapel10Mipa();

        function getAllMapel10Mipa() {
            swal({
                title: 'Loading..',
                allowOutsideClick: false
            });
            swal.showLoading();
            return $.ajax({
                url: `<?php echo site_url('ParameterController/getAllMapelJurusan/') ?>`,
                'type': 'Post',
                data: {
                    id_jenis_jurusan: '1',
                    kelas: '10'
                },
                success: function(data) {
                    swal.close();
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dataMapel10Mipa = json['data'];
                    render10Mipa(dataMapel10Mipa);
                },
                error: function(e) {}
            });
        }

        function status(status) {
            if (status == '1')
                return `<i class='fa fa-edit text-success'> Aktif</i>`;
            else
                return `<i class='fa fa-file text-danger'> Tidak Aktif</i>`;
        }


        function render10Mipa(data) {
            console.log(data)
            if (data == null || typeof data != "object") {
                console.log("UNKNOWN DATA");
                return;
            }
            var i = 0;
            // data = ['a', 'b']
            var renderData = [];
            Object.values(data).forEach((d) => {
                stat = `<input id='checked_${i}' type="checkbox" aria-label="Checkbox for following text input" checked>
                <input id='status_${i}' name='status_${i}' type="" value='${d['status_mj'] == '1' ? '1' :'2'}' >
                <input id='var_${i}' name='var_${i}' type="" value='${i}'>`;
                if (d['status_mj'] == '1') {
                    btn = `<a class="nonactive active btn btn-success btn-sm" data-id="${d['id_mapel_jurusan']}"><i class='fa fa-angle-double-right'></i></a>`;
                } else if (d['status_mj'] == '2') {
                    btn = `<a class="act active btn btn-success btn-sm kpb_rek" data-id="${d['id_mapel_jurusan']}"><i class='fa fa-angle-double-right'></i></a>`;
                } else {
                    btn = `<a class="create active btn btn-success btn-sm kpb_rek" data-kelas="${d['kelas']}" data-jurusan="${d['id_jenis_jurusan']}" data-mapel="${d['id_mapel']}"><i class='fa fa-angle-double-right'></i></a>`;
                }
                renderData.push([d['nama_mapel'], status(d['status_mj']), btn]);
                i++;
                // initial_checked_10mipa(i);
            });
            console.log(renderData)
            FDataTable_10mipa.clear().rows.add(renderData).draw('full-hold');
        };

        FDataTable_10mipa.on('click', '.nonactive', function() {
            console.log('nonactive');
            var id = $(this).data('id');
            console.log(id)
            swal({
                title: 'Loading..',
                allowOutsideClick: true
            });
            return $.ajax({
                url: `<?php echo site_url('AdminController/NonActive/') ?>`,
                'type': 'POST',
                data: {
                    id_mapel_jurusan: id,
                    // kelas: '10'
                },
                success: function(data) {
                    swal.close();
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    getAllMapel10Mipa();
       },
                error: function(e) {}
            });
        });

        FDataTable_10mipa.on('click', '.act', function() {
            console.log('act');
            var id = $(this).data('id');
            console.log(id)
            swal({
                title: 'Loading..',
                allowOutsideClick: true
            });
            return $.ajax({
                url: `<?php echo site_url('AdminController/Active/') ?>`,
                'type': 'POST',
                data: {
                    id_mapel_jurusan: id,
                    // kelas: '10'
                },
                success: function(data) {
                    swal.close();
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    getAllMapel10Mipa();
                },
                error: function(e) {}
            });
        });


        FDataTable_10mipa.on('click', '.create', function() {
            console.log('create');
            var mapel = $(this).data('mapel');
            var kelas = $(this).data('kelas');
            var jurusan = $(this).data('jurusan');
       
            console.log(jurusan)
            swal({
                title: 'Loading..',
                allowOutsideClick: true
            });
            return $.ajax({
                url: `<?php echo site_url('AdminController/Create/') ?>`,
                'type': 'POST',
                data: {
                    id_mapel: mapel,
                     kelas: kelas,
                     id_jenis_jurusan : jurusan
                },
                success: function(data) {
                    swal.close();
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    getAllMapel10Mipa();
                },
                error: function(e) {}
            });
        });





    });
</script>