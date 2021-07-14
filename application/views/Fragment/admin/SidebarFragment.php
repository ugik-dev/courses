<div id="wrapper">

  <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
      <ul class="nav metismenu" id="side-menu">
        <?= $this->load->view('Fragment/SidebarHeaderFragment', NULL, TRUE); ?>
        <li id="dashboard">
          <a href="<?= site_url('AdminController/') ?>"><i class="fa fa-home"></i> <span class="nav-label">Beranda</span></a>
        </li>
        <li id="kelolahuser">
          <a href="<?= site_url('AdminController/Kelolahuser') ?>"><i class="fas fa-user-tie"></i><span class="nav-label">Kelolah Pegawai</span></a>
        </li>
        <li id="kelolahsiswa">
          <a href="<?= site_url('AdminController/Kelolahsiswa') ?>"><i class="far fa-user-graduate"></i><span class="nav-label">Kelolah Siswa</span></a>
        </li>

        <li id="bank_soal">
          <a href="<?= site_url('AdminController/BankSoal') ?>"><i class="far fa-user-graduate"></i><span class="nav-label">Bank Soal</span></a>
        </li>


        <li id="open_session">
          <a href="<?= site_url('AdminController/OpenSession') ?>"><i class="far fa-user-graduate"></i><span class="nav-label">Open Session</span></a>
        </li>


        <li id="my_task">
          <a href="<?= site_url('my-task') ?>"><i class="far fa-user-graduate"></i><span class="nav-label">My Task</span></a>
        </li>

        <!-- <li id="laporan">
        <a href="<?= site_url('AdminController/laporanpariwisata') ?>"><i class="fa fa-archive"></i> <span class="nav-label">Laporan</span></a>
      </li>
      <li id="kalender">
        <a href="<?= site_url('AdminController/kalender') ?>"><i class="fas fa-calendar-alt"></i> <span class="nav-label">Event</span></a>
      </li>
      <li id="tenagakerja">
        <a href="<?= site_url('AdminController/tenagakerja') ?>"><i class="fas fa-user-tie"></i><span class="nav-label">Tenaga Kerja</span></a>
      </li> -->
        <li id="mapping">
          <a href="<?= site_url('AdminController/Mapping') ?>"><i class="fas fa-network-wired"></i></i> <span class="nav-label">Mapping Kelas</span></a>
        </li>
        <li id="mappingmapel">
          <a href="<?= site_url('AdminController/MappingMapel') ?>"><i class="fas fa-book"></i></i> <span class="nav-label">Mapping Mapel</span></a>
        </li>
        <li id="setting">
          <a href="#"><i class="fas fa-cogs"></i><span class="nav-label">Setting</span><span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse" aria-expanded="false">
            <li id="set_mapel">
              <a href="<?= site_url('AdminController/SetMapel') ?>"> <span class="nav-label">Mata Pelajaran</span></a>
            </li>
            <li id="set_kelas">
              <a href="<?= site_url('AdminController/SetKelas') ?>"> <span class="nav-label">Kelas</span></a>
            </li>
            <li id="set_ta">
              <a href="<?= site_url('AdminController/SetTA') ?>"> <span class="nav-label">Tahun Ajaran</span></a>
            </li>
        </li>
      </ul>
      </li>
      <li id="search">
        <a href="<?= base_url('search') ?>"><i class="fas fa-search"></i></i> <span class="nav-label">Search</span></a>
      </li>
      <li id="logout">
        <a href="<?= site_url('AdminController') ?>" class="logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
      </li>
      </li>
    </div>
  </nav>
  <script>
    $(document).ready(function() {});
  </script>