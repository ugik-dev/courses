<div id="wrapper">

  <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
      <ul class="nav metismenu" id="side-menu">
        <?= $this->load->view('Fragment/SidebarHeaderFragment', NULL, TRUE); ?>
        <li id="dashboard">
          <a href="<?= site_url('GuruController/') ?>"><i class="fa fa-home"></i> <span class="nav-label">Beranda</span></a>
        </li>
        <li id="kelas_saya">
          <a href="<?= site_url('GuruController/kelas_saya') ?>"><i class="fa fa-home"></i> <span class="nav-label">Kelas Saya</span></a>
        </li>

        <li id="forum_saya">
          <a href="<?= site_url('GuruController/forum_saya') ?>"><i class="fa fa-archive"></i> <span class="nav-label">Forum</span></a>
        </li>
        <!-- <li id="kalender">
          <a href="<?= site_url('PimpinanController/kalender') ?>"><i class="fas fa-calendar-alt"></i> <span class="nav-label">Event</span></a>
        </li> -->
        <li id="logout">
          <a href="<?= site_url('AdminController') ?>" class="logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
        </li>
      </ul>
    </div>
  </nav>
</div>
<script>
  $(document).ready(function() {});
</script>