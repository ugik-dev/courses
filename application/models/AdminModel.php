<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{

	public function NonActive($data)
	{
		$this->db->set('status_mj', '2');
		$this->db->where('id_mapel_jurusan', $data['id_mapel_jurusan']);
		$this->db->update('mapel_jurusan');
		return 'success';
	}

	public function Active($data)
	{
		// $data['status_mj'] = '2'
		// var_dump($data);
		$this->db->set('status_mj', '1');
		$this->db->where('id_mapel_jurusan', $data['id_mapel_jurusan']);
		$this->db->update('mapel_jurusan');
		return 'success';
	}

	public function Create($data)
	{

		$dataInsert = DataStructure::slice($data, ['id_jenis_jurusan', 'kelas', 'id_mapel']);
		$this->db->insert('mapel_jurusan', $dataInsert);
		ExceptionHandler::handleDBError($this->db->error(), "Insert Mapel Jurusan", "mapel_jurusan");
		return $this->db->insert_id();
	}


	public function addSessionExam($data)
	{

		$dataInsert = DataStructure::slice($data, ['id_mapel', 'open_start', 'open_end', 'limit_soal', 'limit_time', 'name_session_exam']);
		$this->db->insert('session_exam', $dataInsert);
		ExceptionHandler::handleDBError($this->db->error(), "Insert Mapel Jurusan", "session_exam");
		return $this->db->insert_id();
	}

	public function editSessionExam($data)
	{
		$dataInsert = DataStructure::slice($data, ['id_mapel', 'open_start', 'open_end', 'limit_soal', 'limit_time', 'name_session_exam']);
		$this->db->where('id_session_exam', $data['id_session_exam']);
		$this->db->update('session_exam', $dataInsert);
		ExceptionHandler::handleDBError($this->db->error(), "Insert Mapel Jurusan", "session_exam");
		return $data['id_session_exam'];
	}




	public function update_absen($data)
	{
		$this->db->set('status_absensi', $data['status_absensi']);
		$this->db->where('id_absen', $data['id_absen']);
		$this->db->update('absensi');
		return 'success';
	}

	public function add_absen($data)
	{
		$dataInsert = DataStructure::slice($data, ['id_mapping_siswa', 'tgl', 'status_absensi']);
		$this->db->insert('absensi', $dataInsert);
		ExceptionHandler::handleDBError($this->db->error(), "Insert", "absen");
		return $this->db->insert_id();
	}

	public function addBankSoal($data)
	{
		$dataInsert = DataStructure::slice($data, ['id_mapel', 'soal', 'pembahasan']);
		$this->db->insert('bank_soal', $dataInsert);
		ExceptionHandler::handleDBError($this->db->error(), "Insert", "bank_soal");
		$id_soal =  $this->db->insert_id();

		if (!empty($data['jawaban'])) {
			$token = bin2hex(openssl_random_pseudo_bytes(6));
			$this->db->set('token_opsi', $token);
			$this->db->set('id_bank_soal', $id_soal);
			$this->db->set('name_opsi', $data['jawaban']);
			$this->db->set('status', 'Y');
			$this->db->insert('bank_opsi');
		}

		if (!empty($data['opsi_1'])) {
			$token = bin2hex(openssl_random_pseudo_bytes(6));
			$this->db->set('token_opsi', $token);
			$this->db->set('id_bank_soal', $id_soal);
			$this->db->set('name_opsi', $data['opsi_1']);
			$this->db->set('status', 'N');
			$this->db->insert('bank_opsi');
		}

		if (!empty($data['opsi_2'])) {
			$token = bin2hex(openssl_random_pseudo_bytes(6));
			$this->db->set('token_opsi', $token);

			$this->db->set('id_bank_soal', $id_soal);
			$this->db->set('name_opsi', $data['opsi_2']);
			$this->db->set('status', 'N');
			$this->db->insert('bank_opsi');
		}

		if (!empty($data['opsi_3'])) {
			$token = bin2hex(openssl_random_pseudo_bytes(6));
			$this->db->set('token_opsi', $token);
			$this->db->set('id_bank_soal', $id_soal);
			$this->db->set('name_opsi', $data['opsi_3']);
			$this->db->set('status', 'N');
			$this->db->insert('bank_opsi');
		}

		if (!empty($data['opsi_4'])) {
			$token = bin2hex(openssl_random_pseudo_bytes(6));
			$this->db->set('token_opsi', $token);
			$this->db->set('id_bank_soal', $id_soal);
			$this->db->set('name_opsi', $data['opsi_4']);
			$this->db->set('status', 'N');
			$this->db->insert('bank_opsi');
		}

		return $id_soal;
	}


	public function editBankSoal($data)
	{
		$dataInsert = DataStructure::slice($data, ['id_mapel', 'soal', 'pembahasan']);
		$this->db->where('id_bank_soal', $data['id_bank_soal']);
		$this->db->update('bank_soal', $dataInsert);
		ExceptionHandler::handleDBError($this->db->error(), "Insert", "bank_soal");
		$id_soal =  $this->db->insert_id();

		if (!empty($data['jawaban'])) {
			// $this->db->set('id_bank_soal', $id_soal);
			$this->db->set('name_opsi', $data['jawaban']);
			// $this->db->set('status', 'Y');
			$this->db->where('id_opsi', $data['id_jawaban']);
			$this->db->update('bank_opsi');
		}

		if (!empty($data['opsi_1'])) {
			$this->db->set('name_opsi', $data['opsi_1']);
			$this->db->where('id_opsi', $data['id_opsi_1']);
			$this->db->update('bank_opsi');
		}

		if (!empty($data['opsi_2'])) {
			$this->db->set('name_opsi', $data['opsi_2']);
			$this->db->set('status', 'N');
			if (empty($data['id_opsi_2'])) {
				$token = bin2hex(openssl_random_pseudo_bytes(6));
				$this->db->set('token_opsi', $token);
				$this->db->set('id_bank_soal', $data['id_bank_soal']);
				$this->db->insert('bank_opsi');
			} else {
				$this->db->where('id_opsi', $data['id_opsi_2']);
				$this->db->update('bank_opsi');
			}
		}

		if (!empty($data['opsi_3'])) {
			$this->db->set('name_opsi', $data['opsi_3']);
			$this->db->set('status', 'N');
			if (empty($data['id_opsi_3'])) {
				$token = bin2hex(openssl_random_pseudo_bytes(6));
				$this->db->set('token_opsi', $token);
				$this->db->set('id_bank_soal', $data['id_bank_soal']);
				$this->db->insert('bank_opsi');
			} else {
				$this->db->where('id_opsi', $data['id_opsi_3']);
				$this->db->update('bank_opsi');
			}
		}

		if (!empty($data['opsi_4'])) {
			$this->db->set('name_opsi', $data['opsi_4']);
			$this->db->set('status', 'N');
			if (empty($data['id_opsi_4'])) {
				$token = bin2hex(openssl_random_pseudo_bytes(6));
				$this->db->set('token_opsi', $token);
				$this->db->set('id_bank_soal', $data['id_bank_soal']);
				$this->db->insert('bank_opsi');
			} else {
				$this->db->where('id_opsi', $data['id_opsi_4']);
				$this->db->update('bank_opsi');
			}
		}
	}
}
