<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
      <?= $this->load->view('Fragment/SidebarHeaderFragment', NULL, TRUE);?>
      <li id="dashboard">
        <a href="<?=site_url('PimpinanTransportasiController/')?>"><i class="fa fa-home"></i> <span class="nav-label">Beranda</span></a>
      </li>
      
      <li id="laporan">
        <a href="<?=site_url('PimpinanTransportasiController/laporanpariwisata')?>"><i class="fa fa-archive"></i> <span class="nav-label">Laporan</span></a>
      </li>
      <li id="kalender">
        <a href="<?=site_url('PimpinanTransportasiController/kalender')?>"><i class="fas fa-calendar-alt"></i> <span class="nav-label">Event</span></a>
      </li>
      <!-- <li id="tenagakerja">
        <a href="<?=site_url('PimpinanTransportasiController/tenagakerja')?>"><i class="fas fa-user-tie"></i><span class="nav-label">Tenaga Kerja</span></a>
      </li> -->

      <li id="profil">
        <a href="<?=site_url('PimpinanTransportasiController/Profil')?>"><i class="fas fa-ethernet"></i> <span class="nav-label">Profil</span></a>
      </li>
      <li id="data">
        <a href="<?=site_url('PimpinanTransportasiController/DataPengunjung')?>"><i class="fab fa-accusoft"></i> <span class="nav-label">Data</span></a>
      </li>

      <li id="logout">
        <a href="<?=site_url('PimpinanTransportasiController')?>" class="logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
      </li>
    </li>
  </div>
</nav>
<script>
$(document).ready(function() {});
</script>