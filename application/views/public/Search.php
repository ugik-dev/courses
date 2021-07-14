
<div class="col-md-12">

  <div class="ibox-content" style="background-color:#FFFFFF">
    <h3 style="color: black;">Cari Siswa</h3>
    <form id="searchForm" class="form-inline my-2 my-lg-0">
      <!-- required="required" -->
      <input class="form-control mr-sm-2 col-md-6" type="search" placeholder="Search" name="search" aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-2" type="submit"><i class="fa fa-search"></i> Search</button>
    </form>
    <div class="table-responsive">
      <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
        <thead>
          <tr>
            <th style="width: 15%; text-align:center!important">Nama</th>
            <th style="width: 12%; text-align:center!important">Nomor Induk </th>
            <!-- <th style="width: 7%; text-align:center!important"></th> -->
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <!-- <div id='hasil' > </div> -->
    <p class="m-t">
      <small style="color: black;">DINAS PENDIDIKAN PROVINSI KEP. BANGKA BELITUNG</small>
    </p>
  </div>



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

      searchForm.on('submit', (ev) => {
        // swal("Data Tidak Ada", 'as', "error");
        ev.preventDefault();
        // buttonLoading(submitBtn);
        $.ajax({
          url: "<?= site_url() . 'search-process' ?>",
          type: "POST",
          data: searchForm.serialize(),
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
      });

      function renderSearch(data) {

        if (data == null || typeof data != "object") {
          // console.log("UNKNOWN DATA");
          return;
        }
        var i = 0;
        var renderData = [];
        // LayerModal.id_wali_kelas.val()
        Object.values(data).forEach((d) => {
          btn = `<a href="search/${d['id_user']}" data-id_mapping_siswa="${d['id_user']}">${d['nama']}</a>`;
          renderData.push([btn, d['username']]);
          // i++;
        });
        FDataTable.clear().rows.add(renderData).draw('full-hold');
      };


    });
  </script>
  <style>
   
    .background_login {
      position: absolute;
      height: 100%;
      top: 0;
      left: 0;
      z-index: 0;
      width: 100%;
      background-position: center;
      background-size: cover;
    }

    .shadowed {
      text-shadow: 2px 2px 1px #000000;
      color: #fff;
    }

    .logo-logo {
      margin: 30px;
      background-color: #ffffff;
      border: 1px solid black;
      opacity: 0.6;
      filter: alpha(opacity=60);
      /* For IE8 and earlier */
    }

    .head-school .desk {
      width: 100%;
      max-width: 800px !important;
      max-height: 80px;
      padding: -10px -90px -30px -10px;
      margin-left: -90px !important;
    }

    .head-school .desk .display-6 {
      width: 100%;
      max-width: 800px;
      max-height: 80px;
      margin-top: -5px;
      margin: -10px 2px -9px 0px !important;
      font-size: 20px !important;
    }

    .head-school .logo {
      width: 100%;
      margin: 1px;
      margin-bottom: 20px;
      width: auto !important;
      max-height: 100px;
      padding: -10px -12px 15px -15px;
      /* padding-bottom: -15 !important; */
    }


    @media (max-width: 369px) and (min-width: 100px) {
      .head-school .logo {
        width: 100%;
        margin: 1px;
        margin-bottom: 20px;
        width: 60px !important;
        max-height: 80px;
        padding: -10px -12px 15px -15px;
        /* padding-bottom: -15 !important; */
      }

      /* .jumbotron {
    background-size: cover;
    height: 250px;
    width : 250px;
    border-radius: 0px;
    padding: 30px;
  } */

      .head-school .desk {
        width: 100%;
        max-width: 250px !important;
        max-height: 80px;
        padding: -10px -12px -30px -10px;
        margin-left: 10px !important;
        /* margin: 0px 40px 15px -15px; */

        /* font-size: 10px !important; */
      }

      .head-school .desk .display-4 {
        width: 100%;
        max-width: 220px;
        max-height: 80px;
        font-size: 23px !important;
        /* padding: 0px 0px 0px 0px;
    margin: 0px 40px 15px -15px !important; */

      }

      .head-school .desk .display-6 {
        width: 100%;
        max-width: 220px;
        max-height: 80px;
        margin-top: 1px;
        /* padding: 0px 0px 0px 0px !important; */
        margin: -10px 2px -9px 0px !important;
        font-size: 12px !important;
        line-height: 24px !important;
        font: 0px !important;

      }

      .container {
        margin: -15px -15px -15px -15px;
        width: 310px;
        padding: 0px 0px 0px 0px;
      }

    }

    @media (max-width: 1000px) and (min-width: 801px) {
      .head-school .logo {
        width: 100%;
        margin: 1px;
        margin-bottom: 20px;
        width: 60px !important;
        max-height: 80px !important;
        padding: -10px -12px 15px -15px;
      }

      .head-school .desk {
        width: 100%;
        max-width: 700px !important;
        max-height: 80px;
        padding: -10px -12px -30px -10px;
        margin-left: -40px !important;
      }

      .head-school .desk .display-4 {
        width: 100%;
        max-width: 700px;
        max-height: 80px;
        font-size: 34px !important;

      }

    }

   
  </style>
