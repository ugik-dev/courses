<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MessageModel extends CI_Model
{

    public function sent_mapping_kelas($data){
            $data['id_user'] = $this->session->userdata()['id_user'];
            $dataInsert = DataStructure::slice($data, ['id_mapping_kelas', 'text_message', 'id_user']);
            $this->db->insert('chat_mapping_kelas', $dataInsert);
            ExceptionHandler::handleDBError($this->db->error(), "Sent Message", "chat_mapping_kelas");
            return $this->db->insert_id();
    }
}