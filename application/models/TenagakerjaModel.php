<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TenagakerjaModel extends CI_Model {

    
	public function getPendidikanOption($filter = []){
		$this->db->select('*');
		$this->db->from('pendidikan as s');
		$res=$this->db->get();
        if(!empty($filter['id_pendidikan'])) $this->db->where('id_pendidikan', $filter['id_pendidikan']);
		
		return DataStructure::keyValue($res->result_array(), 'id_pendidikan');
	}
	
	public function getJeniskelaminOption($filter = []){
		$this->db->select('*');
		$this->db->from('jenis_kelamin as s');
		$res=$this->db->get();
      //  if(!empty($filter['id_pendidikan'])) $this->db->where('id_pendidikan', $filter['id_pendidikan']);
		
		return DataStructure::keyValue($res->result_array(), 'id_jenis_kelamin');
	}
	
	public function getSertifikasiOption($filter = []){
		$this->db->select('*');
		$this->db->from('sertifikasi as s');
		$res=$this->db->get();
      //  if(!empty($filter['id_pendidikan'])) $this->db->where('id_pendidikan', $filter['id_pendidikan']);
		
		return DataStructure::keyValue($res->result_array(), 'id_sertifikasi');
	}
	
	public function getPelatihanOption($filter = []){
		$this->db->select('*');
		$this->db->from('pelatihan as s');
		$res=$this->db->get();
       // if(!empty($filter['id_pendidikan'])) $this->db->where('id_pendidikan', $filter['id_pendidikan']);
		
		return DataStructure::keyValue($res->result_array(), 'id_pelatihan');
    }
	
	public function getLv1Option($filter = []){
		$this->db->select('*');
		$this->db->from('sdm_lv1 as s');
		$res=$this->db->get();
        if(!empty($filter['id_lv1'])) $this->db->where('id_lv1', $filter['id_lv1']);
		
		return DataStructure::keyValue($res->result_array(), 'id_lv1');
    }
	

	public function getLv2Option($filter = []){
		$this->db->select('*');
		$this->db->from('sdm_lv2 as s');
		
        $this->db->where('id_lv1', $filter['id_lv1']);
		$res=$this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_lv2');
    }

    public function getLv3Option($filter = []){
		$this->db->select('*');
		$this->db->from('sdm_lv3 as s');
		
        $this->db->where('id_lv2', $filter['id_lv2']);
		$res=$this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_lv3');
    }

    public function getLv4Option($filter = []){
		$this->db->select('*');
		$this->db->from('sdm_lv4 as s');
		
        $this->db->where('id_lv3', $filter['id_lv3']);
		$res=$this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_lv4');
    }

  public function getAllTenagakerja($filter = []){
		$this->db->select('cb.* , j1.nama_lv1,j2.nama_lv2,j3.nama_lv3,j4.nama_lv4,s.nama_sertifikasi,p.nama_pelatihan,kab.nama_kabupaten');
		$this->db->from('sdm as cb');
		$this->db->join("sdm_lv1 as j1", "j1.id_lv1 = cb.id_lv1",'left');
        $this->db->join("sdm_lv2 as j2", "j2.id_lv2 = cb.id_lv2",'left');
        $this->db->join("sdm_lv3 as j3", "j3.id_lv3 = cb.id_lv3",'left');
        $this->db->join("sdm_lv4 as j4", "j4.id_lv4 = cb.id_lv4",'left');
		$this->db->join("sertifikasi as s", "s.id_sertifikasi = cb.id_sertifikasi",'left');
		$this->db->join("pelatihan as p", "p.id_pelatihan = cb.id_pelatihan",'left');
        $this->db->join("kabupaten as kab", "kab.id_kabupaten = cb.id_kabupaten");
		//$this->db->join("status_penetapan_sdm as sp", "sp.id_status_penetapan_sdm = cb.status_penetapan");
		if(!empty($filter['id_sdm'])) $this->db->where('cb.id_sdm', $filter['id_sdm']);
		if(!empty($this->session->userdata('id_kabupaten'))) $this->db->where('cb.id_kabupaten', $this->session->userdata('id_kabupaten'));
	    $res = $this->db->get();
	    return DataStructure::keyValue($res->result_array(), 'id_sdm');
	}

	public function getTenagakerja($idTenagakerja = NULL){
		$row = $this->getAllTenagakerja(['id_sdm' => $idTenagakerja]);
		if (empty($row)){
			throw new UserException("Tenagakerja yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
		}
		return $row[$idTenagakerja];
	}

	  public function addTenagakerja($data){
		$data['id_user_entry'] = $this->session->userdata('id_user');
		if($this->session->userdata('id_role') == '1'){

		}else{
		  $data['id_kabupaten'] = $this->session->userdata('id_kabupaten');
	    };
	    $dataInsert = DataStructure::slice($data, ['id_user_entry','id_kabupaten','id_lv1','id_lv2','id_lv3','id_lv4','id_pelatihan','id_pendidikan','id_sertifikasi','id_jenis_kelamin','nama_sdm','tempat_lahir','tanggal_lahir','alamat','no_ktp','no_hp','tahun_sertifikasi','penyelenggara_sertifikasi']);
	    $this->db->insert('sdm', $dataInsert);
	    ExceptionHandler::handleDBError($this->db->error(), "Insert sdm", "id_sdm");
	    return $this->db->insert_id();
	}
	
	public function editTenagakerja($data){
		$data['id_user_entry'] = $this->session->userdata('id_user');
		if($this->session->userdata('id_role') == '1'){

		}else{
		  $data['id_kabupaten'] = $this->session->userdata('id_kabupaten');
	    };
        $dataInsert = DataStructure::slice($data, ['id_user_entry','id_kabupaten','id_lv1','id_lv2','id_lv3','id_lv4','id_pelatihan','id_pendidikan','id_sertifikasi','id_jenis_kelamin','nama_sdm','tempat_lahir','tanggal_lahir','alamat','no_ktp','no_hp','tahun_sertifikasi','penyelenggara_sertifikasi']);
        $this->db->set($dataInsert);
        $this->db->where('id_sdm', $data['id_sdm']);
		$this->db->update('sdm');

		ExceptionHandler::handleDBError($this->db->error(), "Ubah Tenagakerja", "sdm");	
		return $data['id_sdm'];
	}
	public function setPhoto($data){
        $dataInsert = DataStructure::slice($data, ['photo']);
        $this->db->set($dataInsert);
        $this->db->where('id_sdm', $data['id_sdm']);
		$this->db->update('sdm');

		return ExceptionHandler::handleDBError($this->db->error(), "Ubah Tenagakerja", "sdm");	
		// $data['id_sdm'];
	}

	public function setPelatihan($data){
	$dataInsert = DataStructure::slice($data, ['doc_pelatihan']);
        $this->db->set($dataInsert);
        $this->db->where('id_sdm', $data['id_sdm']);
		$this->db->update('sdm');

		return ExceptionHandler::handleDBError($this->db->error(), "Ubah Tenagakerja", "sdm");	
		// $data['id_sdm'];
	}

	public function setSertifikasi($data){
		$dataInsert = DataStructure::slice($data, ['doc_sertifikasi','tahun_sertifikasi','penyelenggara_sertifikasi']);
			$this->db->set($dataInsert);
			$this->db->where('id_sdm', $data['id_sdm']);
			$this->db->update('sdm');
	
			return ExceptionHandler::handleDBError($this->db->error(), "Ubah Tenagakerja", "sdm");	
			// $data['id_sdm'];
		}
	
	
	public function deleteTenagakerja($data){
		$this->db->where('id_sdm', $data['id_sdm']);
		$this->db->delete('sdm');

    ExceptionHandler::handleDBError($this->db->error(), "Hapus Tenagakerja", "sdm");
	}




}