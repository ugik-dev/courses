<div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
              <thead>
                <tr>
                  <th style="width: 7%; text-align:center!important">ID</th>
                  <th style="width: 15%; text-align:center!important">Nama Cagarbudaya</th>
                  <th style="width: 12%; text-align:center!important">Jenis Cagarbudaya</th>
                  <th style="width: 12%; text-align:center!important">Kepemilikan</th>
                  <th style="width: 12%; text-align:center!important">Status Penetapan</th>
                  <th style="width: 12%; text-align:center!important">File</th>
                  <th style="width: 12%; text-align:center!important">Lokasi</th>
                  <th style="width: 10%; text-align:center!important">Deskripsi</th>
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

    
  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [],
    deferRender: true,
    "order": [[ 0, "desc" ]]
  });


  function renderCagarbudaya(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }

    
    var i = 0;
    var renderData = [];
    Object.values(data).forEach((cagarbudaya) => {
      renderData.push([cagarbudaya['id_cagarbudaya'], cagarbudaya['nama'], cagarbudaya['nama_jenis_cagarbudaya'], cagarbudaya['nama_kepemilikan_cagarbudaya'], cagarbudaya['nama_status_penetapan_cagarbudaya'],cagarbudaya['file'],cagarbudaya['lokasi'],cagarbudaya['deskripsi']]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }
