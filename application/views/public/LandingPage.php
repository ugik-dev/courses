<div id="inSlider" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#inSlider" data-slide-to="0" class="active"></li>
    <li data-target="#inSlider" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <div class="container">
        <div class="carousel-caption">
          <h1>We help manage<br />
            Goverment Export<br />
            documents<br />
            <p>-</p>
            <!-- <p>
                        <a class="btn btn-lg btn-primary" href="#" role="button">READ MORE</a>
                        <a class="caption-link" href="#" role="button">-</a>
                    </p> -->
        </div>
      </div>
      <!-- Set background for slide in css -->
      <div class="header-back" style="background-image:url(<?= base_url('assets/img/slideshow_1.jpg') ?>)"></div>
    </div>
    <div class="carousel-item">
      <div class="container">
        <div class="carousel-caption blank">
          <h1>We help distribute <br /> pepper exports <br> around the World.</h1>
          <p>Export consultant, Pepper Marketing and Pepper Packing</p>
          <!-- <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p> -->
        </div>
      </div>
      <!-- Set background for slide in css -->
      <div class="header-back" style="background-image:url(<?= base_url('assets/img/slideshow_2.jpg') ?>)"></div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#inSlider" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#inSlider" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<section id="info" class="container">
  <div class="row">
    <div class="col-lg-12 text-center">
      <div class="navy-line"></div>
      <?php if (!empty($_COOKIE['lang_set']) && $_COOKIE['lang_set'] == 'en') {
        echo "<h1>Muntok White Pepper Pricing</h1>
        <p>Today, <span id='current_date'></span></p>";
      } else {
        echo "<h1>Harga Muntok White Pepper</h1>
        <p>Hari ini, <span id='current_date'></span></p>";
      } ?>

    </div>
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <div class="table-responsive">
            <table id="HargaMWPTable" class="table table-bordered stripe" style="padding:0px">
              <thead>
                <tr>
                  <?php if (!empty($_COOKIE['lang_set']) && $_COOKIE['lang_set'] == 'en') {
                    echo "  <th style='width: 40%;'>Quality</th>
                    <th style='width: 30%;'>Farmer</th>
                    <th style='width: 30%;'>Free on Board</th>";
                  } else {
                    echo "  <th style='width: 40%;'>Kualitas</th>
                    <th style='width: 30%;'>Petani</th>
                    <th style='width: 30%;'>Free on Board</th>";
                  } ?>


                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section id="news" class="gray-section p-w-x">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="navy-line"></div>
        <h1> <?php if (!empty($_COOKIE['lang_set']) && $_COOKIE['lang_set'] == 'en') {
                echo "News";
              } else {
                echo "Berita";
              } ?></h1>
      </div>
      <div class="col-lg-12 m-b-xl" id="news-list"></div>
      <!-- <div class="row">
          <div class="col-lg-6 text-center m-b-xl">
            <p>Webinar</p>
          </div>
          <div class="col-lg-6 text-center m-b-xl">
            <p>Rundown Webinar</p>
            <p>International Marketing Strategy of Muntok White Papper Through Commodity Physical Market</p>
            <p>Tuesday, July 28, 2020 13:30-15:30 Jakarta</p>
          </div>
          
      </div> -->
      <div class="col-lg-12 text-center m-b-xl">
        <a href="<?= site_url('news') ?>" class="btn btn-primary">
          <?php if (!empty($_COOKIE['lang_set']) && $_COOKIE['lang_set'] == 'en') {
            echo "More News";
          } else {
            echo "Berita Lain";
          } ?></a>
      </div>
    </div>
  </div>
</section>

