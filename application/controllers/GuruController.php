<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GuruController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('AdminModel', 'GuruModel'));

    $this->load->helper(array('DataStructure', 'Validation'));
  }

  public function index()
  {
    $this->SecurityModel->roleOnlyGuard('guru');
    $pageData = array(
      'title' => 'Kelas Saya',
      'content' => 'guru/KelasSaya',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }

  public function absensi_fragment()
  {
    $this->SecurityModel->userOnlyGuard();
    try {
      $pageData = array(
        "contentData" => ['id_pengiriman' => $this->input->get()['id_pengiriman']]
      );
      $this->load->view('detail_pengiriman_fragment/MutuFragment', $pageData);
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }

  public function panduan()
  {
    $this->SecurityModel->roleOnlyGuard('Guru');
    $pageData = array(
      'title' => 'Panduan',
      'content' => 'guru/PanduanPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
      'contentData' => array(),
    );
    $this->load->view('Page', $pageData);
  }



  public function kelas_saya()
  {
    $this->SecurityModel->roleOnlyGuard('guru');
    $pageData = array(
      'title' => 'Kelas Saya',
      'content' => 'guru/KelasSaya',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
      'contentData' => array(),
    );
    $this->load->view('Page', $pageData);
  }

  public function forum_saya()
  {
    $this->SecurityModel->roleOnlyGuard('guru');
    $pageData = array(
      'title' => 'Forum Saya',
      'content' => 'guru/ForumSaya',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
      'contentData' => array(),
    );
    $this->load->view('Page', $pageData);
  }



  public function save_absen()
  {
    try {
      // $this->SecurityModel->userOnlyGuard(TRUE);
      $this->SecurityModel->roleOnlyGuard('guru');
      $data = $this->input->post();
      // echo $data['id_mapping_siswa'];

      $data_post['id_mapping_siswa'] = $data['id_mapping_siswa'];
      $data_post['count_date'] = $data['count_date'];
      $data_post['count_siswa'] = $data['count_siswa'];
      $temp['id_mapping_siswa'] = $data['id_mapping_siswa'];

      for ($i = 0; $i < $data_post['count_siswa']; $i++) {
        // echo $data['row_'.$i];
        for ($j = 0; $j < $data_post['count_date']; $j++) {
          $temp['tgl'] = $data['date_' . $j];
          $temp['id_siswa'] = $data['row_' . $i];
          if (!empty($data[$temp['id_siswa'] . '_' . $temp['tgl']])) {
            if (!empty($data[$temp['id_siswa'] . '_' . $temp['tgl'] . '_id_absensi'])) {

              $temp['id_absen'] = $data[$temp['id_siswa'] . '_' . $temp['tgl'] . '_id_absensi'];
              $temp['status_absensi'] = $data[$temp['id_siswa'] . '_' . $temp['tgl']];
              $this->AdminModel->update_absen($temp);
            } else {
              $temp['id_mapping_siswa'] = $data['ims_' . $i];

              $temp['status_absensi'] = $data[$temp['id_siswa'] . '_' . $temp['tgl']];
              $this->AdminModel->add_absen($temp);
            }
          };
        }
      }

      echo json_encode(array('data' => $temp));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }

  public function evaluasi_task()
  {
    try {
      // $this->SecurityModel->userOnlyGuard(TRUE);
      $this->SecurityModel->roleOnlyGuard('guru');
      $data = $this->input->post();
      // echo $data['id_mapping_siswa'];

      $temp['id_task'] = $data['id_task'];

      for ($i = 0; $i <  $data['jumlah']; $i++) {
        // echo $data['row_'.$i];
        if (empty($data['id_submit_task_' . $i])) {

          $temp['id_submit_task'] = $data['id_submit_task_' . $i];
          $temp['id_siswa'] = $data['id_siswa_' . $i];
          $temp['nilai'] = $data['nilai_' . $i];
          $temp['evaluasi'] = $data['evaluasi_' . $i];
          if (!empty($data['nilai_' . $i]) || !empty($data['evaluasi_' . $i])) {
            $this->GuruModel->addEvaluasi($temp);
          } 
        } else {
          $temp['id_submit_task'] = $data['id_submit_task_' . $i];
          $temp['id_siswa'] = $data['id_siswa_' . $i];
          $temp['nilai'] = $data['nilai_' . $i];
          $temp['evaluasi'] = $data['evaluasi_' . $i];
          $this->GuruModel->updateEvaluasi($temp);
        }
      }

      echo json_encode(array('data' => $temp));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }
  public function Message()
  {
    $this->SecurityModel->roleOnlyGuard('Guru');
    $pageData = array(
      'title' => 'Mail Box',
      'content' => 'guru/Message',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }


  // public function statistikCagarbudaya(){
  //   $this->SecurityModel->roleOnlyGuard('Guru');
  //   $pageData = array(
  //     'title' => 'Statistik Cagar Budaya',
  //     'content' => 'guru/StatistikCagarbudaya',
  //     'breadcrumb' => array(
  //       'Home' => base_url(),
  //     ),
  //   );
  //   $this->load->view('Page', $pageData);
  // }


  public function forum()
  {
    $this->SecurityModel->roleOnlyGuard('guru');
    $id = $this->input->get()['id_mapping_kelas'];
    $data = $this->GuruModel->GetAllForum(array('id_mapping_kelas' => $id));
    $data = $data[0];
    // var_dump($data);
    $pageData = array(
      'title' => $data['kelas'] . " " . $data['nama_jenis_jurusan'] . " " . $data['sub_kelas'] . " :: " . $data['nama_mapel'],
      'content' => 'guru/Forum',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
      'contentData' => $data
    );
    $this->load->view('Page', $pageData);
  }

  public function task()
  {
    $this->SecurityModel->rolesOnlyGuard(array('guru'));
    $id = $this->input->get()['id_task'];
    $data = $this->GuruModel->getAllTask(array('id_task' => $id));
    $data = $data[$id];
    // var_dump($data);
    $pageData = array(
      'title' => 'Task  :: ' . $data['kelas'] . " " . $data['nama_jenis_jurusan'] . " " . $data['sub_kelas'] . " :: " . $data['nama_mapel'],
      'content' => 'guru/Task',
      'breadcrumb' => array(
        'Home' => base_url(),
        'Forum' => base_url('GuruController/forum?id_mapping_kelas=' . $data['id_mapping_kelas']),
      ),
      'contentData' => $data
    );
    $this->load->view('Page', $pageData);
  }


  public function GetForumSaya()
  {
    try {
      $this->SecurityModel->roleOnlyGuard('guru');
      $data = $this->GuruModel->GetAllForum($this->input->post());
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }

  public function getAllSiswaMapping()
  {
    try {
      $this->SecurityModel->rolesOnlyGuard(array('guru','siswa','admin'));
      $data = $this->GuruModel->getAllSiswaMapping($this->input->post());
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }

  public function getAllSiswaMappingTask()
  {
    try {
      $this->SecurityModel->rolesOnlyGuard(array('guru','siswa','admin'));
      $data = $this->GuruModel->getAllSiswaMappingTask($this->input->post());
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }



  public function getAllTask()
  {
    try {
      $this->SecurityModel->rolesOnlyGuard(array('guru','siswa','admin'));
      $data = $this->GuruModel->getAllTask($this->input->post());
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }


  public function create_task()
  {
    try {
      $this->SecurityModel->rolesOnlyGuard(array('guru'), true);
      $data = $this->input->post();

      $data['task_dokumen'] = FileIO::genericUpload('task_dokumen', array('png', 'jpeg', 'jpg', 'pdf', 'doc', 'docx'), '', $data);

      $this->GuruModel->create_task($data);
      // $this->KelolahmapelModel->getKelolahuser($idKelolahuser);
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }

  public function edit_task()
  {
    try {
      $this->SecurityModel->rolesOnlyGuard(array('guru'), true);
      $data = $this->input->post();
      $data['task_dokumen'] = FileIO::genericUpload('task_dokumen', array('png', 'jpeg', 'jpg', 'pdf', 'doc', 'docx'), '', $data);

      $this->GuruModel->edit_task($data);
      // $this->KelolahmapelModel->getKelolahuser($idKelolahuser);
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }

  public function delete_task()
  {
    try {
      $this->SecurityModel->rolesOnlyGuard(array('guru'), true);
      $data = $this->input->post();
      $this->GuruModel->delete_task($data);
      // $this->KelolahmapelModel->getKelolahuser($idKelolahuser);
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }










































  public function DetailMessage()
  {
    $this->SecurityModel->roleOnlyGuard('Guru');
    $pageData = array(
      'title' => 'Mail Box',
      'content' => 'guru/DetailMessage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
      'contentData' => ['id_message' => $this->input->get()['id_message']]
    );
    $this->load->view('Page', $pageData);
  }
}
