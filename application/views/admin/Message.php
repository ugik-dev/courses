<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox">
   
      <div class="col-lg-12">
        <table class="table table-hover table-mail" id="table_message">
        <tbody >
        
        </tbody>
        </table>
      </div>
    </div>

</div>
<script>
$(document).ready(function() {
  
  getMessage();  
  function getMessage(){
    return $.ajax({
      url: `<?php echo site_url('MessageController/getMessage/')?>`, 'type': 'GET',
      data: {},
      success: function (data){
        var json = JSON.parse(data);
        
        dataMessage = json['data'];
        renderMessage(dataMessage);
      },
      error: function(e) {}
    });
  }

  function renderMessage(data){
      console.log(data)
      messageHTML = ``;
      Object.values(data).forEach((d) => {
          if(d['status'] == '0'){
              status_read = "unread"
              status_read2 = `<span class="label label-info float-right">Pimpinan</span>`;
          }else{
            status_read = "read"
            status_read2 = ""
            
          }
          messageHTML +=`
            <tr class="${status_read}">
                <td class="check-mail">
                    <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                </td>
                <td class="mail-ontact"><a href="<?=site_url()?>AdminController/DetailMessage?id_message=${d['id_message']}">${d['nama_user_sending']}</a> ${status_read2} </td>
                <td class="mail-subject"><a href="<?=site_url()?>AdminController/DetailMessage?id_message=${d['id_message']}">${d['text_message']}</a></td>
                <td class="delete"></td>
                <td class="text-right mail-date">${d['date']}</td>
            </tr>
          `;
          // <a id="delete${d['id_message']}" data-id="1" onclick="deleteMessage()"><i class="fa fa-trash" aria-hidden="true"></i></a>
      });
      
      table_message = document.getElementById("table_message");
      table_message.innerHTML = messageHTML;    
  }

 

});
</script>