<section id="info" class="container">
  <div class="row">
    <div class="col-lg-12 text-center">
      <div class="navy-line"></div>
      <h1>Standart Mutu</h1>

    </div>
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <div class="table-responsive">
            <table id="StandarMutuTable" class="table table-bordered stripe" style="padding:0px">
              <thead>
                <tr>
                  <th style="width: 20%;">Parameter </th>
                  <th style="width: 10%;">SNI I</th>
                  <th style="width: 10%;">SNI II</th>
                  <th style="width: 10%;">ASTA</th>
                  <th style="width: 10%;">ESA</th>
                  <th style="width: 10%;">IPC</th>
                  <th style="width: 10%;">ISO</th>
                  <th style="width: 10%;">MWP 1</th>
                  <th style="width: 10%;">MWP 2</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="features" class="container features ">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="navy-line"></div>
        <h1><?php if (!empty($_COOKIE['lang_set']) && $_COOKIE['lang_set'] == 'en') {
              echo "What We Do";
            } else {
              echo "Tentang Kami";
            } ?></h1>
        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-5 col-lg-offset-1 features-text">
        <!-- <small>Kantor Pemasaran Bersama Lada Babel</small> -->
        <h2>
          <?php if (!empty($_COOKIE['lang_set']) && $_COOKIE['lang_set'] == 'en') {
            echo "Help Manage Goverment Export Documents";
          } else {
            echo "Membantu Pemerintahan dalam Dokumentasi Ekport";
          } ?></h2>
        <i class="fa fa-cabinet-filing big-icon float-right"></i>
        <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
      </div>
      <div class="col-lg-5 features-text">
        <!-- <small>Kantor Pemasaran Bersama Lada Babel</small> -->
        <h2>Export Consultant </h2>
        <i class="fa fa-university big-icon float-right"></i>
        <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-5 col-lg-offset-1 features-text">
        <!-- <small>Kantor Pemasaran Bersama Lada Babel</small> -->
        <h2>Pepper Marketing </h2>
        <i class="fa fa-users big-icon float-right"></i>
        <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
      </div>
      <div class="col-lg-5 features-text">
        <!-- <small>Kantor Pemasaran Bersama Lada Babel</small> -->
        <h2>Pepper Packing </h2>
        <i class="fa fa-boxes big-icon float-right"></i>
        <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
      </div>
    </div>
  </div>

</section>

<section id="partners" class="gray-section">
  <div class="container">
    <div class="row m-b-lg">
      <div class="col-lg-12 text-center">
        <div class="navy-line"></div>
        <h1> <?php if (!empty($_COOKIE['lang_set']) && $_COOKIE['lang_set'] == 'en') {
                echo "Our Partners";
              } else {
                echo "Patner Kami";
              } ?>
        </h1>
        <p>We, with our partner, intend to make your export bussiness go smoothly</p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4 wow fadeInLeft">
        <div class="team-member">
          <h4><span class="navy">Disperindag</span> Kep. Babel</h4>
          <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus. </p>
          <li class="list-inline">
          <li class="list-inline-item"><a href="http://perindag.babelprov.go.id/"><i class="fa fa-link"></i> Website</a></li>
          </li>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="team-member wow zoomIn">
          <h4><span class="navy">Balai Pengujian </span>Mutu</h4>
          <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.</p>
          <li class="list-inline">
          <li class="list-inline-item"><a href="#"><i class="fa fa-link"></i> Website</a></li>
          </li>
        </div>
      </div>
      <div class="col-sm-4 wow fadeInRight">
        <div class="team-member">
          <h4><span class="navy">Balai</span> Karantina</h4>
          <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.</p>
          <li class="list-inline">
          <li class="list-inline-item"><a href="#"><i class="fa fa-link"></i> Website</a></li>
          </li>
        </div>
      </div>
      <div class="col-sm-3 wow fadeInLeft">
        <div class="team-member">
          <h4><span class="navy">BP</span>3L</h4>
          <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus. </p>
          <li class="list-inline">
          <li class="list-inline-item"><a href="#"><i class="fa fa-link"></i> Website</a></li>
          </li>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="team-member wow zoomIn">
          <h4><span class="navy">KS</span>OP</h4>
          <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.</p>
          <li class="list-inline">
          <li class="list-inline-item"><a href="#"><i class="fa fa-link"></i> Website</a></li>
          </li>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="team-member">
          <h4><span class="navy">Bea</span> Cukai</h4>
          <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.</p>
          <li class="list-inline">
          <li class="list-inline-item"><a href="#"><i class="fa fa-link"></i> Website</a></li>
          </li>
        </div>
      </div>
      <div class="col-sm-3 wow fadeInRight">
        <div class="team-member">
          <h4><span class="navy">Bursa</span> Komoditi</h4>
          <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.</p>
          <li class="list-inline">
          <li class="list-inline-item"><a href="#"><i class="fa fa-link"></i> Website</a></li>
          </li>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 text-center m-t-lg m-b-lg">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
      </div>
    </div>
  </div>
