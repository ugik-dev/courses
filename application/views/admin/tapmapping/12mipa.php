<div role="tabpanel" id="tab-55" class="tab-pane">
    <div class="panel-body">
        <div class="form-group">
            <div class="row m-t-sm">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="FDataTable_12_mipa" class="table table-bordered table-hover" style="padding:0px">
                            <thead>
                                <tr>
                                    <th style="width: 90%; text-align:center!important">Mata Pelajaran</th>
                                    <th style="width: 10%; text-align:center!important">Status</th>
                                    <th style="width: 10%; text-align:center!important">Act</th>
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


<script>
    $(document).ready(function() {

        var FDataTable_12_mipa = $('#FDataTable_12_mipa').DataTable({
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
        getAllMapel_12_mipa();

        function getAllMapel_12_mipa() {
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
                    kelas: '12'
                },
                success: function(data) {
                    swal.close();
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dataMapel10Mipa = json['data'];
                    render_12_mipa(dataMapel10Mipa);
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


        function render_12_mipa(data) {
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
            FDataTable_12_mipa.clear().rows.add(renderData).draw('full-hold');
        };

        FDataTable_12_mipa.on('click', '.nonactive', function() {
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
                    getAllMapel_12_mipa();
       },
                error: function(e) {}
            });
        });

        FDataTable_12_mipa.on('click', '.act', function() {
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
                    getAllMapel_12_mipa();
                },
                error: function(e) {}
            });
        });


        FDataTable_12_mipa.on('click', '.create', function() {
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
                    getAllMapel_12_mipa();
                },
                error: function(e) {}
            });
        });
    });
</script>