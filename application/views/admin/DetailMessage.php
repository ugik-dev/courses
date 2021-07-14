<div class="wrapper wrapper-content animated fadeInRight">
  <div class="col-lg-10">
    <div class="ibox">
      <div class="ibox-content">
        <form>
          <div class="form-group">
            <label for="nama">Dari</label>
            <input type="text" placeholder="" class="form-control" id="nama_user_sending" name="nama_user_entry" readonly="readonly">
          </div>
        
          <div class="form-group">
            <label for="formGroupExampleInput">Pesan</label>
            <textarea rows="6" type="text" class="form-control" id="text_message" readonly="readonly">
                </textarea>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    var id_message = "<?= $contentData['id_message'] ?>";
    console.log('idMessagee', id_message);
    getDetailMessage();

    function getDetailMessage() {
      return $.ajax({
        url: `<?php echo site_url('MessageController/getDetailMessage/') ?>`,
        'type': 'GET',
        data: {
          id_message: id_message
        },
        success: function(data) {
          var json = JSON.parse(data);

          dataMessage = json['data'];
          renderMessage(dataMessage);
          // changeStatus();
        },
        error: function(e) {}
      });
    }

    function changeStatus() {
      return $.ajax({
        url: `<?php echo site_url('MessageController/changeStatus/') ?>`,
        'type': 'GET',
        data: {
          id_message: id_message
        },
        success: function(data) {

        },
        error: function(e) {}
      });
    }

    function renderMessage(data) {
      console.log(data)

      text_message = document.getElementById("text_message");
      text_message.value = data[0]['text_message'];
      nama_user_sending = document.getElementById("nama_user_sending");
      nama_user_sending.value = data[0]['nama_user_sending'];
      changeStatus();
    }
  });
</script>