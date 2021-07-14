<div class="container">
    <br>

    <div class="wrapperwrapper-content animated fadeInRight">
        <div class="ibox section-container">
            <div class="ibox-content">
                <form class="form-inline" id="toolbar_form" onsubmit="return false;">
                    <select class="form-control mr-sm-2" name="id_mapping" id="id_mapping"></select>

                    <!-- <button type="submit" class="btn btn-success my-1 mr-sm-2" id="show_btn" data-loading-text="Loading..." onclick="this.form.target='show'"><i class="fal fa-eye"></i> Tampilkan</button> -->
                    <!-- <button hidden type="submit" class="btn btn-primary my-1 mr-sm-2" id="add_btn" data-loading-text="Loading..." onclick="this.form.target='add'"><i class="fal fa-plus"></i> Tambah</button> -->
                    <!-- <a type="" class="btn btn-light my-1 mr-sm-2" id="export_btn" data-loading-text="Loading..."><i class="fal fa-download"></i> Export PDF</a> -->

                </form>
            </div>
        </div>

        <div class="ibox section-container">
            <div class="ibox-content">
                <div class="table-responsive">
                    <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
                        <thead>
                            <tr>
                                <th style="width: 15%; text-align:center!important">Kelas</th>
                                <th style="width: 15%; text-align:center!important">Nama Guru</th>
                                <th style="width: 12%; text-align:center!important">Mata Pelajaran </th>
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


<script>
    $(document).ready(function() {
        $('#forum_saya').addClass('active');
        var toolbar = {
            'form': $('#toolbar_form'),
            'id_mapping': $('#id_mapping'),
            'addBtn': $('#show_btn'),
        }

        var FDataTable = $('#FDataTable').DataTable({
            'columnDefs': [],
            deferRender: true,
            "order": [
                [0, "desc"]
            ]
        });

        getAllTahunPelajaran();

        function getAllMapping() {
            return $.ajax({
                url: `<?php echo site_url('SiswaController/GetForumSaya/') ?>`,
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



        function renderMapping(data) {
            if (data == null || typeof data != "object") {
                console.log("Mapel::UNKNOWN DATA");
                return;
            }

            var i = 0;

            var renderData = [];
            Object.values(data).forEach((mapel) => {

                button = `<a class="detail active btn btn-success btn-sm" href='<?= site_url() ?>SiswaController/forum?id_mapping_kelas=${mapel['id_mapping_kelas']}'><i class='fa fa-angle-double-right'> Detail </i></a>`

                renderData.push([mapel['kelas'] + ' ' + mapel['nama_jenis_jurusan'] + ' ' + mapel['sub_kelas'], mapel['nama_guru'] , mapel['nama_mapel'], button]);
            });
            FDataTable.clear().rows.add(renderData).draw('full-hold');
        }

       

        function getAllTahunPelajaran() {
            return $.ajax({
                url: `<?php echo site_url('SiswaController/getKelasSaya/') ?>`,
                'type': 'GET',
                data: {},
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json['error']) {
                        return;
                    }
                    dataTA = json['data'];
                    renderTA(dataTA);
                    getAllMapping()
                },
                error: function(e) {}
            });
        }

        function renderTA(data) {
            // toolbar.id_mapping

            toolbar.id_mapping.empty();
            // toolbar.id_mapping.append($('<option>', {
            //     value: "",
            //     text: "-- Pilih Tahun Ajaran --"
            // }));
            Object.values(data).forEach((d) => {
                console.log(d)
                toolbar.id_mapping.append($('<option>', {
                    value: d['id_mapping'],
                    text:  d['nama_jenis_kelas'] + ' ' + d['nama_jenis_jurusan'] + ' ' + d['sub_kelas'] + ' / ' + d['deskripsi'] + ' :: Semester ' + d['semester'],
                }));
            });

        }

        toolbar.id_mapping.on('change', function() {
            getAllMapping();
        });
    });
</script>