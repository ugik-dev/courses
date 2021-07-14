<div class="wrapper wrapper-content animated fadeInRight">
    <div class="tabs-container">
        <ul class="nav nav-tabs" role="tablist">
            <li><a class="nav-link active" data-toggle="tab" href="#tab-11">10 MIPA</a></li>
            <li><a class="nav-link" data-toggle="tab" href="#tab-22">10 IPS</a></li>
            <li><a class="nav-link" data-toggle="tab" href="#tab-33">11 MIPA</a></li>
            <li><a class="nav-link" data-toggle="tab" href="#tab-44">11 IPS</a></li>
            <li><a class="nav-link" data-toggle="tab" href="#tab-55">12 MIPA</a></li>
            <li><a class="nav-link" data-toggle="tab" href="#tab-66">12 IPS</a></li>
        </ul>
        <div class="tab-content">
        <?php $this->load->view('admin/tapmapping/10mipa'); ?>
        <?php $this->load->view('admin/tapmapping/10ips'); ?>
        <?php $this->load->view('admin/tapmapping/11mipa'); ?>
        <?php $this->load->view('admin/tapmapping/11ips'); ?>
        <?php $this->load->view('admin/tapmapping/12mipa'); ?>
        <?php $this->load->view('admin/tapmapping/12ips'); ?>
   
    </div>
    </div>
</div>


<script>
    $(document).ready(function() {
      $('#mappingmapel').addClass('active');
    });
    </script>
