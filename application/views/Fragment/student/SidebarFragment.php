<div id="wrapper">

  <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
      <ul class="nav metismenu" id="side-menu">
        <?= $this->load->view('Fragment/SidebarHeaderFragment', NULL, TRUE); ?>
        <li id="dashboard">
          <a href="<?= site_url('AdminController/') ?>"><i class="fa fa-home"></i> <span class="nav-label">Beranda</span></a>
        </li>


        <li id="my_task">
          <a href="<?= site_url('my-task') ?>"><i class="far fa-user-graduate"></i><span class="nav-label">My Task</span></a>
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