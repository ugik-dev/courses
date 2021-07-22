<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ParameterModel extends CI_Model
{


	public function calculateScore($data, $soal, $answer)
	{


		if ($data['poin_mode'] == 'avg') {
			$query = 'SELECT count(*) as benar from bank_soal  left join bank_opsi on bank_soal.id_bank_soal = bank_opsi.id_bank_soal 
			where bank_opsi.status = "Y" 
			and bank_soal.id_bank_soal in (' . $soal . ') and bank_opsi.token_opsi in (' . $answer . ') ';
			$res = $this->db->query($query);
			$res = $res->result_array();
			$benar = $res[0]['benar'];
			$ans = explode(',', $data['answer']);
			$count = count($ans);
			$score = $benar / $count * 100;
			$this->db->set('score', $score);
			$this->db->set('benar', $benar);
			$this->db->where('token', $data['token']);
			$this->db->update('session_exam_user');
		} else {
			$query = 'SELECT sum(poin) as score from bank_soal  left join bank_opsi on bank_soal.id_bank_soal = bank_opsi.id_bank_soal 
			where 
			 bank_soal.id_bank_soal in (' . $soal . ') and bank_opsi.token_opsi in (' . $answer . ') ';
			$res = $this->db->query($query);
			$res = $res->result_array();

			$query2 = 'SELECT count(*) as benar from bank_soal  left join bank_opsi on bank_soal.id_bank_soal = bank_opsi.id_bank_soal 
			where bank_opsi.status = "Y" 
			and bank_soal.id_bank_soal in (' . $soal . ') and bank_opsi.token_opsi in (' . $answer . ') ';
			$res2 = $this->db->query($query2);
			$res2 = $res2->result_array();



			$benar = $res2[0]['benar'];
			$score = $res[0]['score'];
			if ($data['id_mapel'] == '17') {
				$tiuquery = 'SELECT sum(poin) as score from bank_soal  left join bank_opsi on bank_soal.id_bank_soal = bank_opsi.id_bank_soal 
				where id_mapel = 14 and
				 bank_soal.id_bank_soal in (' . $soal . ') and bank_opsi.token_opsi in (' . $answer . ') ';
				$tiu = $this->db->query($tiuquery);
				$tiu = $tiu->result_array();

				$twkquery = 'SELECT sum(poin) as score from bank_soal  left join bank_opsi on bank_soal.id_bank_soal = bank_opsi.id_bank_soal 
				where id_mapel = 15 and
				 bank_soal.id_bank_soal in (' . $soal . ') and bank_opsi.token_opsi in (' . $answer . ') ';
				$twk = $this->db->query($twkquery);
				$twk = $twk->result_array();

				$tkpquery = 'SELECT sum(poin) as score from bank_soal  left join bank_opsi on bank_soal.id_bank_soal = bank_opsi.id_bank_soal 
				where id_mapel = 16 and
				 bank_soal.id_bank_soal in (' . $soal . ') and bank_opsi.token_opsi in (' . $answer . ') ';
				$tkp = $this->db->query($tkpquery);
				$tkp = $tkp->result_array();

				$score_arr = ((string)$tiu[0]['score'] ? (string)$tiu[0]['score'] : 0) . ',' . ((string)$twk[0]['score'] ? (string)$twk[0]['score'] : 0) . ',' . ((string)$tkp[0]['score'] ? (string)$tkp[0]['score'] : 0);
				$this->db->set('score_arr', $score_arr);
			}
			// $ans = explode(',', $data['answer']);

			// $count = count($ans);
			// $score = $benar / $count * 100;
			$this->db->set('score', $score);
			$this->db->set('benar', $benar);
			$this->db->where('token', $data['token']);
			$this->db->update('session_exam_user');
			// echo json_encode($data);
			// die();
		}
	}

	public function getYourHistory($filter = [])
	{
		$this->db->select("u.* ,r.*");
		$this->db->from('session_exam_user as u');
		$this->db->join('session_exam as r', 'r.id_session_exam = u.id_session_exam');
		// $this->db->join('kabupaten as k', 'k.id_kabupaten = u.id_kabupaten','left');

		if (!empty($filter['id_session_exam_user'])) $this->db->where('u.id_session_exam_user', $filter['id_session_exam_user']);
		if (!empty($filter['token'])) $this->db->where('u.token', $filter['token']);
		if (!empty($filter['id_user'])) $this->db->where('u.id_user', $filter['id_user']);
		if (!empty($filter['ip_address'])) $this->db->where('u.ip_address', $filter['ip_address']);
		$res = $this->db->get();
		if (!empty($filter['token'])) {
			return DataStructure::keyValue($res->result_array(), 'token');
		}
		return DataStructure::keyValue($res->result_array(), 'id_session_exam_user');
	}

	public function getExam($filter)
	{
		$this->db->select("u.* ,(limit_time + 1 ) as limit_time, poin_mode, r.id_mapel");
		$this->db->from('session_exam_user as u');
		$this->db->join('session_exam as r', 'r.id_session_exam = u.id_session_exam');
		// $this->db->join('kabupaten as k', 'k.id_kabupaten = u.id_kabupaten','left');

		if (!empty($filter['id_session_exam_user'])) $this->db->where('u.id_session_exam_user', $filter['id_session_exam_user']);
		if (!empty($filter['token'])) $this->db->where('u.token', $filter['token']);
		if (!empty($filter['id_user'])) $this->db->where('u.id_user', $filter['id_user']);
		if (!empty($filter['ip_address'])) $this->db->where('u.ip_address', $filter['ip_address']);
		$res = $this->db->get();
		if (!empty($filter['token'])) {
			return DataStructure::keyValue($res->result_array(), 'token');
		}
		return DataStructure::keyValue($res->result_array(), 'id_session_exam_user');
	}

	public function getAllUser($filter = [])
	{
		if (isset($filter['isSimple'])) {
			$this->db->select('u.id_user, u.username, u.photo, u.nama, u.id_role');
		} else {
			$this->db->select("u.*, r.*");
		}
		$this->db->from('user as u');
		$this->db->join('role as r', 'r.id_role = u.id_role');
		// $this->db->join('kabupaten as k', 'k.id_kabupaten = u.id_kabupaten','left');

		if (isset($filter['username'])) $this->db->where('u.username', $filter['username']);
		if (isset($filter['id_user'])) $this->db->where('u.id_user', $filter['id_user']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_user');
	}


	public function getAllBankSoal($filter = [])
	{
		if (!empty($filter['full']))
			$this->db->select("*");
		else {
			$this->db->select("*");
		}
		$this->db->from('bank_soal as u');
		$this->db->join('mapel as r', 'r.id_mapel = u.id_mapel');
		$this->db->join('bank_opsi as k', 'k.id_bank_soal = u.id_bank_soal', 'left');
		$this->db->where('k.status', 'Y');
		if (!empty($filter['id_bank_soal'])) $this->db->where('u.id_bank_soal', $filter['id_bank_soal']);
		if (!empty($filter['id_mapel'])) $this->db->where('u.id_mapel', $filter['id_mapel']);
		if (!empty($filter['limit'])) $this->db->limit($filter['limit']);
		if (!empty($filter['order_random'])) $this->db->order_by('rand()');
		$res = $this->db->get();
		if (!empty($filter['result_array'])) {
			return $res->result_array();
		}
		return DataStructure::keyValue($res->result_array(), 'id_bank_soal');
	}

	public function getShuffleSoal($id, $jawabn = false)
	{
		// if (!empty($filter['full']))
		$this->db->select("u.soal, u.image");
		$this->db->from('bank_soal as u');
		if ($jawabn) {
			$this->db->select("token_opsi,name_opsi,pembahasan,pembahasan_img");
			$this->db->join('bank_opsi as k', 'k.id_bank_soal = u.id_bank_soal', 'left');
			$this->db->where('k.status', 'Y');
		}
		// else {
		// 	$this->db->select("*");
		// }
		// $this->db->join('mapel as r', 'r.id_mapel = u.id_mapel');
		$this->db->where('u.id_bank_soal', $id);

		$res = $this->db->get();
		// if (!empty($filter['result_array'])) {
		$data['soal'] = $res->result_array()[0];

		$this->db->select("name_opsi,token_opsi");
		$this->db->from('bank_opsi as s');
		$this->db->where('s.id_bank_soal', $id);

		$res = $this->db->get();
		// if (!empty($filter['result_array'])) {
		$data['opsi'] = $res->result_array();
		if ($jawabn) {
		} else {
			shuffle($data['opsi']);
		}
		return $data;
		// }
		// return DataStructure::keyValue($res->result_array(), 'id_bank_soal');
	}


	public function getAllSession($filter = [])
	{
		$this->db->select("*");
		if (!empty($filter['full'])) {
		} else {
		}
		$this->db->from('session_exam as u');
		$this->db->join('mapel as r', 'r.id_mapel = u.id_mapel');
		// $this->db->join('bank_opsi as k', 'k.id_bank_soal = u.id_bank_soal', 'left');
		// $this->db->where('k.status', 'Y');
		// if (!empty($filter['id_bank_soal'])) $this->db->where('u.id_bank_soal', $filter['id_bank_soal']);
		if (!empty($filter['id_mapel'])) $this->db->where('u.id_mapel', $filter['id_mapel']);
		if (!empty($filter['id_session_exam'])) $this->db->where('u.id_session_exam', $filter['id_session_exam']);
		// if (isset($filter['id_user'])) $this->db->where('u.id_user', $filter['id_user']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_session_exam');
	}

	public function getAvaliableSession($filter = [])
	{
		$cur_date = date('Y-m-d H:i:s');
		// echo $cur_date;
		// die();
		$this->db->select("*");
		// if (!empty($filter['full'])) {
		// } else {
		// }
		$this->db->from('session_exam as u');
		$this->db->join('mapel as r', 'r.id_mapel = u.id_mapel');
		// $this->db->join('bank_opsi as k', 'k.id_bank_soal = u.id_bank_soal', 'left');
		$this->db->where('u.open_start <=', $cur_date);
		$this->db->where('u.open_end >=', $cur_date);
		// if (!empty($filter['id_bank_soal'])) $this->db->where('u.id_bank_soal', $filter['id_bank_soal']);
		if (!empty($filter['id_mapel'])) $this->db->where('u.id_mapel', $filter['id_mapel']);
		if (!empty($filter['id_session_exam'])) $this->db->where('u.id_session_exam', $filter['id_session_exam']);
		// if (isset($filter['id_user'])) $this->db->where('u.id_user', $filter['id_user']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_session_exam');
	}


	public function getOpsi($filter = [])
	{
		if (!empty($filter['full']))
			$this->db->select("*");
		else {
		}
		$this->db->from('bank_opsi as u');
		// $this->db->join('mapel as r', 'r.id_mapel = u.id_mapel');
		// $this->db->join('kabupaten as k', 'k.id_kabupaten = u.id_kabupaten','left');

		// if (isset($filter['username'])) $this->db->where('u.username', $filter['username']);
		if (!empty($filter['id_bank_soal'])) $this->db->where('u.id_bank_soal', $filter['id_bank_soal']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_opsi');
	}


	public function getAllTahunAjaran($filter = [])
	{
		// if(isset($filter['isSimple'])){
		//     $this->db->select('u.id_user, u.username, u.photo, u.nama, u.id_role');
		// } else {
		// }
		$this->db->select("u.*");
		$this->db->from('tahun_ajaran as u');
		// $this->db->join('role as r', 'r.id_role = u.id_role');
		// $this->db->join('kabupaten as k', 'k.id_kabupaten = u.id_kabupaten','left');

		// if(isset($filter['username'])) $this->db->where('u.username', $filter['username']);
		if (!empty($filter['id_tahun_ajaran'])) $this->db->where('u.id_tahun_ajaran', $filter['id_tahun_ajaran']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_tahun_ajaran');
	}




	public function getAllMapel($filter = [])
	{
		$this->db->select("u.*");
		$this->db->from('mapel as u');
		// $this->db->join('role as r', 'r.id_role = u.id_role');
		// $this->db->join('kabupaten as k', 'k.id_kabupaten = u.id_kabupaten','left');
		$this->db->where('u.status', 1);
		if (!empty($filter['id_mapel'])) $this->db->where('u.id_mapel', $filter['id_mapel']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_mapel');
	}

	public function getAllKelas($filter = [])
	{
		$this->db->select("*");
		$this->db->from('jenis_kelas as u');
		$this->db->join('jenis_jurusan as r', 'r.id_jenis_jurusan = u.id_jenis_jurusan');
		// $this->db->join('kabupaten as k', 'k.id_kabupaten = u.id_kabupaten','left');

		if (!empty($filter['id_jenis_kelas'])) $this->db->where('u.id_jenis_kelas', $filter['id_jenis_kelas']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_jenis_kelas');
	}

	public function getAllJurusan($filter = [])
	{
		$this->db->select("*");
		$this->db->from('jenis_jurusan as u');
		// $this->db->join('jenis_jurusan as r', 'r.id_jenis_jurusan = u.id_jenis_jurusan');
		// $this->db->join('kabupaten as k', 'k.id_kabupaten = u.id_kabupaten','left');

		if (!empty($filter['id_jenis_jurusan'])) $this->db->where('u.id_jenis_jurusan', $filter['id_jenis_jurusan']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_jenis_jurusan');
	}


	public function getAllMapelJurusan($filter = [])
	{
		$this->db->select("*");
		$this->db->from('v3_fix_mapel_jurusaan as u');


		if (!empty($filter['id_jenis_jurusan'])) $this->db->where('u.id_jenis_jurusan', $filter['id_jenis_jurusan']);
		if (!empty($filter['kelas'])) $this->db->where('u.kelas', $filter['kelas']);
		if (!empty($filter['id_mapel_jurusan'])) $this->db->where('u.id_mapel_jurusan', $filter['id_mapel_jurusan']);
		$res = $this->db->get();
		return $res->result_array();
	}

	public function getAllV0Mapping($filter = [])
	{
		$this->db->select("*");

		$this->db->from('mapping as u');
		$this->db->join('tahun_ajaran as ta', 'ta.id_tahun_ajaran = u.id_tahun_ajaran');
		$this->db->join('jenis_kelas as jk', 'jk.id_jenis_kelas = u.id_jenis_kelas');
		$this->db->join('jenis_jurusan as jj', 'jj.id_jenis_jurusan = jk.id_jenis_jurusan');
		if ($this->session->userdata()['nama_role'] == 'guru') {
			$this->db->where('u.id_wali_kelas', $this->session->userdata()['id_user']);
		}
		// echo $this->session->userdata()['nama_role'];
		if (!empty($filter['id_mapping'])) $this->db->where('u.id_mapping', $filter['id_mapping']);
		if (!empty($filter['id_jenis_jurusan'])) $this->db->where('u.id_jenis_jurusan', $filter['id_jenis_jurusan']);
		if (!empty($filter['id_tahun_ajaran'])) $this->db->where('u.id_tahun_ajaran', $filter['id_tahun_ajaran']);
		// if (!empty($filter['id_mapel_jurusan'])) $this->db->where('u.id_mapel_jurusan', $filter['id_mapel_jurusan']);
		$res = $this->db->get();
		return $res->result_array();
	}

	public function getAllSiswa($filter = [])
	{
		$this->db->select("*");

		$this->db->from('v1_siswa as u');

		if (!empty($filter['id_user'])) $this->db->where('u.id_user', $filter['id_user']);
		// if (!empty($filter['id_jenis_jurusan'])) $this->db->where('u.id_jenis_jurusan', $filter['id_jenis_jurusan']);
		// if (!empty($filter['kelas'])) $this->db->where('u.kelas', $filter['kelas']);
		// if (!empty($filter['id_mapel_jurusan'])) $this->db->where('u.id_mapel_jurusan', $filter['id_mapel_jurusan']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_user');

		// return $res->result_array();
	}

	public function getAllSiswaMapping($filter = [])
	{
		$this->db->select("*");

		$this->db->from('mapping_siswa as u');

		if (!empty($filter['id_mapping'])) $this->db->where('u.id_mapping', $filter['id_mapping']);
		// if (!empty($filter['id_jenis_jurusan'])) $this->db->where('u.id_jenis_jurusan', $filter['id_jenis_jurusan']);
		// if (!empty($filter['kelas'])) $this->db->where('u.kelas', $filter['kelas']);
		// if (!empty($filter['id_mapel_jurusan'])) $this->db->where('u.id_mapel_jurusan', $filter['id_mapel_jurusan']);
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_mapping_siswa');

		// return $res->result_array();
	}



	public function getAllMappingKelasChat($filter = [])
	{
		$this->db->select("id_chat, id_mapping_kelas, u.id_user, SUBSTRING(date, 1,16) as date, text_message , k.nama, k.username, k.photo");

		$this->db->from('chat_mapping_kelas as u');
		$this->db->join('user as k', 'k.id_user = u.id_user', 'Left');

		$this->db->where('u.id_mapping_kelas', $filter['id_mapping_kelas']);
		if (!empty($filter['last'])) $this->db->where('u.id_chat > ' . $filter['last']);
		// if (!empty($filter['kelas'])) $this->db->where('u.kelas', $filter['kelas']);
		$this->db->limit('10', 'DESC');
		$this->db->order_by('id_chat', 'DESC');
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_chat');

		// return $res->result_array();
	}

	public function getLoadMoreMappingKelasChat($filter = [])
	{
		$this->db->select("id_chat, id_mapping_kelas, u.id_user, SUBSTRING(date, 1,16) as date, text_message , k.nama, k.username, k.photo");

		$this->db->from('chat_mapping_kelas as u');
		$this->db->join('user as k', 'k.id_user = u.id_user', 'Left');

		$this->db->where('u.id_mapping_kelas', $filter['id_mapping_kelas']);
		$this->db->where('u.id_chat < ' . $filter['first']);
		// if (!empty($filter['kelas'])) $this->db->where('u.kelas', $filter['kelas']);
		$this->db->limit('4', 'DESC');
		$this->db->order_by('id_chat', 'DESC');
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_chat');

		// return $res->result_array();
	}



	public function getAllAbsen($filter = [])
	{
		$this->db->select("*");

		$this->db->from('v1_absen as u');

		if (!empty($filter['id_mapping'])) $this->db->where('u.id_mapping', $filter['id_mapping']);
		$this->db->where("u.tgl like '" . $filter['tb'] . "%'");
		// if (!empty($filter['kelas'])) $this->db->where('u.kelas', $filter['kelas']);
		// if (!empty($filter['id_mapel_jurusan'])) $this->db->where('u.id_mapel_jurusan', $filter['id_mapel_jurusan']);
		$res = $this->db->get();
		// return DataStructure::keyValue($res->result_array(), 'id_mapping_siswa');
		return DataStructure::groupByRecursive2(
			$res->result_array(),
			['id_siswa'],
			['tgl'],
			[
				[],
				['tgl', 'status_absensi', 'id_absen', 'id_siswa', 'id_mapping_siswa', 'id_mapping']
			],
			['tgl']
		);

		// return $res->result_array();
	}

	public function getAllV4Mapping($filter = [])
	{
		$this->db->select("*");
		$this->db->from('v4_mapping as u');


		if (!empty($filter['id_mapping'])) $this->db->where('u.id_mapping', $filter['id_mapping']);
		if (!empty($filter['id_jenis_jurusan'])) $this->db->where('u.id_jenis_jurusan', $filter['id_jenis_jurusan']);
		if (!empty($filter['kelas'])) $this->db->where('u.kelas', $filter['kelas']);
		if (!empty($filter['id_mapel_jurusan'])) $this->db->where('u.id_mapel_jurusan', $filter['id_mapel_jurusan']);
		$res = $this->db->get();
		return $res->result_array();
	}


	public function getAllV5Mapping($filter = [])
	{
		$this->db->select("*");
		$this->db->from('v5_mapping as u');


		if (!empty($filter['id_mapping'])) $this->db->where('u.id_mapping', $filter['id_mapping']);
		if (!empty($filter['id_jenis_jurusan'])) $this->db->where('u.id_jenis_jurusan', $filter['id_jenis_jurusan']);
		if (!empty($filter['kelas'])) $this->db->where('u.kelas', $filter['kelas']);
		if (!empty($filter['id_mapel_jurusan'])) $this->db->where('u.id_mapel_jurusan', $filter['id_mapel_jurusan']);
		$res = $this->db->get();
		return $res->result_array();
	}



	public function getAllMapping($filter = [])
	{
		$this->db->select("*");

		$this->db->from('v2_ta as m');
		// $this->db->join('tahun_ajaran as ta', 'ta.id_tahun_ajaran = m.id_tahun_ajaran');
		$this->db->join('jenis_kelas as k', 'k.id_jenis_kelas = m.id_jenis_kelas', 'left');
		$this->db->join('jenis_jurusan as j', 'k.id_jenis_jurusan = j.id_jenis_jurusan', 'left');

		// if(isset($filter['username'])) $this->db->where('u.username', $filter['username']);
		if (!empty($filter['id_tahun_ajaran'])) $this->db->where('m.id_tahun_ajaran', $filter['id_tahun_ajaran']);
		if (!empty($filter['id_jenis_jurusan'])) $this->db->where('m.id_jenis_jurusan', $filter['id_jenis_jurusan']);
		if (!empty($filter['id_kelas'])) $this->db->where('m.nama_jenis_kelas', $filter['id_kelas']);
		if (!empty($filter['id_mapping'])) $this->db->where('m.id_mapping', $filter['id_mapping']);
		$res = $this->db->get();
		return $res->result_array();
	}


	public function addMapel($data)
	{
		$dataInsert = DataStructure::slice($data, ['nama_mapel', 'status']);
		$this->db->insert('mapel', $dataInsert);
		ExceptionHandler::handleDBError($this->db->error(), "Insert mapel", "mapel");
		return $this->db->insert_id();
	}

	public function editMapel($data)
	{
		$dataInsert = DataStructure::slice($data, ['nama_mapel', 'status']);
		$this->db->set($dataInsert);
		$this->db->where('id_mapel', $data['id_mapel']);
		$this->db->update('mapel');
		ExceptionHandler::handleDBError($this->db->error(), "Insert mapel", "mapel");

		return $data['id_mapel'];
	}


	public function deleteMapel($data)
	{
		$this->db->where('id_mapel', $data['id_mapel']);
		$this->db->delete('mapel');
		ExceptionHandler::handleDBError($this->db->error(), "Insert mapel", "mapel");

		return $data['id_mapel'];
	}

	public function addKelas($data)
	{
		$dataInsert = DataStructure::slice($data, ['nama_jenis_kelas', 'id_jenis_jurusan', 'sub_kelas']);
		$this->db->insert('jenis_kelas', $dataInsert);
		ExceptionHandler::handleDBError($this->db->error(), "Insert mapel", "jenis_kelas");
		return $this->db->insert_id();
	}

	public function editKelas($data)
	{
		$dataInsert = DataStructure::slice($data, ['nama_jenis_kelas', 'id_jenis_jurusan', 'sub_kelas']);
		$this->db->set($dataInsert);
		$this->db->where('id_jenis_kelas', $data['id_jenis_kelas']);
		$this->db->update('jenis_kelas');
		ExceptionHandler::handleDBError($this->db->error(), "Insert mapel", "jenis_kelas");

		return $data['id_jenis_kelas'];
	}


	public function deleteKelas($data)
	{
		$this->db->where('id_jenis_kelas', $data['id_jenis_kelas']);
		$this->db->delete('jenis_kelas');
		ExceptionHandler::handleDBError($this->db->error(), "Insert mapel", "jenis_kelas");

		return $data['id_jenis_kelas'];
	}

	public function getUser($idUser = NULL)
	{
		$row = $this->getAllUser(['id_user' => $idUser]);
		if (empty($row)) {
			throw new UserException("User yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
		}
		return $row[$idUser];
	}

	public function editPhoto($idUser, $newPhoto)
	{
		$this->db->set('photo', $newPhoto);
		$this->db->where('id_user', $idUser);
		$this->db->update('user');
		return $newPhoto;
	}

	public function getUserByUsername($username = NULL)
	{
		$row = $this->getAllUser(['username' => $username]);
		if (empty($row)) {
			throw new UserException("User yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
		}
		return array_values($row)[0];
	}

	public function addTA($data)
	{
		$dataInsert = DataStructure::slice($data, ['deskripsi', 'semester', 'start', 'end']);
		$this->db->insert('tahun_ajaran', $dataInsert);
		ExceptionHandler::handleDBError($this->db->error(), "Add Tahun Ajaran", "tahun_ajaran");
		return $this->db->insert_id();
	}

	public function SubmitExam($data)
	{
		// var_dump($data);
		// die();
		// $data['id_user'] = $this->session->userdata()['id_user'];
		// $data['token'] = bin2hex(openssl_random_pseudo_bytes(32));
		// $dataInsert = DataStructure::slice($data, ['id_session_exam', 'id_user', 'generate_soal', 'token']);
		if ($data['autosave'] == 'false') {
			$this->db->set('exam_lock', 'Y');
		}
		if (!empty($this->session->userdata()['id_user']))
			$this->db->where('id_user', $this->session->userdata('id_user'));
		// $filter['id_user'] = $this->session->userdata()['id_user'];
		else
			$this->db->where('ip_address', $this->input->ip_address());
		// $filter['ip_address'] = $this->input->ip_address();

		$this->db->set('answer', $data['answer']);
		$this->db->where('token', $data['token']);
		$this->db->update('session_exam_user');
		ExceptionHandler::handleDBError($this->db->error(), "Save Session", "save_session");
		// return $this->db->insert_id();
	}

	public function createExam($data)
	{
		if (!empty($this->session->userdata()['id_user']))
			$data['id_user'] = $this->session->userdata()['id_user'];
		else
			$data['ip_address'] =  $this->input->ip_address();
		$data['token'] = bin2hex(openssl_random_pseudo_bytes(32));
		$dataInsert = DataStructure::slice($data, ['id_session_exam', 'id_user', 'generate_soal', 'token', 'ip_address']);
		$this->db->insert('session_exam_user', $dataInsert);
		ExceptionHandler::handleDBError($this->db->error(), "Create Session", "create_session");
		return $this->db->insert_id();
	}

	public function editTA($data)
	{
		$dataInsert = DataStructure::slice($data, ['deskripsi', 'semester', 'start', 'end']);
		$this->db->set($dataInsert);
		$this->db->where('id_tahun_ajaran', $data['id_tahun_ajaran']);
		$this->db->update('tahun_ajaran');
		ExceptionHandler::handleDBError($this->db->error(), "Update Tahun Ajaran", "jenis_kelas");

		return $data['id_tahun_ajaran'];
	}

	public function set_current_ta($data)
	{
		// $dataInsert = DataStructure::slice($data, ['deskripsi', 'semester', 'start' , 'end']);
		$this->db->set("current", "1");
		$this->db->where('current', "2");
		$this->db->update('tahun_ajaran');
		ExceptionHandler::handleDBError($this->db->error(), "Update Tahun Ajaran", "jenis_kelas");

		$this->db->set("current", "2");
		$this->db->where('id_tahun_ajaran', $data['id_tahun_ajaran']);
		$this->db->update('tahun_ajaran');
		ExceptionHandler::handleDBError($this->db->error(), "Update Tahun Ajaran", "jenis_kelas");


		return $data['id_tahun_ajaran'];
	}


	public function deleteTA($data)
	{
		$this->db->where('id_tahun_ajaran', $data['id_tahun_ajaran']);
		$this->db->delete('tahun_ajaran');
		ExceptionHandler::handleDBError($this->db->error(), "Delete Tahun Ajaran", "tahun_ajaran");

		return $data['id_tahun_ajaran'];
	}
}