</section>

<section id="products" class="container">
  <div class="row">
    <div class="col-lg-12 text-center">
      <div class="navy-line"></div>
      <?php if (!empty($_COOKIE['lang_set']) && $_COOKIE['lang_set'] == 'en') {
        echo "<h1>Products</h1>
            <p>Some of the products from our customers</p>
          </div>
          <div class='row' id='product-list'></div>
          <div class='col-lg-12 text-center m-b-xl'>
   ";
      } else {
        echo "<h1>Produk</h1>
        <p>Beberapa Produk dari customer kami</p>
      </div>
      <div class='row' id='product-list'></div>
      <div class='col-lg-12 text-center m-b-xl'>
  ";
      } ?>
      <a href='<?= site_url('products') ?>' class='btn btn-primary'>
        <?php if (!empty($_COOKIE['lang_set']) && $_COOKIE['lang_set'] == 'en') {
          echo "More Products";
        } else {
          echo "Produk Lain";
        } ?></a>
    </div>
  </div>
</section>
<!-- 
<section id="news" class="container">
		<div class="row">
				<div class="col-lg-12 text-center">
						<div class="navy-line"></div>
						<h1>News</h1>
						<p>Blog, Events, Announcement and Daily Dose of Peppers Facts</p>
				</div>
		</div>
    <div class="row">
        <div class="col-sm-3">
            <h2>Full responsive</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            <p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
        </div>
        <div class="col-sm-3">
            <h2>LESS/SASS Files</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            <p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
        </div>
        <div class="col-sm-3">
            <h2>6 Charts Library</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            <p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
        </div>
        <div class="col-sm-3">
            <h2>Advanced Forms</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            <p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
        </div>
    </div>
</section> -->

