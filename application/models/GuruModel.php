<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GuruModel extends CI_Model
{
    public function GetAllForum($filter = [])
	{
		$this->db->select("*");
		$this->db->from('v5_mapping as u');
        if ($this->session->userdata()['nama_role'] == 'guru') {
			$this->db->where('u.id_tenaga_kerja', $this->session->userdata()['id_user']);
		}
        if (!empty($filter['id_tahun_ajaran'])) $this->db->where('u.id_tahun_ajaran', $filter['id_tahun_ajaran']);
        if (!empty($filter['id_mapping_kelas'])) $this->db->where('u.id_mapping_kelas', $filter['id_mapping_kelas']);
		
		if (!empty($filter['id_mapping'])) $this->db->where('u.id_mapping', $filter['id_mapping']);
		if (!empty($filter['id_jenis_jurusan'])) $this->db->where('u.id_jenis_jurusan', $filter['id_jenis_jurusan']);
		if (!empty($filter['kelas'])) $this->db->where('u.kelas', $filter['kelas']);
		if (!empty($filter['id_mapel_jurusan'])) $this->db->where('u.id_mapel_jurusan', $filter['id_mapel_jurusan']);
		$res = $this->db->get();
		return $res->result_array();
    }
    
    public function getAllSiswaMapping($filter = [])
	{
		$this->db->select("u.* , pjo.username , pjo.nama");
		$this->db->from('mapping_siswa as u');
        $this->db->join("user as pjo", "u.id_siswa = pjo.id_user");
		if (!empty($filter['id_mapping'])) $this->db->where('u.id_mapping', $filter['id_mapping']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_mapping_siswa');
	}

	public function getAllSiswaMappingTask($filter = [])
	{
		$this->db->select("*");
		$this->db->from('v7_task as u');
		$this->db->join("user as pjo", "u.id_siswa = pjo.id_user");
		$this->db->where('u.id_task', $filter['id_task']);
		if (!empty($filter['id_mapping'])) $this->db->where('u.id_mapping', $filter['id_mapping']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_mapping_siswa');
    }

       
    public function getAllTask($filter = [])
	{
		$this->db->select("*");
		$this->db->from('task as u');
		$this->db->join("v5_mapping as pjo", "u.id_mapping_kelas = pjo.id_mapping_kelas");
	
   		if (!empty($filter['id_mapping_kelas'])) $this->db->where('u.id_mapping_kelas', $filter['id_mapping_kelas']);
		if (!empty($filter['id_task'])) $this->db->where('u.id_task', $filter['id_task']);
		// if ($this->session->userdata()['nama_role'] == 'guru')$this->db->where('u.id_created', $this->session->userdata()['id_user']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_task');

		// return $res->result_array();
	}
	
	public function getAllTaskSpek($filter = [])
	{
		$this->db->select("*");
		$this->db->from('task as u');
   		if (!empty($filter['id_mapping_kelas'])) $this->db->where('u.id_mapping_kelas', $filter['id_mapping_kelas']);
		if (!empty($filter['id_task'])) $this->db->where('u.id_task', $filter['id_task']);
		if ($this->session->userdata()['nama_role'] == 'guru')$this->db->where('u.id_created', $this->session->userdata()['id_user']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_task');

		// return $res->result_array();
    }

    public function getAllSiswaTask($filter = [])
	{
		$this->db->select("u.* , pjo.nama as nama_siswa");

		$this->db->from('v7_task as u');
        $this->db->join("user as pjo", "u.id_siswa = pjo.id_user");
	
        // $this->db->join("user as pjo", "u.id_siswa = pjo.id_user");
	
		if (!empty($filter['id_mapping_kelas'])) $this->db->where('u.id_mapping_kelas', $filter['id_mapping_kelas']);
		if (!empty($filter['id_task'])) $this->db->where('u.id_task', $filter['id_task']);
		if (!empty($filter['id_siswa'])) $this->db->where('u.id_siswa', $filter['id_siswa']);
		// if (!empty($filter['id_mapel_jurusan'])) $this->db->where('u.id_mapel_jurusan', $filter['id_mapel_jurusan']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_siswa');

		// return $res->result_array();
    }

    function create_task($data)
	{
		// var_dump($data);   
        // $cek = $this->cekSiswa($data);
        $data['id_created'] = $this->session->userdata()['id_user'];

		$dataInsert = DataStructure::slice($data, ['id_mapping_kelas', 'deskripsi', 'task_dokumen', 'start_task', 'end_task', 'id_created']);
		$this->db->insert('task', $dataInsert);
		ExceptionHandler::handleDBError($this->db->error(), "Menambah Tugas", "task");
		$this->db->insert_id();
	}


	public function edit_task($data)
	{
             $this->db->set(DataStructure::slice($data, ['id_mapping_kelas', 'deskripsi', 'task_dokumen', 'start_task', 'end_task', 'id_created']));
		$this->db->where('id_task', $data['id_task']);
		$this->db->update('task');

		ExceptionHandler::handleDBError($this->db->error(), "Ubah Tugas", "task");
		return $data['id_task'];
	}

	public function delete_task($data)
	{
		$this->db->where('id_task', $data['id_task']);
		$this->db->delete('task');

		ExceptionHandler::handleDBError($this->db->error(), "Hapus Tugas", "task");
	}

	function addEvaluasi($data)
	{
		// var_dump($data);   
        // $cek = $this->cekSiswa($data);
        // $data['id_created'] = $this->session->userdata()['id_user'];

		$dataInsert = DataStructure::slice($data, ['id_task', 'id_siswa', 'nilai', 'evaluasi']);
		$this->db->insert('task_submit', $dataInsert);
		ExceptionHandler::handleDBError($this->db->error(), "Menambah Tugas", "task_submit");
		$this->db->insert_id();
	}


	public function updateEvaluasi($data)
	{
             $this->db->set(DataStructure::slice($data, ['id_task', 'id_siswa', 'nilai', 'evaluasi']));
		$this->db->where('id_submit_task', $data['id_submit_task']);
		$this->db->update('task_submit');

		ExceptionHandler::handleDBError($this->db->error(), "Ubah Tugas", "task_submit");
		return $data['id_submit_task'];
	}

    
}
