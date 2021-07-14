<style>
.zoom {
  padding: 0;
  background-color: transparent;
  transition: transform .2s; /* Animation */
  width: 100%;
  height: auto;
  margin: 0 auto;
}

.zoom:hover {
  transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>


<div class="wrapper wrapper-content animated fadeInRight">

<div class="tabs-container">
            <ul class="nav nav-tabs" role="tablist">
                <li><a class="nav-link active" data-toggle="tab" href="#tab-1">Planning</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-2">Realisasi</a></li>
            </ul>
            <div class="tab-content">
              <div role="tabpanel" id="tab-1" class="tab-pane active">
                <div class="panel-body">
                  <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">

                            <div class="row">
                                <!-- <div class="col-lg-6">
                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <div id="map" style='height: 450px;'></div>
                                        </div>
                                    </div>
                                </div> -->
                                
                                <div class="col-lg-6">
                                    <div class="ibox">
                                        <div class="ibox-content inspinia-timeline">
                                            <div id="detail_event">
                                                
                                                <div class="alert alert-info" role="alert">
                                                    <h4 class="alert-heading" id="nameevent"></h4>
                                                    <p id="deskripsi"></p>
                                                    <p id="alamat"></p>
                                                    <hr>
                                                    <p id="tanggal"></p>
                                                </div>
                                                </br>
                                                <div class="zoom" id='headerphoto'>
                                                    <!-- <img class=""  style="width: 100%"> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="ibox">
                                        <div class="ibox-content inspinia-timeline">
                                            <div id="kalender_pagelaran"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                         </div>
                       </div>
                     </div>
                   </div>
                </div>
              <div role="tabpanel" id="tab-2" class="tab-pane">
                 <div class="panel-body" id="">
                    <div class="form-group col-md-12">

                                <div class="row">
                                <!-- <div class="col-lg-6">
                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <div id="map" style='height: 450px;'></div>
                                        </div>
                                    </div>
                                </div> -->
                                
                                <div class="col-lg-6">
                                    <div class="ibox">
                                        <div class="ibox-content inspinia-timeline">
                                            <div id="detail_event">
                                                
                                               
                                                <div class="alert alert-info" role="alert">
                                                    <h4 class="alert-heading" id="nameevent2"></h4>
                                                    <p id="deskripsi2"></p>
                                                    <p id="alamat2"></p>
                                                    <hr>
                                                    <p id="tanggal2"></p>
                                                </div>
                                                <br>
                                                <div class="zoom" id='headerphoto2'>
                                                    <!-- <img class=""  style="width: 100%"> -->
                                                </div>
                                                <div class="zoom" id='file22'>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="ibox">
                                        <div class="ibox-content inspinia-timeline">
                                            <div id="kalender_pagelaran2"></div>
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

<script>
$(document).ready(function() {
  $('#kalender').addClass('active');
  
  var map;
 // var dataPagelaran;
  //initMap();
  function initMap() {
    -2.571937, 106.810016
    var myLatLng = {lat: -2.271937, lng: 106.810016};
    var tmp3 = {};
      map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8.2,
      center: myLatLng
    });
      
  }
  function initMap2(lokasi,nama,color){
              //  var tmp = lokasi;
                var tmp1  = lokasi.split(",");
                //var_dump(tmp[0]);
              var myLatlng2 = new google.maps.LatLng(tmp1[0],tmp1[1]);
              addMarker(map,myLatlng2,nama,color);
 }

    function addMarker(map,loc,name,color){
      
      let url = "http://maps.google.com/mapheaderphotos/ms/icons/";
      url += color + "-dot.png";
      var marker = new google.maps.Marker({
      position: loc,
      title: name,
      map: map,
      icon: {
      url: url
    }
    });
  }
    var dataPagelaran = {};
    var dataPagelaran2 = {};
    getPagelaran();
    function getPagelaran(){ 
    $.ajax({
              url: `<?=site_url('KalenderController/getPagelaran')?>`, 'type': 'GET',
              data: {},
              success: function (data){
                var json = JSON.parse(data);              
                dataPagelaran = json['data'];
                renderPagelaran();
                renderDetail(0);
              },
             error: function(e) {}
      });    
    }

    getPagelaran2();
    function getPagelaran2(){ 
    $.ajax({
              url: `<?=site_url('KalenderController/getPagelaran2')?>`, 'type': 'GET',
              data: {},
              success: function (data){
                var json = JSON.parse(data);              
                dataPagelaran2 = json['data'];
                renderPagelaran2();
                renderDetail2(0);
              },
             error: function(e) {}
      });    
    }
    function renderDetail(row){
        console.log(dataPagelaran[row])
       // console.log(row);
       if(!empty(dataPagelaran2[row]['file'])){
            
            document.getElementById("headerphoto").innerHTML = `<img src="<?= base_url('upload/file2/')?>${dataPagelaran2[row]['file']}" id='' style="width: 100%">`
                console.log('ada foto',d)
            
        }else{
            document.getElementById("headerphoto").innerHTML = ' '
        }
        document.getElementById('nameevent').innerHTML = `${dataPagelaran[row]['nama']} !!`;
        document.getElementById('deskripsi').innerHTML = `${dataPagelaran[row]['deskripsi']} `;
        document.getElementById('alamat').innerHTML = `${dataPagelaran[row]['alamat']} `;
        document.getElementById('tanggal').innerHTML = `Save the date!! ${dataPagelaran[row]['tanggal_kegiatan']} `;
        
    }
    function renderPagelaran(){
        tmpPagelaran = "";
        i=0;
        Object.values(dataPagelaran).forEach((d) => {
            //initMap2(d['lokasi'],d['nama'],'red')
            console.log('lokasi =',d['lokasi'],d['nama'] )
            tmpPagelaran +=`
            <div class="timeline-item">
                <div class="row">
                    <div class="col-4 date">
                        <i class="fa fa-calendar"></i>
                        ${d['tanggal_kegiatan']}
                        <br>
                        <small class="text-navy">${d['nama_kabupaten']}</small>
                    </div>
                    
                    <div id="hover${i}" class="col content" href="google.com">
                        <p class="m-b-xs"><strong>${d['nama_jenis_pagelaran']} ${d['nama']}</strong></p>
                        <p>
                            ${d['deskripsi']}
                        </p>
                        <p>
                            ${d['alamat']} - <a href="https://www.google.com/maps/@${d['lokasi']},10z" target="_blank">Google Map</a>
                         </p>
                        <p>
                            
                        </p>
                    </div>
                </div>
            </div>
            `;
            i++;
        });
        var pagelaran = document.getElementById('kalender_pagelaran') 
        pagelaran.innerHTML = tmpPagelaran;
        i=0;
        dataPagelaran.forEach((d) => {
            //console.log('i ke',i)
            document.getElementById("hover"+String(i)).onclick = function() { 
                console.log("Render ke",d['nomor']-1)
                renderDetail(Number(d['nomor'])-Number(1))
            };
          i++;
        });

    }

    function renderDetail2(row){
        console.log(dataPagelaran[row])
      
        if(!empty(dataPagelaran2[row]['file'])){
            
            document.getElementById("headerphoto2").innerHTML = `<img src="<?= base_url('upload/file2/')?>${dataPagelaran2[row]['file']}" id='' style="width: 100%">`
                console.log('ada foto',d)
            
        }else{
            document.getElementById("headerphoto2").innerHTML = ' '
        }
        document.getElementById('nameevent2').innerHTML = `${dataPagelaran2[row]['nama']} !!`;
        document.getElementById('deskripsi2').innerHTML = `${dataPagelaran2[row]['deskripsi']} `;
        document.getElementById('alamat2').innerHTML = `${dataPagelaran2[row]['alamat']} `;
        document.getElementById('tanggal2').innerHTML = `Save the date!! ${dataPagelaran2[row]['tanggal_kegiatan']} `;
         
        img2HTML = ``;
        if(!empty(dataPagelaran2[row]['file2'])){
            imgtmpp=dataPagelaran2[row]['file2'].split(",");
            imgtmpp.forEach((d) => {
                img2HTML += `<img src="<?= base_url('upload/file2/')?>${d}" id='' style="width: 100%">`
                console.log('ada foto',d)
            });
            
        }
        document.getElementById('file22').innerHTML =img2HTML;
    }
    function renderPagelaran2(){
        tmpPagelaran = "";
        i=0;
        Object.values(dataPagelaran2).forEach((d) => {
          //  initMap2(d['lokasi'],d['nama'],'red')
            console.log('lokasi =',d['lokasi'],d['nama'] )
            tmpPagelaran +=`
            <div class="timeline-item">
                <div class="row">
                    <div class="col-4 date">
                        <i class="fa fa-calendar"></i>
                        ${d['tanggal_kegiatan']}
                        <br>
                        <small class="text-navy">${d['nama_kabupaten']}</small>
                    </div>
                    <div id="hover_${i}" class="col content" href="google.com">
                        <p class="m-b-xs"><strong>${d['nama_jenis_pagelaran']} ${d['nama']}</strong></p>
                        <p>
                            ${d['deskripsi']}
                        </p>
                        <p>
                            ${d['alamat']} - <a href="https://www.google.com/maps/@${d['lokasi']},10z" target="_blank">Google Map</a>
                         </p>
                        <p>
                            
                        </p>
                    </div>
                </div>
            </div>
            `;
            i++;
        });
        var pagelaran = document.getElementById('kalender_pagelaran2') 
        pagelaran.innerHTML = tmpPagelaran;
        i=0;
        dataPagelaran2.forEach((d) => {
            //console.log('i ke',i)
            document.getElementById("hover_"+String(i)).onclick = function() { 
                renderDetail2(Number(d['nomor'])-Number(1))
            };
          i++;
        });

    }
}); 
</script>