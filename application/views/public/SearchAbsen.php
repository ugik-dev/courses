<link href='<?= base_url('assets/') ?>css/plugins/fullcalendar/fullcalendar.css' rel='stylesheet' />

<div class="col-lg-12">
<div class="row">
    <div class="col-lg-3">
        <br>

        <div class="ibox-content" style="background-color:#FFFFFF">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('search') ?>">Search</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url('search/') . $dataKelas['id_siswa'] ?>"> <?= $pageData['nama'] ?></a></li>
                    <!-- <li class="breadcrumb-item active" aria-current="page"> <?= $dataKelas['nama_jenis_kelas'] . ' ' . $dataKelas['jurusan'] . ' ' . $dataKelas['sub_kelas'] . ' :: ' . $dataKelas['deskripsi'] . ' Semester ' . $dataKelas['semester']  ?></li> -->
                </ol>
            </nav>
            <br>
            <div class="card">
                <div class="card-header">
                    <?php
                    if (!empty($pageData['photo'])) {
                        $img = base_url('upload/profile/' . $pageData['photo']);
                    } else {
                        $img = base_url('upload/profile_small.jpg');
                    }

                    ?>
                    <img alt="image" class="rounded-circle" style="width:90px; height:98px;" src="<?= $img ?>" />

                    <h1><?= $pageData['nama'] ?></h1>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Nomor Induk : <?= $pageData['username'] ?></h5>
                    <p class="card-text"> <?= $dataKelas['nama_jenis_kelas'] . ' ' . $dataKelas['jurusan'] . ' ' . $dataKelas['sub_kelas'] . ' :: ' . $dataKelas['deskripsi'] . ' Semester ' . $dataKelas['semester']  ?></p>
                    <a href="<?= site_url('search/') . $dataKelas['id_siswa'] ?>" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <br>

        <div class="ibox-content" style="background-color:#FFFFFF">
            <div id="calendar" class="col-centered">
            </div>
        </div>

    </div>
    <div class="col-lg-12">
        <br>

        <div class="ibox-content" style="background-color:#FFFFFF">
            <h3>HASIL EVALUASI SISWA</h3>
            <!-- </div> -->
            <div class="table-responsive">
                <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
                    <thead>
                        <tr>
                            <th style="width: 15%; text-align:center!important"> Mata Pelajaran :: Guru </th>
                            <th style="width: 12%; text-align:center!important"> Tanggal </th>
                            <th style="width: 12%; text-align:center!important"> Nilai </th>
                            <th style="width: 12%; text-align:center!important"> Evaluasi Guru </th>
                            <!-- <th style="width: 7%; text-align:center!important"></th> -->
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <!-- <div id='hasil' > </div> -->
        <p class="m-t">
            <small style="color: black;">DINAS PENDIDIKAN PROVINSI KEP. BANGKA BELITUNG</small>
        </p>
    </div>
</div>
<br>
<script>
    $(document).ready(function() {

    });
</script>
<script src="<?= base_url() ?>assets/js/fullcalendar/jquery.js"></script>
<script src="<?= base_url() ?>assets/js/fullcalendar/bootstrap.min.js"></script>
<script src='<?= base_url() ?>assets/js/fullcalendar/moment.min.js'></script>
<script src='<?= base_url() ?>assets/js/fullcalendar/fullcalendar.min.js'></script>
<script src="<?= base_url('assets/') ?>js/plugins/dataTables/datatables.min.js"></script>
<script src="<?= base_url('assets/') ?>js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>js/plugins/dataTables/dataTables.rowsGroup.js"></script>
<script>
    $(document).ready(function() {

        var searchForm = $('#searchForm');

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

        getKelas();

        function getKelas() {
            $.ajax({
                url: "<?= site_url() . 'search-mapping' ?>",
                type: "POST",
                data: {
                    id_siswa: <?= $pageData['id_user'] ?>,
                    id_kelas: <?= $id_mapping ?>

                },
                success: (data) => {
                    json = JSON.parse(data);
                    if (json['error']) {
                        swal("Data tidak ditemukan", json['message'], "error");
                        return;
                    }
                    renderSearch(json['data'])
                    console.log(json)
                },
                error: () => {}
            });
        }

        getEvaluasi();

        function getEvaluasi() {
            $.ajax({
                url: "<?= site_url() . 'search-evaluasi' ?>",
                type: "POST",
                data: {
                    id_siswa: <?= $pageData['id_user'] ?>,
                    id_kelas: <?= $id_mapping ?>

                },
                success: (data) => {
                    json = JSON.parse(data);
                    if (json['error']) {
                        swal("Data tidak ditemukan", json['message'], "error");
                        return;
                    }
                    console.log(json)
                    renderEvaluasi(json['data'])
                },
                error: () => {
                    // buttonIdle(submitBtn);
                }
            });
        }

        function renderEvaluasi(data) {
            console.log(data)
            if (data == null || typeof data != "object") {
                console.log("UNKNOWN DATA");
                return;
            }
            var i = 1;
            var renderData = [];
            Object.values(data).forEach((d) => {

                renderData.push([d['nama_mapel'] + " :: " + d['nama_guru'], d['submit_date'], d['nilai'], d['evaluasi']]);
                i++;
            });
            // console.log(renderData)
            // renderCalender(renderData, last_tgl);
            FDataTable.clear().rows.add(renderData).draw('full-hold');
        };


        function renderSearch(data) {

            if (data == null || typeof data != "object") {
                // console.log("UNKNOWN DATA");
                return;
            }
            var i = 1;
            var renderData = [];
            // LayerModal.id_wali_kelas.val()
            Object.values(data).forEach((d) => {
                console.log(d)
                ask = {
                    id: i,
                    title: status(d['status_absensi']),
                    start: d['tgl'],
                    color: statusCol(d['status_absensi']),
                };
                last_tgl = d['tgl'];
                // btn = `<a href="<?= $pageData['id_user'] ?>/${d['id_mapping']}">${d['nama_jenis_kelas']} ${d['jurusan']} ${d['sub_kelas']}</a>`;
                renderData.push(ask);
                i++;
            });
            // console.log(renderData)
            renderCalender(renderData, last_tgl);
            // FDataTable.clear().rows.add(renderData).draw('full-hold');
        };

        function status(status) {
            if (status == '1')
                return `Hadir`;
            else if (status == '2')
                return `Izin`;
            else if (status == '3')
                return `Sakit`;
            else if (status == '4')
                return `Alpa`;
        }

        function statusCol(status) {
            if (status == '1')
                return `#b1eb91`;
            else if (status == '2')
                return `#91c2eb`;
            else if (status == '3')
                return `#f2e58d`;
            else if (status == '4')
                return `#ff9494`;
        }


        function renderCalender(data, last_tgl) {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                defaultDate: last_tgl,
                editable: false,
                eventLimit: false, // allow "more" link when too many events
                selectable: false,
                selectHelper: true,
                select: function(start, end) {

                    $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd').modal('show');
                },

                events: data
            });
        }

    });
</script>
<style>
    #calendar {
        max-width: 800px;
        /* max-height: 100px; */
        padding-left: 10PX;
    }


    #calendar>div.fc-view-container>div>table>tbody>tr>td>div>div>div {
        height: 40px !important;
    }

    a.fc-event {
        color: #393b37 !important;
        font-weight: 900 !important;

        border-collapse: separate !important;
        cursor: pointer !important;
        box-sizing: border-box !important;
        display: inline-block !important;
        padding: 3px 1px 1px 1px !important;
        line-height: 1 !important;
        text-align: center !important;
        vertical-align: baseline !important;
        border-radius: .50rem !important;
        font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        padding-bottom: 4px !important;
        padding-left: 6px !important;
        padding-right: 6px !important;
        text-shadow: none !important;
        white-space: nowrap !important;
        background-color: #1ab394;
        /* color: #FFFFFF !important; */
    }
</style>