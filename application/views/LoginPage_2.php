<?php $this->load->view('Fragment/HeaderFragment',['title' => $title]); ?>
<div class="jumbotron" style="height: 95%">
 
  <div class="container">
    <div class="row">
      <div class="col-md-8" >
          <h1 class="display-4">DINAS KEBUDAYAAN PARIWISATA</h1>
          <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
          <hr class="my-4">
            <!-- <div class="row">
              <div class="col-md-6">
                  Pemerintah Provinsi Kepulauan Bangka Belitung
              </div>
              <div class="col-md-6 text-right">
                <small>© 2019</small>
              </div>
            </div> -->
        
      </div>     
      <div class="col-md-4">
        <div class="ibox-content">
          <form id="loginForm"  class="m-t" role="form">
            <h3>Masuk</h3>
            <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <button type="submit" id="loginBtn" class="btn btn-primary block full-width m-b" data-loading-text="Loging In...">Login</button>
          </form>
          <p class="m-t">
            <small>DINAS KEBUDAYAAN DAN PARIWISATA</small>
          </p>
        </div>
      </div>
      
     
    </div>
    <br>
    <div class="col-md-12">
      <div class="row">
        <img class="col-md-2" src="<?php echo base_url('assets/img/logo-babel.png');?>" >
        <img class="col-md-2" src="<?php echo base_url('assets/img/logo-comeexplore.png');?>" >
        <img class="col-md-2" src="<?php echo base_url('assets/img/logo-pesona-indonesia.png');?>" >
      </div>
      </div> 
  </div>
  </div>


<script>
  $(document).ready(function() {

    var loginForm = $('#loginForm');
    var submitBtn = loginForm.find('#loginBtn');

    loginForm.on('submit', (ev) => {
      ev.preventDefault();
      buttonLoading(submitBtn);
      $.ajax({
        url: "<?=site_url() . 'login-process'?>",
        type: "POST",
        data: loginForm.serialize(),
        success: (data) => {
          buttonIdle(submitBtn);
          json = JSON.parse(data);
          if(json['error']){
            swal("Login Gagal", json['message'], "error");
            return;
          }
          $(location).attr('href', '<?=site_url()?>' + json['user']['nama_controller']);
        },
        error: () => {
          buttonIdle(submitBtn);
        }
      });
    });

  });
</script>
<style> body { background-color: #f3f3f4!important; }
.jumbotron {
  background-image: url('../assets/img/walp3.jpg');
  background-size: cover;
  height: 750px;
  border-radius: 0px;
  padding: 130px;
}

.div.row {
  /* margin: 30px;
  background-color: #ffffff;
  border: 1px solid black;
  opacity: 0.6;
  filter: alpha(opacity=60); For IE8 and earlier */
}
</style>
<?php $this->load->view('Fragment/FooterFragment'); ?>