<section id="contact" class="gray-section contact">
  <div class="container">
    <div class="row m-b-lg">
      <div class="col-lg-12 text-center">
        <div class="navy-line"></div>
        <h1> <?php if (!empty($_COOKIE['lang_set']) && $_COOKIE['lang_set'] == 'en') {
                echo "Contact Us";
              } else {
                echo "Kontak Kami";
              } ?></h1>
        <!-- <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p> -->
      </div>
    </div>
    <div class="row m-b-lg justify-content-center">
      <div class="col-lg-6 " style="text-align:center">
        <address>
          <strong><span class="navy">Kantor Pemasaran Lada Provinsi Kepulauan Babel</span></strong><br />
          Jl. Pulau Bangka Kompleks Perkantoran Pemprov Babel, Ruko City Hall, Blok l-10<br />
          Kota Pangkalpinang, Provinsi Kepulauan Bangka Belitung<br />
          <abbr title="Phone / Whatsapp"><i class="fab fa-whatsapp"></i></abbr> (0717) 911-2105
        </address>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 text-center">
        <a href="mailto:muntokwhitepepper@kpbladababel.com" class="btn btn-primary">Send us mail</a>
        <p class="m-t-sm">
          Or follow us on social platform
        </p>
        <li class="list-inline social-icon">
        <li class="list-inline-item"><a href="https://www.twitter.com/kpblada"><i class="fab fa-twitter"></i></a>
        </li>
        <li class="list-inline-item"><a href="https://www.facebook.com/kpbladababel"><i class="fab fa-facebook"></i></a>
        </li>
        <li class="list-inline-item"><a href="https://www.instagram.com/kpb.ladababel"><i class="fab fa-instagram"></i></a>
        </li>
        </li>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 text-center m-t-lg m-b-lg">
        <p><strong>&copy; 2020 Kantor Pemasaran Lada Provinsi Kepulauan Babel</strong><br /> All rights reserved</p>
      </div>
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    var lang = <?php if (!empty($_COOKIE['lang_set']) && $_COOKIE['lang_set'] == 'en') {
                  echo "'en'";
                } else {
                  echo "'in'";
                } ?>;
    var product_list = $('#product-list');
    var news_list = $('#news-list');
    var current_date = $('#current_date');
    //	<li><a class="nav-link page-scroll" href="#partners">Partners</a></li>

    current_date.html(new Date().toLocaleDateString());
    if (lang == 'en') {
      $('#navbar-item').html(`
        <li><a class="nav-link page-scroll" href="#features">What We Do</a></li>
        <li><a class="nav-link page-scroll" href="#products">Products</a></li>
        <li><a class="nav-link page-scroll" href="#news">News</a></li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class='fa fa-shopping-cart'></i> Trading
            </a>
            <div class="dropdown-menu bg-primary" >
            <a class='nav-link page-scroll' style="width: 200px" href="http://mpms.kpbladababel.com/trading">TRADING BURSA LADA</a>
            <a class='nav-link page-scroll' style="width: 200px" href="http://pss.kpbladababel.com">SHIPPING & REPORT</a> 
            </div>
        </li>
        <li><a class="nav-link page-scroll" href="#contact">Contact</a></li>
        
        <li><a class='nav-link page-scroll' href="<?= site_url('login') ?>"><i class='fa fa-sign-in'></i>Login | Registration</a></li>
        <li><a class="nav-link page-scroll" href="#in" id='lang_in' >in</a></li>
        <li><a class="nav-link page-scroll active" href="#en" id='lang_en' >en</a></li>               
                  
      `)
    } else {
      $('#navbar-item').html(`
        <li><a class="nav-link page-scroll" href="#features">Tentang Kami</a></li>
        <li><a class="nav-link page-scroll" href="#products">Produk</a></li>
        <li><a class="nav-link page-scroll" href="#news">Berita</a></li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class='fa fa-shopping-cart'></i> TRADING
            </a>
            <div class="dropdown-menu bg-primary" >
            <a class='nav-link page-scroll' style="width: 200px" href="http://mpms.kpbladababel.com/trading">PASAR BURSA LADA</a>
            <a class='nav-link page-scroll' style="width: 200px" href="http://pss.kpbladababel.com">SHIPPING & LAPORAN</a> 
            </div>
        </li>
        <li><a class="nav-link page-scroll" href="#contact">Kontak</a></li>
        
        <li><a class='nav-link page-scroll' href="<?= site_url('login') ?>"><i class='fa fa-sign-in'></i>Masuk | Daftar</a></li>
        <li><a class="nav-link page-scroll active" href="#in" id='lang_in' >in</a></li>
        <li><a class="nav-link page-scroll" href="#en" id='lang_en' >en</a></li>               
                  
      `)
    };

    // <li><a class="nav-link page-scroll" href="#features">What We Do</a></li>
    // 	<li><a class="nav-link page-scroll" href="#products">Products</a></li>
    // 	<li><a class="nav-link page-scroll" href="#news">News</a></li>
    // 	<li><a class="nav-link page-scroll" href="#contact">Contact</a></li>
    //   <li><a class='nav-link page-scroll' href="http://mpms.kpbladababel.com/trading"><i class='fa fa-shopping-cart'></i> TRADING BURSA LADA</a></li>
    //   <li><a class='nav-link page-scroll' href="http://pss.kpbladababel.com"><i class='fa fa-archive'></i> SHIPPING & REPORT</a></li>
    //   <li><a class='nav-link page-scroll' href="<?= site_url('login') ?>"><i class='fa fa-sign-in'></i> IG MWP & LAB</a></li>

    var dataProduct = {}
    var dataNews = {}

    initNavbar(200);
    $.when(getLatestHargaMWP(), getStandarMutu(), getAllProduct(), getAllNews()).then((e) => {}).fail((e) => {
      console.log(e)
    });

    var HargaMWPTable = $('#HargaMWPTable').DataTable({
      'columnDefs': [{
        targets: [0, 1, 2],
        className: 'text-center'
      }],
      deferRender: true,
      "ordering": false,
      "dom": "t"
    });

    var StandarMutuTable = $('#StandarMutuTable').DataTable({
      'columnDefs': [{
        targets: [0, 1, 2],
        className: 'text-center'
      }],
      deferRender: true,
      "ordering": false,
      "dom": "t"
    });

    function getLatestHargaMWP() {
      swal({
        title: 'Loading harga_mwp...',
        allowOutsideClick: false
      });
      swal.showLoading();
      return $.ajax({
        url: `<?php echo site_url('HargaMWPController/getLatest/') ?>`,
        'type': 'GET',
        data: {},
        success: function(data) {
          swal.close();
          var json = JSON.parse(data);
          if (json['error']) {
            return;
          }
          dataHargaMWP = json['data'];
          renderHargaMWP(dataHargaMWP);
        },
        error: function(e) {}
      });
    }

    function getStandarMutu() {
      swal({
        title: 'Loading standar_mutu...',
        allowOutsideClick: false
      });
      swal.showLoading();
      return $.ajax({
        url: `<?php echo site_url('HargaMWPController/getStandarMutu/') ?>`,
        'type': 'GET',
        data: {},
        success: function(data) {
          swal.close();
          var json = JSON.parse(data);
          if (json['error']) {
            return;
          }
          dataStandarMutu = json['data'];
          renderStandarMutu(dataStandarMutu);
        },
        error: function(e) {}
      });
    }


    function renderHargaMWP(data) {
      if (data == null || typeof data != "object") {
        console.log("HargaMWP::UNKNOWN DATA");
        return;
      }
      var i = 0;

      var renderData = [];

      renderData.push(["MWP1", "Rp " + dataHargaMWP['harga_mwp1_petani'] + ' || USD ' + dataHargaMWP['d_harga_mwp1_petani'], "Rp " + dataHargaMWP['harga_mwp1_fob'] + ' || USD ' + dataHargaMWP['d_harga_mwp1_fob']]);
      renderData.push(["MWP2", "Rp " + dataHargaMWP['harga_mwp2_petani'] + ' || USD ' + dataHargaMWP['d_harga_mwp2_petani'], "Rp" + dataHargaMWP['harga_mwp2_fob'] + ' || USD ' + dataHargaMWP['d_harga_mwp2_fob']]);
      renderData.push(["ASTA", "Rp " + dataHargaMWP['harga_asta_petani'] + ' || USD ' + dataHargaMWP['d_harga_asta_petani'], "Rp" + dataHargaMWP['harga_asta_fob'] + ' || USD ' + dataHargaMWP['d_harga_asta_fob']]);
      renderData.push(["ESA", "Rp " + dataHargaMWP['harga_esa_petani'] + ' || USD ' + dataHargaMWP['d_harga_esa_petani'], "Rp" + dataHargaMWP['harga_esa_fob'] + ' || USD ' + dataHargaMWP['d_harga_esa_fob']]);
      renderData.push(["IPC", "Rp " + dataHargaMWP['harga_ipc_petani'] + ' || USD ' + dataHargaMWP['d_harga_ipc_petani'], "Rp" + dataHargaMWP['harga_ipc_fob'] + ' || USD ' + dataHargaMWP['d_harga_ipc_fob']]);
      renderData.push(["SNI1", "Rp " + dataHargaMWP['harga_sni1_petani'] + ' || USD ' + dataHargaMWP['d_harga_sni1_petani'], "Rp" + dataHargaMWP['harga_sni1_fob'] + ' || USD ' + dataHargaMWP['d_harga_sni1_fob']]);
      renderData.push(["ISO", "Rp " + dataHargaMWP['harga_iso_petani'] + ' || USD ' + dataHargaMWP['d_harga_iso_petani'], "Rp" + dataHargaMWP['harga_iso_fob'] + ' || USD ' + dataHargaMWP['d_harga_iso_fob']]);
      HargaMWPTable.clear().rows.add(renderData).draw('full-hold');
    }

    function renderStandarMutu(data) {
      if (data == null || typeof data != "object") {
        console.log("HargaMWP::UNKNOWN DATA");
        return;
      }
      var i = 0;

      var renderData = [];
      renderData.push(["Cemaran Serangga (By count Maks)", data['1']['cemaran_serangga'], data['2']['cemaran_serangga'], data['3']['cemaran_serangga'], data['4']['cemaran_serangga'], data['5']['cemaran_serangga'], data['6']['cemaran_serangga'], data['7']['cemaran_serangga'], data['8']['cemaran_serangga']]);
      renderData.push(["Kerapatan (g/1)", data['1']['kerapatan'], data['2']['kerapatan'], data['3']['kerapatan'], data['4']['kerapatan'], data['5']['kerapatan'], data['6']['kerapatan'], data['7']['kerapatan'], data['8']['kerapatan']]);
      renderData.push(["Kadar Air (%)", data['1']['kadar_air'], data['2']['kadar_air'], data['3']['kadar_air'], data['4']['kadar_air'], data['5']['kadar_air'], data['6']['kadar_air'], data['7']['kadar_air'], data['8']['kadar_air']]);
      renderData.push(["Kadar Biji Enteng (%)", data['1']['kadar_biji_enteng'], data['2']['kadar_biji_enteng'], data['3']['kadar_biji_enteng'], data['4']['kadar_biji_enteng'], data['5']['kadar_biji_enteng'], data['6']['kadar_biji_enteng'], data['7']['kadar_biji_enteng'], data['8']['kadar_biji_enteng']]);
      renderData.push(["Kadar Benda Asing (%)", data['1']['kadar_benda_asing'], data['2']['kadar_benda_asing'], data['3']['kadar_benda_asing'], data['4']['kadar_benda_asing'], data['5']['kadar_benda_asing'], data['6']['kadar_benda_asing'], data['7']['kadar_benda_asing'], data['8']['kadar_benda_asing']]);
      renderData.push(["Kadar Cemaran Kapang (%)", data['1']['kadar_cemaran'], data['2']['kadar_cemaran'], data['3']['kadar_cemaran'], data['4']['kadar_cemaran'], data['5']['kadar_cemaran'], data['6']['kadar_cemaran'], data['7']['kadar_cemaran'], data['8']['kadar_cemaran']]);
      renderData.push(["Kadar Lada berwarna putih kehitaman (%)", data['1']['kadar_hitam_putih'], data['2']['kadar_hitam_putih'], data['3']['kadar_hitam_putih'], data['4']['kadar_hitam_putih'], data['5']['kadar_hitam_putih'], data['6']['kadar_hitam_putih'], data['7']['kadar_hitam_putih'], data['8']['kadar_hitam_putih']]);
      renderData.push(["E Colli (MPN/g)", data['1']['e_colli'], data['2']['e_colli'], data['3']['e_colli'], data['4']['e_colli'], data['5']['e_colli'], data['6']['e_colli'], data['7']['e_colli'], data['8']['e_colli']]);
      renderData.push(["Salmonella (Detection/25g)", data['1']['salmonella'], data['2']['salmonella'], data['3']['salmonella'], data['4']['salmonella'], data['5']['salmonella'], data['6']['salmonella'], data['7']['salmonella'], data['8']['salmonella']]);
      renderData.push(["Kadar Piperin (%)", data['1']['kadar_piperin'], data['2']['kadar_piperin'], data['3']['kadar_piperin'], data['4']['kadar_piperin'], data['5']['kadar_piperin'], data['6']['kadar_piperin'], data['7']['kadar_piperin'], data['8']['kadar_piperin']]);
      renderData.push(["Kadar Minyak Atsiri (%)", data['1']['kadar_minyak'], data['2']['kadar_minyak'], data['3']['kadar_minyak'], data['4']['kadar_minyak'], data['5']['kadar_minyak'], data['6']['kadar_minyak'], data['7']['kadar_minyak'], data['8']['kadar_minyak']]);

      // Object.values(data).forEach((d) => {
      //   renderData.push([d['nama_mutu'], d['cemaran_serangga'], d['kerapatan'], 
      //   d['kadar_air'], d['kadar_biji_enteng'], d['kadar_benda_asing'], 
      //   d['kadar_cemaran'], d['kadar_hitam_putih'], d['e_colli'], 
      //   d['salmonella'], d['kadar_piperin'], d['kadar_minyak'] ]);

      // });

      StandarMutuTable.clear().rows.add(renderData).draw('full-hold');
    }

    function getAllNews() {
      swal({
        title: 'Loading product...',
        allowOutsideClick: false
      });
      swal.showLoading();
      return $.ajax({
        url: `<?php echo site_url('NewsController/getAll/') ?>`,
        'type': 'GET',
        data: {
          featured: true
        },
        success: function(data) {
          swal.close();
          var json = JSON.parse(data);
          if (json['error']) {
            return;
          }
          dataNews = json['data'];
          renderNews(dataNews);
        },
        error: function(e) {}
      });
    }

    function renderNews(data) {
      if (data == null || typeof data != "object") {
        console.log("Product::UNKNOWN DATA");
        return;
      }
      var i = 0;
      news_list.empty();
      // console.log(data);
      Object.values(data).forEach((news) => {
        if (i < 2) {
          var panjang = news['berita_isi'];
          // var p = panjang.substring(0, 1200);
          var index_p = panjang.lastIndexOf("</p>", 1200);
          p = panjang.substring(0, index_p);
          news_list.append(`
        <div class="col-sm-12">
          <div class="ibox product-box">
          <div class="card">
            <div class="card-header" style="cursor:pointer" onclick="location.href='<?= site_url('newsx?id_news='); ?>${news['berita_id']}'">
              <h5>${news['berita_judul']}</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3 ibox-content">
                  <img src="<?= base_url('assets/img/news/') ?>${news['berita_image']}" class="img-fluid img-thumbnail" alt="...">
                </div>
                <div class="col-sm-9 ibox-content">
                  <p class="card-text">
                    ${p}
                  </p>
                </div>
              </div>
            </div>
          </div>
          </div>
          </div>
        
      `);
          i++;
        }
      });


    }


    function getAllProduct() {
      swal({
        title: 'Loading product...',
        allowOutsideClick: false
      });
      swal.showLoading();
      return $.ajax({
        url: `<?php echo site_url('ProductController/getAll/') ?>`,
        'type': 'GET',
        data: {
          featured: true
        },
        success: function(data) {
          swal.close();
          var json = JSON.parse(data);
          if (json['error']) {
            return;
          }
          dataProduct = json['data'];
          renderProduct(dataProduct);
        },
        error: function(e) {}
      });
    }

    function renderProduct(data) {
      if (data == null || typeof data != "object") {
        console.log("Product::UNKNOWN DATA");
        return;
      }
      product_list.empty();
      Object.values(data).forEach((product) => {
        product_list.append(`
        <div class="col-sm-3">
          <div class="ibox product-box" style="cursor:pointer" onclick="location.href='<?= site_url('product?id_product='); ?>${product['id_product']}'">
            <div class="ibox-title">
              <h5>${product['nama_product']}</h5>
            </div>
            <div>
              <div class="ibox-content no-padding border-left-right">
                <div class="product-item" style="background-image:url('<?= base_url('uploads/cover_product/') ?>${product['cover_product']}')"></div>
              </div>
              <div class="ibox-content profile-content">
                <h4><strong>${product['nama_perusahaan']}</strong></h4>
                <p>${product['deskripsi_product']}</p>
              </div>
            </div>
          </div>
        </div>
      `);
      });
    }
    var lang_in = $('#lang_in');
    var lang_en = $('#lang_en');
    lang_in.on('click', (ev) => {
      document.cookie = "lang_set=in";
      location.reload();
    });
    lang_en.on('click', (ev) => {
      document.cookie = "lang_set=en";
      location.reload();
    });

  });
</script>

</body>

</html>