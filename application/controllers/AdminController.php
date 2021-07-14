<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('AdminModel', 'ParameterModel'));
  }

  public function index()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Beranda',
      'content' => 'Dashboard',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }

  public function panduan()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Panduan',
      'content' => 'admin/PanduanPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
      'contentData' => array(),
    );
    $this->load->view('Page', $pageData);
  }

  public function getAllKabupaten()
  {
    try {
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->AdminModel->getAllKabupaten($this->input->get());
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }
  public function Message()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Mail Box',
      'content' => 'admin/Message',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }

  public function Mapping()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Mapping',
      'content' => 'admin/Mapping',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }


  public function SetKelas()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Setting Kelas',
      'content' => 'admin/SetKelas',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }

  public function BankSoal()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Bank Soall',
      'content' => 'admin/BankSoal',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }

  public function SetMapel()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Setting Mata Pelajaran',
      'content' => 'admin/SetMapel',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }
  public function SetTA()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Setting Tahun Ajaran',
      'content' => 'admin/SetTA',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }

  public function Kelolahuser()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Kelolah Pegawai',
      'content' => 'admin/Kelolahuser',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }

  public function Kelolahsiswa()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Kelolah Siswa',
      'content' => 'admin/Kelolahsiswa',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }


  public function KelolahMapel()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Kelolah Mapel',
      'content' => 'admin/KelolahMapel',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }

  public function OpenSession()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Kelolah Mapel',
      'content' => 'admin/OpenSession',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }

  public function MappingMapel()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Mapping Mapel Jurusan',
      'content' => 'admin/tapmapping/MapelKelas',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }

  public function DetailMapping()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $id = $this->input->get()['id_mapping'];
    $tmp = $this->ParameterModel->getAllMapping(array('id_mapping' => $this->input->get()['id_mapping']));
    // var_dump($tmp);
    $pageData = array(
      'title' => $tmp[0]['nama_jenis_kelas'] . ' ' . $tmp[0]['nama_jenis_jurusan'] . ' ' . $tmp[0]['sub_kelas'] . ' :: ' . $tmp[0]['deskripsi'] . ' (Semester ' . $tmp[0]['semester'] . ')',
      'content' => 'admin/DetailMapping',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
      'contentData' => ['id_mapping' => $this->input->get()['id_mapping']]
    );
    $this->load->view('Page', $pageData);
  }

  public function DetailKelas()
  {
    $this->SecurityModel->roleOnlyGuard('guru');
    $id = $this->input->get()['id_mapping'];
    $tmp = $this->ParameterModel->getAllMapping(array('id_mapping' => $this->input->get()['id_mapping']));
    // var_dump($tmp);
    $pageData = array(
      'title' => $tmp[0]['nama_jenis_kelas'] . ' ' . $tmp[0]['nama_jenis_jurusan'] . ' ' . $tmp[0]['sub_kelas'] . ' :: ' . $tmp[0]['deskripsi'] . ' (Semester ' . $tmp[0]['semester'] . ')',
      'content' => 'guru/DetailKelas',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
      'contentData' => ['id_mapping' => $this->input->get()['id_mapping']]
    );
    $this->load->view('Page', $pageData);
  }

  public function Transportasi()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Transportasi',
      'content' => 'admin/Transportasi',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }

  public function Cagarbudaya()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Cagar dan Budaya',
      'content' => 'admin/Cagarbudaya',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }
  // public function statistikCagarbudaya(){
  //   $this->SecurityModel->roleOnlyGuard('admin');
  //   $pageData = array(
  //     'title' => 'Statistik Cagar Budaya',
  //     'content' => 'admin/StatistikCagarbudaya',
  //     'breadcrumb' => array(
  //       'Home' => base_url(),
  //     ),
  //   );
  //   $this->load->view('Page', $pageData);
  // }


  public function getAllBankSoal()
  {

    $this->SecurityModel->roleOnlyGuard('admin');
    $filter = $this->input->post();
    $filter['full'] = true;
    $data = $this->ParameterModel->getAllBankSoal($filter);
    echo json_encode(array('data' => $data));
    // $this->load->view('admin/Pdfallsaranaprasarana', $pageData);
  }


  public function getAllSession()
  {

    $this->SecurityModel->roleOnlyGuard('admin');
    $filter = $this->input->post();
    $filter['full'] = true;
    $data = $this->ParameterModel->getAllSession($filter);
    echo json_encode(array('data' => $data));
    // $this->load->view('admin/Pdfallsaranaprasarana', $pageData);
  }

  public function getOpsi()
  {

    $this->SecurityModel->roleOnlyGuard('admin');
    $filter = $this->input->get();
    $filter['full'] = true;
    $data = $this->ParameterModel->getOpsi($filter);
    echo json_encode(array('data' => $data));
    // $this->load->view('admin/Pdfallsaranaprasarana', $pageData);
  }


  public function addBankSoal()
  {

    $this->SecurityModel->roleOnlyGuard('admin');
    $data = $this->input->post();
    $id = $this->AdminModel->addBankSoal($data);
    $data = $this->ParameterModel->getAllBankSoal(array('id_bank_soal' => $id))[$id];
    echo json_encode(array('data' => $data));
  }


  public function editBankSoal()
  {

    $this->SecurityModel->roleOnlyGuard('admin');
    $data = $this->input->post();
    $this->AdminModel->editBankSoal($data);
    $data = $this->ParameterModel->getAllSession(array('id_bank_soal' => $data['id_bank_soal']))[$data['id_bank_soal']];
    echo json_encode(array('data' => $data));
    // $this->load->view('admin/Pdfallsaranaprasarana', $pageData);
  }


  public function addSessionExam()
  {

    $this->SecurityModel->roleOnlyGuard('admin');
    $data = $this->input->post();
    $id = $this->AdminModel->addSessionExam($data);
    $data = $this->ParameterModel->getAllSession(array('id_session_exam' => $id))[$id];

    echo json_encode(array('data' => $data));
  }


  public function editSessionExam()
  {

    $this->SecurityModel->roleOnlyGuard('admin');
    $data = $this->input->post();
    $this->AdminModel->editSessionExam($data);
    $data = $this->ParameterModel->getAllSession(array('id_session_exam' => $data['id_session_exam']))[$data['id_session_exam']];
    echo json_encode(array('data' => $data));
    // $this->load->view('admin/Pdfallsaranaprasarana', $pageData);
  }



  public function PdfAllSenibudaya()
  {
    $this->SecurityModel->roleOnlyGuard('admin');

    $data = $this->SenibudayaModel->getAllSenibudaya();
    $pageData = array(
      'data' => $data,
    );
    $this->load->view('admin/Pdfallsenibudaya', $pageData);
  }

  public function PdfAllDesawisata()
  {
    $this->SecurityModel->roleOnlyGuard('admin');

    $data = $this->DesawisataModel->getAllDesawisata();
    $pageData = array(
      'data' => $data,
    );
    $this->load->view('admin/Pdfalldesawisata', $pageData);
  }

  public function PdfAllObjek()
  {
    $this->SecurityModel->roleOnlyGuard('admin');

    $data = $this->ObjekModel->getAllObjek();
    $pageData = array(
      'data' => $data,

    );
    $this->load->view('admin/Pdfallobjek', $pageData);
  }
  public function PdfAllPenginapan()
  {
    $this->SecurityModel->roleOnlyGuard('admin');

    $data = $this->PenginapanModel->getAllPenginapan();
    $pageData = array(
      'data' => $data,

    );
    $this->load->view('admin/Pdfallpenginapan', $pageData);
  }

  public function Kalender()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Event',
      'content' => 'Kalender',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }



  public function test()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'test',
      'content' => 'admin/test',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }

  public function Penginapan()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Penginapan',
      'content' => 'admin/Penginapan',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }

  public function Biro()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Biro Wisata dan Agen',
      'content' => 'admin/Biro',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }

  public function Usaha()
  {
    $this->SecurityModel->roleOnlyGuard('admin');
    $pageData = array(
      'title' => 'Usaha dan Jasa',
      'content' => 'admin/Usaha',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
    );
    $this->load->view('Page', $pageData);
  }
}
