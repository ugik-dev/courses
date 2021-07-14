<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PublicController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('PublicModel', 'ParameterModel'));
    $this->load->helper(array('DataStructure', 'Validation'));
  }


  public function search()
  {
    $this->load->view('PublicPage', [
      'title' => "Search",
      'content' => 'public/Search',
    ]);
  }

  // public function index(){
  //   $this->load->view('PublicPage', [
  // 		'title' => "Home",
  //     'content' => 'public/LandingPage',
  //   ]);
  // }

  public function searchProcess()
  {
    try {
      // $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->PublicModel->search($this->input->post());
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }


  public function searchEvaluasi()
  {
    try {
      // $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->PublicModel->searchEvaluasi($this->input->post());
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }
  public function searchKelas()
  {
    try {
      // $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->PublicModel->searchDetail($this->input->post());
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }

  public function searchMapping()
  {
    try {
      // $this->SecurityModel->userOnlyGuard(TRUE);
      $fil = $this->input->post();

      $data = $this->PublicModel->searchMapping($fil);
      if (!empty($data[$fil['id_siswa']]['tgl'])) {
        $datanew =  $data[$fil['id_siswa']]['tgl'];
      } else {
        $datanew =  "";
      };
      echo json_encode(array('data' => $datanew));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }

  public function getYourHistory()
  {
    try {
      $this->SecurityModel->userOnlyGuard(TRUE);
      $filter['id_user'] = $this->session->userdata()['id_user'];
      $data = $this->ParameterModel->getYourHistory($filter);
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }


  public function getAvaliableSession()
  {
    try {

      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->ParameterModel->getAvaliableSession();
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }


  public function SubmitExam()
  {
    try {
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      $ans = '';
      for ($i = 0; $i < $data['count']; $i++) {
        if ($i == 0) {
          if (!empty($data['row_' . $i])) {
            $ans .=  $data['row_' . $i];
          } else {
            $ans .= '0';
          }
        } else {
          if (!empty($data['row_' . $i])) {
            $ans .= ',' . $data['row_' . $i];
          } else {
            $ans .= ',0';
          }
        }
      }

      $data['answer'] = $ans;
      $this->ParameterModel->SubmitExam($data);
      $data = $this->calculateScore($data['token']);
      // echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }

  function calculateScore($token, $restric = false)
  {
    $data = $this->ParameterModel->getExam(array('token' => $token))[$token];
    $data['point_mode'] = 'avg';
    $i = 1;
    $this->ParameterModel->calculateScore($data, $data['generate_soal'], $data['answer']);
    if (!$restric)
      echo json_encode(array('error' => false));
    // die();
  }


  public function createSessionExam()
  {
    try {
      $this->SecurityModel->userOnlyGuard(TRUE);
      $id = $this->input->post()['id_session_exam'];
      $row = $this->ParameterModel->getAvaliableSession(array('id_session_exam' => $id));
      if (empty($row)) {
        throw new UserException("Sorry Not Avaliable", USER_NOT_FOUND_CODE);
      }
      $cur =  $row[$id];
      $data = $this->ParameterModel->getAllBankSoal(array('id_mapel' => $cur['id_mapel'], 'result_array' => true));
      shuffle($data);
      $shuffle = '';
      $i = 0;
      foreach ($data as $d) {
        if ($i == 0)
          $shuffle .= $d['id_bank_soal'];
        else
          $shuffle .= ',' . $d['id_bank_soal'];
        $i++;
      }
      $id = $this->ParameterModel->createExam(array('id_session_exam' => $id, 'generate_soal' => $shuffle));
      $filter['id_session_exam_user'] = $id;
      $filter['id_user'] = $this->session->userdata()['id_user'];
      $data = $this->ParameterModel->getExam($filter)[$id]['token'];

      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }


  public function start_exam($token)
  {
    try {
      $this->SecurityModel->userOnlyGuard(TRUE);
      $filter['token'] = $token;
      $filter['id_user'] = $this->session->userdata()['id_user'];
      $data = $this->ParameterModel->getExam($filter);
      if (!empty($data)) {
        $data = $data[$token];
        $ex_soal = explode(',', $data['generate_soal']);
      }
      $c = count($ex_soal);
      // var_dump($data);
      $dateTime = new DateTime($data['start_time']);
      $dateTime->modify('+' . $data['limit_time'] . ' minutes');
      $t1 = ($dateTime->format("Y-m-d H:i:s"));

      $start = date_create(date("Y-m-d H:i:s"));
      // $start = date_create('2021-07-14 15:39:20');
      $end = date_create($t1);

      $start2 = strtotime(date("Y-m-d H:i:s"));
      $end2 = strtotime($t1);
      $diff = date_diff($end, $start);
      // var_dump($end2);
      // die();
      if ($end2 < $start2 or $data['exam_lock'] == 'Y') {
        if (empty($data['score']))
          $this->calculateScore($data['token'], true);
        $this->pembahasan($data);
        // echo die();
        return;
      }
      $timer = $diff->h * 60 * 60;
      $timer = $timer + $diff->i * 60;
      $timer = $timer + $diff->s;
      // print_r($timer);
      // die();
      if (!empty($data['answer'])) {
        $ans = explode(',', $data['answer']);
      } else {
        for ($j = 0; $j < $c; $j++)
          $ans[$j] = 0;
      }
      $i = 0;
      $btn = '';
      foreach ($ex_soal as $ex) {
        $exs = $this->ParameterModel->getShuffleSoal($ex);
        $data_soal[$i] = $exs;
        if ($ans[$i] == '0' or $ans[$i] == '-')
          $btn .= '<a data-toggle="pill" class="nav-link btn btn-primary mr-1 mt-1" id="ans_' . $i . '" href="#soal_' . $i . '" role="tab">' . ($i + 1) . '</a>';
        else
          $btn .= '<a data-toggle="pill" class="nav-link btn btn-success mr-1 mt-1" id="ans_' . $i . '" href="#soal_' . $i . '" role="tab">' . ($i + 1) . '</a>';
        $i++;
      }

      // echo json_encode(array('data' => $data_soal));
      // $this->SecurityModel->userOnlyGuard(TRUE);
      $pageData = array(
        'title' => 'Try Out',
        // 'content' => 'public/MyTask',
        'breadcrumb' => array(
          'Home' => base_url(),
        ),
        'data_soal' => $data_soal,
        'btn' => $btn,
        'ans' => $ans,
        'token' => $token,
        'timer' => $timer
      );
      $this->load->view('PageExam', $pageData);
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }

  public function pembahasan($data)
  {
    try {
      $this->SecurityModel->userOnlyGuard(TRUE);
      if (!empty($data)) {
        $data = $data;
        $ex_soal = explode(',', $data['generate_soal']);
      }
      $c = count($ex_soal);
      // var_dump($data);

      if (!empty($data['answer'])) {
        $ans = explode(',', $data['answer']);
      } else {
        for ($j = 0; $j < $c; $j++)
          $ans[$j] = 0;
      }
      $i = 0;
      $btn = '';
      foreach ($ex_soal as $ex) {
        $exs = $this->ParameterModel->getShuffleSoal($ex, true);
        // echo json_encode($data);
        // die();
        $data_soal[$i] = $exs;
        if ($ans[$i] == '0' or $ans[$i] == '-' or $exs['soal']['token_opsi'] != $ans[$i])
          $btn .= '<a data-toggle="pill" class="nav-link btn btn-danger mr-1 mt-1" id="ans_' . $i . '" href="#soal_' . $i . '" role="tab">' . ($i + 1) . '</a>';
        else
          $btn .= '<a data-toggle="pill" class="nav-link btn btn-success mr-1 mt-1" id="ans_' . $i . '" href="#soal_' . $i . '" role="tab">' . ($i + 1) . '</a>';
        $i++;
      }

      // echo json_encode(array('data' => $data_soal));
      // $this->SecurityModel->userOnlyGuard(TRUE);
      $pageData = array(
        'title' => 'Try Out',
        // 'content' => 'public/MyTask',
        'breadcrumb' => array(
          'Home' => base_url(),
        ),
        'dataContent' => $data,
        'data_soal' => $data_soal,
        'btn' => $btn,
        'ans' => $ans,
      );
      $this->load->view('PagePembahasan', $pageData);
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }



  public function searchDetail($id)
  {
    try {
      // $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->PublicModel->search2($id);

      $this->load->view('PublicPage', [
        'title' => "Search",
        'content' => 'public/SearchDetail',
        'pageData' => $data[$id]
      ]);
      // echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }


  public function my_task()
  {
    try {

      $this->SecurityModel->userOnlyGuard(TRUE);
      $pageData = array(
        'title' => 'My Task',
        'content' => 'public/MyTask',
        'breadcrumb' => array(
          'Home' => base_url(),
        ),
      );
      $this->load->view('Page', $pageData);
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }


  public function searchAbsen($id, $map)
  {
    try {
      // $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->PublicModel->search2($id);
      $data2 = $this->PublicModel->searchSpekKelas($id);
      $this->load->view('PublicPage', [
        'title' => "Search",
        'content' => 'public/SearchAbsen',
        'pageData' => $data[$id],
        'id_mapping' => $map,
        'dataKelas' => $data2[$map]
      ]);
      // echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }
}
