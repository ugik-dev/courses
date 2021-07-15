<?php $this->load->view('Fragment/HeaderFragment', ['title' => $title]); ?>
<div class="jumbotron " style="height: 95%">
    <div class="background_login" id="login_page"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <img class="ulogo" src="<?php echo base_url('assets/img/study.png'); ?>" style="width : 100%; height: auto">
                    </div>
                    <div class="col-md-9 ulayout">
                        <h1 class="display-4 shadowed">Register</h1>
                        <p class="lead shadowed">Your Courses</p>
                        <!-- <p class="lead shadowed">Provinsi Kepulauan Bangka Belitung</p> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ibox-content loginForm" style="background-color:#ffffff61">
                    <form id="registerForm" class="m-t" role="form">
                        <h3 style="color: black;">Registrasi / Daftar</h3>
                        <div class="form-group">
                            <input type="text" placeholder="Username" class="form-control" id="username" name="username" required="required" autocomplete="username">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" placeholder="Password" class="form-control" id="password" name="password" autocomplete="new-password" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <input type="password" placeholder="Password" class="form-control" id="repassword" name="repassword" autocomplete="new-password" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" placeholder="Email" class="form-control" id="email" name="email" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <input type="text" placeholder="No Telepon" class="form-control" id="phone" name="phone" required="required">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">

                            <input type="text" placeholder="Nama" class="form-control" id="nama" name="nama" required="required">
                        </div>

                        <div class="form-group">

                            <textarea rows="4" type="text" placeholder="Alamat" class="form-control" id="alamat" name="alamat" required="required"></textarea>
                        </div>

                        <button type="submit" id="registerBtn" class="btn btn-primary block full-width m-b" data-loading-text="Registering In...">
                            Register</button>
                        <a class="btn btn-default block full-width m-b" href="<?= base_url('login') ?>">Login</a>
                    </form>
                    <p class="m-t">
                        <!-- <small style="color: black;">DINAS PENDIDIKAN PROVINSI KEP. BANGKA BELITUNG</small> -->
                    </p>
                </div>
            </div>


        </div>
        <br>
    </div>
</div>


<script>
    $(document).ready(function() {

        var registerForm = $('#registerForm');
        var divregion = $('#divregion');
        var region = $('#region');
        var submitBtn = registerForm.find('#registerBtn');
        var login_page = $('#login_page');


        registerForm.on('submit', (ev) => {
            ev.preventDefault();
            buttonLoading(submitBtn);
            $.ajax({
                url: "<?= site_url() . 'register-process' ?>",
                type: "POST",
                data: registerForm.serialize(),
                success: (data) => {
                    buttonIdle(submitBtn);
                    json = JSON.parse(data);
                    if (json['error']) {
                        swal("Login Gagal", json['message'], "error");
                        return;
                    } else {
                        swal("Success Registration", 'check your email to activation', "success");
                    }
                    // $(location).attr('href', '<?= site_url() ?>' + json['user']['nama_controller']);
                },
                error: () => {
                    buttonIdle(submitBtn);
                }
            });
        });

        var counter = Math.floor(Math.random() * 100) + 1;
        var image_count = 28;
        login_page.addClass(`img_${counter % image_count}`);
        window.setInterval(function() {
            counter += 1;
            var prevIdx = (counter - 1) % image_count;
            var currIdx = counter % image_count;
            login_page.fadeOut('400', function() {
                login_page.removeClass(`img_${prevIdx}`);
                login_page.addClass(`img_${currIdx}`);
                login_page.fadeIn('400', function() {})
            });
        }, 15000);
    });
