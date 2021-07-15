<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox ssection-container">
        <div class="ibox-content">
            <form class="form-inline" id="toolbar_form" onsubmit="return false;">
                <select class="form-control mr-sm-2" name="id_mapel" id="id_mapel" required></select>
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
                        <h1>Avaliable Exam</h1>
                        <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
                            <thead>
                                <tr>
                                    <th style="width: 15%; text-align:center!important">Avaliable time</th>
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

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <h1>Your History</h1>
                        <table id="FDataTable2" class="table table-bordered table-hover" style="padding:0px">
                            <thead>
                                <tr>
                                    <th style="width: 15%; text-align:center!important">Name Exam</th>
                                    <th style="width: 12%; text-align:center!important">Score</th>
                                    <th style="width: 12%; text-align:center!important">Date</th>
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


<script>
    $(document).ready(function() {

        $('#my_task').addClass('active');


        var toolbar = {
            'form': $('#toolbar_form'),
            'showBtn': $('#show_btn'),
            'addBtn': $('#show_btn'),
            'id_mapel': $('#toolbar_form').find('#id_mapel'),
            'search': $('#toolbar_form').find('#search'),
        }

        var FDataTable = $('#FDataTable').DataTable({
            'columnDefs': [],
            deferRender: false,
            "order": false,
            'search': false,
            "paging": false,
            'info': false
        });


        var FDataTable2 = $('#FDataTable2').DataTable({
            'columnDefs': [],
            deferRender: true,
            "order": [
                [2, "desc"]
            ]
        });



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
            title: "Konfirmasi",
            text: "Yakin akan memulai ujian?",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#18a689",
            confirmButtonText: "Ya, Mulai Sekarang!",
        };


        var dataAvaliabeExam = {};
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

        getAvaliableSession()

        function getAvaliableSession() {
            return $.ajax({
                url: `<?php echo site_url('PublicController/getAvaliableSession/') ?>`,
                'type': 'POST',
                data: toolbar.form.serialize(),
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dataAvaliabeExam = json['data'];
                    renderAvaliabeExam(dataAvaliabeExam);
                },
                error: function(e) {}
            });
        }

        getYourHistory()

        function getYourHistory() {
            return $.ajax({
                url: `<?php echo site_url('PublicController/getYourHistory/') ?>`,
                'type': 'POST',
                data: toolbar.form.serialize(),
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dataHistory = json['data'];
                    renderHistory(dataHistory);
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
            Object.values(data).forEach((d) => {
                toolbar.id_mapel.append($('<option>', {
                    value: d['id_mapel'],
                    text: d['nama_mapel'],
                }));
            });
        }

        function renderHistory(data) {
            if (data == null || typeof data != "object") {
                console.log("User::UNKNOWN DATA");
                return;
            }

            var i = 0;

            var renderData2 = [];
            Object.values(data).forEach((bank_soal) => {
                var button = `
                    <a class="btn btn-primary" href='<?= base_url() ?>my-task/${bank_soal['token']}'><i class='fa fa-arrow-circle-right '></i>  </a>
                `;
                renderData2.push([bank_soal['name_session_exam'], "Sroce : " + bank_soal['score'] + '<br> Benar : ' + bank_soal['benar'], bank_soal['start_time'], button]);
            });
            FDataTable2.clear().rows.add(renderData2).draw('full-hold');
        }



        function renderAvaliabeExam(data) {
            if (data == null || typeof data != "object") {
                console.log("User::UNKNOWN DATA");
                return;
            }

            var i = 0;

            var renderData = [];
            Object.values(data).forEach((bank_soal) => {
                var button = `
                    <button class="create btn btn-primary" data-id='${bank_soal['id_session_exam']}'><i class='fa fa-arrow-circle-right '></i> Start Exam </button>
                `;
                renderData.push(['From :' + bank_soal['open_start'] + '<br> To : ' + bank_soal['open_start'], bank_soal['nama_mapel'] + " :: " + bank_soal['name_session_exam'], 'Jumlah Soal : ' + bank_soal['limit_soal'] + ' soal<br> Waktu Pengerjaan : ' + bank_soal['limit_time'] + ' menit' + '<br>' + (bank_soal['poin_mode'] == 'avg' ? 'Akumulasi maksimum score 100' : 'Poin Mode: benar x ' + bank_soal['poin_mode']), button]);
            });
            FDataTable.clear().rows.add(renderData).draw('full-hold');
        }


        FDataTable.on('click', '.create', function() {
            event.preventDefault();
            var id = $(this).data('id');
            swal(swalSaveConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                $.ajax({
                    url: "<?= site_url('PublicController/createSessionExam') ?>",
                    'type': 'POST',
                    data: {
                        'id_session_exam': id
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        if (json['error']) {
                            swal("Create Faild", json['message'], "error");
                            return;
                        }
                        // delete dataAvaliabeExam[id];
                        swal("Create Berhasil", "", "success");
                        window.location.href = '<?= base_url() ?>my-task/' + json['data'];
                        // renderAvaliabeExam(dataAvaliabeExam);
                    },
                    error: function(e) {}
                });
            });
        });
    });
</script>