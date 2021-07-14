<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestModel extends CI_Model {

	function simpan_upload($judul,$image){
		$data = array(
						'judul' => $judul,
						'gambar' => $image
				);  
		$result= $this->db->insert('tbl_galeri',$data);
		return $result;
}

}
