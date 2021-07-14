<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

  public function getAllUser($filter = []){
		if(isset($filter['isSimple'])){
			$this->db->select('u.id_user, u.username, u.photo, u.nama, u.id_role');
		} else {
			$this->db->select("u.*, r.*");
		}
		$this->db->from('user as u');
		$this->db->join('role as r', 'r.id_role = u.id_role');
		// $this->db->join('kabupaten as k', 'k.id_kabupaten = u.id_kabupaten','left');

		if(isset($filter['username'])) $this->db->where('u.username', $filter['username']);
		if(isset($filter['id_user'])) $this->db->where('u.id_user', $filter['id_user']);
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_user');
	}

	public function getUser($idUser = NULL){
		$row = $this->getAllUser(['id_user' => $idUser]);
		if (empty($row)){
			throw new UserException("User yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
		}
		return $row[$idUser];
	}
	
	public function editPhoto($idUser,$newPhoto){
		$this->db->set('photo',$newPhoto);
		$this->db->where('id_user',$idUser);
		$this->db->update('user');
		return $newPhoto;
	}
	
	public function changePassword($data){
		$this->db->set('password',md5($data['password']));
		$this->db->where('id_user',$data['id_user']);
		$this->db->update('user');
		return 'succes';
	}
	public function editUser($tmpdata){
		$data = array( 
			'username' => $tmpdata['username'],
			'nama' => $tmpdata['nama'],
			);

		$this->db->set($data);
		$this->db->where('id_user',$tmpdata['id_user']);
		$this->db->update('user');
		
		return $tmpdata;
	}


	public function getUserByUsername($username = NULL){
		$row = $this->getAllUser(['username' => $username]);
		if (empty($row)){
			throw new UserException("User yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
		}
		return array_values($row)[0];
	}

  public function login($loginData){
	  	
		$user = $this->getUserByUsername($loginData['username']);
		if(md5($loginData['password']) !== $user['password'])
			throw new UserException("Password yang kamu masukkan salah.", WRONG_PASSWORD_CODE);
		return $user;
	}
}