</script>
<style>
    body {
        background-color: #f3f3f4 !important;
    }

    .img_0 {
        background-image: url('assets/img/background/1-Lomba-Foto-Babar-2017_Menangkis-Tantangan_Lintang-Tatang.jpg');
    }

    .img_1 {
        background-image: url('assets/img/background/1-Sardy_Pesanggrahan-Menumbing.jpg');
    }

    .img_2 {
        background-image: url('assets/img/background/2-Agus-Ramdhany_Batu-penunggu-pantai.jpg');
    }

    .img_3 {
        background-image: url('assets/img/background/2--Lomba-Foto-Babar-2017_Dendang-Rampak_Guzairi-Linggarjati.jpg');
    }

    .img_4 {
        background-image: url('assets/img/background/3--Lomba-Foto-Babar-2017_3000-obor_Aswandi.jpg');
    }

    .img_5 {
        background-image: url('assets/img/background/5-Media-Nusantara_Pelabuhan-Tanjung-Kalian.jpg');
    }

    .img_6 {
        background-image: url('assets/img/background/6-Lomba-Foto-Babar_Dwi-Hardiansyah_-Perang-Ketupat.jpg');
    }

    .img_7 {
        background-image: url('assets/img/background/6-Rizky-Saputra_MTI-Muntok.jpg');
    }

    .img_8 {
        background-image: url('assets/img/background/Batu-Berlayar---Kabupaten-Belitung-by-Jeffry-Surianto.jpg');
    }

    .img_9 {
        background-image: url('assets/img/background/De-Locomotief-5.jpg');
    }

    .img_10 {
        background-image: url('assets/img/background/Dermaga-Pulau-Buku-Limau---Kabupaten-Belitung-Timur-by-Mina-Arvah.jpg');
    }

    .img_11 {
        background-image: url('assets/img/background/DSC_0900.jpg');
    }

    .img_12 {
        background-image: url('assets/img/background/GERBANG-LIKUR,-Deni-Syafutra-,jl.jpg');
    }

    .img_13 {
        background-image: url('assets/img/background/KEMBANG-LIKUR,GINDA-HUWAYAN-PULUNGAN,-SUNGAILIAT,-085379290989,-DESA-MANCUNG-KECAMATAN-KELAPA-BAN.jpg');
    }

    .img_14 {
        background-image: url('assets/img/background/landscape.jpg');
    }

    .img_15 {
        background-image: url('assets/img/background/Landscape-Kaolin_Pelangi-IG-ok.jpg');
    }

    .img_16 {
        background-image: url('assets/img/background/Museum-Timah---Lastriazi2017-(3).jpg');
    }

    .img_17 {
        background-image: url('assets/img/background/PAHLAWAN-KECIL,-ADITTIYA-SAPUTRA,-JL.jpg');
    }

    .img_18 {
        background-image: url('assets/img/background/PantaiBatuKapur-.jpg');
    }

    .img_19 {
        background-image: url('assets/img/background/Pantai-Pasir-Padi---Kota-Pangkalpinang-by-Muttaqin.jpg');
    }

    .img_20 {
        background-image: url('assets/img/background/Pesanggrahan-Muntok---Kabupaten-Bangka-Barat.jpg');
    }

    .img_21 {
        background-image: url('assets/img/background/Pulau-Dapur---Kabupaten-Bangka-Selatan.jpg');
    }

    .img_22 {
        background-image: url('assets/img/background/Pulau-Lengkuas---Belitung.jpg');
    }

    .img_23 {
        background-image: url('assets/img/background/RANGGAM_TAUFIQHIDAYAT_08127171822.jpg');
    }

    .img_24 {
        background-image: url('assets/img/background/Tanjung-Berikat---Bangka-Tengah-by-Setiadi--Darmawan.jpg');
    }

    .img_25 {
        background-image: url('assets/img/background/tanjung-labu.jpg');
    }

    .img_26 {
        background-image: url('assets/img/background/Tarsius-Bancanus-Saltator.jpg');
    }

    .img_27 {
        background-image: url('assets/img/background/Teluk-Limau---Kabupaten-Bangka-by-Iksander.jpg');
    }

    .jumbotron {
        background-size: cover;
        width: 100%;
        height: 250px;
        border-radius: 0px;
        padding: 130px;
    }

    .background_login {
        position: fixed;
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
        /* background-color: #ffffff; */
        /* border: 1px solid black; */
        /* opacity: 0.6; */
        filter: alpha(opacity=60);
        /* For IE8 and earlier */
    }

    .ulogo {
        max-width: 150px !important;
    }

    .ulayout {
        width: 90%;
    }

    @media (max-width: 369px) and (min-width: 200px) {
        .ulogo {
            max-width: 90% !important;
        }

        .ulayout {
            width: 300px !important;
            font-size: 10px !important;
            padding: 0px;
        }

        .display-4 {
            width: 180px !important;
            font-size: 20px !important;
            padding: 0px 0px 0px 0px !important;
            margin-bottom: 20px;
        }

        .lead {
            width: 180px !important;
            font-size: 10px !important;
            padding: 0px 0px 0px 0px !important;
            margin-top: -10px;
        }

        .col-md-3 {
            width: 100px !important;
            padding: 0px;
        }
    }

    @media (max-width: 800px) and (min-width: 400px) {
        .ulogo {
            max-width: 900% !important;
            width: 100px;
        }

        .ulayout {
            width: 800px !important;
            font-size: 10px !important;
            padding: 10px;
        }

        .display-4 {
            width: 400px !important;
            font-size: 30px !important;
            padding: 0px 0px 0px 0px !important;
            margin-bottom: 20px;
        }

        .lead {
            width: 300px !important;
            font-size: 10px !important;
            padding: 0px 0px 0px 0px !important;
            margin-top: -10px;
        }


        .col-md-3 {
            width: 80px !important;
            padding: 10px;
        }

        .loginForm {
            width: 50% !important;
        }
    }

    @media (max-width: 1200px) {
        .ulogo {
            max-width: 90% !important;
        }

        .ulayout {
            width: 400px !important;
            font-size: 10px !important;
            padding: 10px;
        }

        .display-4 {
            width: 400px !important;
            font-size: 30px !important;
            padding: 0px 0px 0px 0px !important;
            margin-bottom: 20px;
        }

        .lead {
            width: 300px !important;
            font-size: 10px !important;
            padding: 0px 0px 0px 0px !important;
            margin-top: -10px;
        }

        .col-md-3 {
            width: 200px;
            padding: 10px;
        }

        .loginForm {
            width: 100%;
        }
    }
</style>
<?php $this->load->view('Fragment/FooterFragment'); ?>