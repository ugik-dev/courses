<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SiswaController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('SiswaModel','GuruModel'));

        $this->load->helper(array('DataStructure', 'Validation'));
    }

    public function index()
    {
        $this->SecurityModel->roleOnlyGuard('siswa');
        // $data = $this->SiswaModel->getKelasSaya();
        // echo json_encode($data);
        $pageData = array(
            'title' => 'Kelas Saya',
            'content' => 'siswa/ForumSaya',
            'breadcrumb' => array(
                'Home' => base_url(),
            ),

        );
        $this->load->view('Page', $pageData);
    }

    public function getKelasSaya()
    {
        $this->SecurityModel->userOnlyGuard();
        try {
            $data = $this->SiswaModel->getKelasSaya();
            echo json_encode(array('data' => $data));
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
        $this->SecurityModel->roleOnlyGuard('siswa');
        $id = $this->input->get()['id_mapping_kelas'];
        $data = $this->GuruModel->GetAllForum(array('id_mapping_kelas' => $id));
        $data = $data[0];
        // var_dump($data);
        $pageData = array(
            'title' => $data['kelas'] . " " . $data['nama_jenis_jurusan'] . " " . $data['sub_kelas'] . " :: " . $data['nama_mapel'],
            'content' => 'siswa/Forum',
            'breadcrumb' => array(
                'Home' => base_url(),
            ),
            'contentData' => $data
        );
        $this->load->view('Page', $pageData);
    }

    public function task()
    {
        $this->SecurityModel->roleOnlyGuard('siswa');
        $id = $this->input->get()['id_task'];
        $data = $this->GuruModel->getAllTask(array('id_task' => $id));
        $data = $data[$id];
        // var_dump($data);
        $pageData = array(
            'title' => 'Task  :: ' . $data['kelas'] . " " . $data['nama_jenis_jurusan'] . " " . $data['sub_kelas'] . " :: " . $data['nama_mapel'],
            'content' => 'siswa/Task',
            'breadcrumb' => array(
                'Home' => base_url(),
                'Forum' => base_url('SiswaController/forum?id_mapping_kelas=' . $data['id_mapping_kelas']),
            ),
            'contentData' => $data
        );
        $this->load->view('Page', $pageData);
    }


    public function GetForumSaya()
    {
        try {
            $this->SecurityModel->roleOnlyGuard('siswa');
            $data = $this->SiswaModel->GetForumSaya($this->input->post());
            echo json_encode(array('data' => $data));
        } catch (Exception $e) {
            ExceptionHandler::handle($e);
        }
    }

    public function getMyTask()
    {
        try {
            $this->SecurityModel->roleOnlyGuard('siswa');
            $data = $this->SiswaModel->getMyTask($this->input->get());
            echo json_encode(array('data' => $data[0]));
        } catch (Exception $e) {
            ExceptionHandler::handle($e);
        }
    }

    public function getAllSiswaMappingTask()
    {
        try {
            $this->SecurityModel->roleOnlyGuard('guru');
            $data = $this->GuruModel->getAllSiswaMappingTask($this->input->post());
            echo json_encode(array('data' => $data));
        } catch (Exception $e) {
            ExceptionHandler::handle($e);
        }
    }



    public function getAllTask()
    {
        try {
            $this->SecurityModel->roleOnlyGuard('guru');
            $data = $this->GuruModel->getAllTask($this->input->post());
            echo json_encode(array('data' => $data));
        } catch (Exception $e) {
            ExceptionHandler::handle($e);
        }
    }


    public function submit_task()
    {
        try {
            $this->SecurityModel->rolesOnlyGuard(array('siswa'), true);
            $data = $this->input->post();

            $data['submit_dokumen'] = FileIO::genericUpload('submit_dokumen', array('png', 'jpeg', 'jpg', 'pdf', 'doc', 'docx'), '', $data);

            // if(!empty($data['id_submit_task'])){

                $this->SiswaModel->submit_task($data);
            // }else{
                // $this->SiswaModel->edit_submit_task($data);
                
            // }
            // $this->KelolahmapelModel->getKelolahuser($idKelolahuser);
            echo json_encode(array('data' => $data));
        } catch (Exception $e) {
            ExceptionHandler::handle($e);
        }
    }

    public function update_task()
    {
        try {
            $this->SecurityModel->rolesOnlyGuard(array('siswa'), true);
            $data = $this->input->post();
            $data['submit_dokumen'] = FileIO::genericUpload('submit_dokumen', array('png', 'jpeg', 'jpg', 'pdf', 'doc', 'docx'), '', $data);

            $this->SiswaModel->update_task($data);
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
