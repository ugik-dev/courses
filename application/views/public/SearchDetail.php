<div class="col-md-12">

  <div class="ibox-content" style="background-color:#FFFFFF">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url('search') ?>">Search</a></li>
        <li class="breadcrumb-item"><a href=""> <?= $pageData['nama'] ?></a></li>
      </ol>
    </nav>
    <br>
    <div class="card">
      <div class="card-header">
        <h1><?= $pageData['nama'] ?></h1>
      </div>
      <div class="card-body">
        <h5 class="card-title">Nomor Induk : <?= $pageData['username'] ?></h5>
        <a href="<?= site_url('search') ?>" class="btn btn-primary">Kembali</a>
      </div>
    </div>
    <div class="table-responsive">
      <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
        <thead>
          <tr>
            <th style="width: 15%; text-align:center!important">Kelas</th>
            <th style="width: 12%; text-align:center!important">Tahun Ajaran</th>
            <!-- <th style="width: 7%; text-align:center!important"></th> -->
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <p class="m-t">
      <small style="color: black;">DINAS PENDIDIKAN PROVINSI KEP. BANGKA BELITUNG</small>
    </p>
  </div>
</div>
<br>

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
        url: "<?= site_url() . 'search-kelas' ?>",
        type: "POST",
        data: {
          id: <?= $pageData['id_user'] ?>
        },
        success: (data) => {
          // buttonIdle(submitBtn);
          json = JSON.parse(data);
          if (json['error']) {
            swal("Data tidak ditemukan", json['message'], "error");
            return;
          }
          renderSearch(json['data'])
          console.log(json)
        },
        error: () => {
          // buttonIdle(submitBtn);
        }
      });
    }

    function renderSearch(data) {

      if (data == null || typeof data != "object") {
        // console.log("UNKNOWN DATA");
        return;
      }
      var i = 0;
      var renderData = [];
      // LayerModal.id_wali_kelas.val()
      Object.values(data).forEach((d) => {
        btn = `<a href="<?= $pageData['id_user'] ?>/${d['id_mapping']}">${d['nama_jenis_kelas']} ${d['jurusan']} ${d['sub_kelas']}</a>`;
        renderData.push([btn, d['deskripsi'] + ' :: Semester ' + d['semester']]);
        // i++;
      });
      FDataTable.clear().rows.add(renderData).draw('full-hold');
    };
  });
</script>