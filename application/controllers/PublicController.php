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

  public function register()
  {
    $this->SecurityModel->guestOnlyGuard();
    $pageData = array(
      'title' => 'Daftar',
    );

    $this->load->view('RegisterPage', $pageData);
  }

  public function registerProcess()
  {
    try {
      $this->SecurityModel->guestOnlyGuard(TRUE);
      // Validation::ajaxValidateForm($this->SecurityModel->loginValidation());

      $data = $this->input->post();

      if (empty($data['password']) or empty($data['repassword']) or ($data['repassword'] != $data['password'])) {
        throw new UserException("Password Wrong!!", USER_NOT_FOUND_CODE);
      }
      $this->load->model(array('UserModel'));

      $data = $this->UserModel->registerUser($data);
      $this->email_send($data, 'registr');
      echo json_encode(array("error" => FALSE, "user" => 'success'));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }

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
      // $this->SecurityModel->userOnlyGuard(TRUE);
      // $filter['id_user'] = $this->session->userdata()['id_user'];
      if (!empty($this->session->userdata()['id_user']))
        $filter['id_user'] = $this->session->userdata()['id_user'];
      else
        $filter['ip_address'] = $this->input->ip_address();
      $data = $this->ParameterModel->getYourHistory($filter);
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }


  public function getAvaliableSession()
  {
    try {

      // $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->ParameterModel->getAvaliableSession();
      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }


  public function SubmitExam()
  {
    try {
      // $this->SecurityModel->userOnlyGuard(TRUE);
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
    // $data['point_mode'] = 'avg';
    $i = 1;
    $ans = '';
    $ans_ex = explode(',', $data['answer']);
    $i = 0;
    foreach ($ans_ex as $an) {
      if ($i == 0) {
        $i++;
        $ans .= '"' . $an . '"';
      } else {
        $ans .= ',"' . $an . '"';
      }
    }
    // var_dump($ans);
    // die();
    $this->ParameterModel->calculateScore($data, $data['generate_soal'], $ans);
    if (!$restric)
      echo json_encode(array('error' => false));
    // die();
  }


  public function createSessionExam()
  {
    try {
      // $this->SecurityModel->userOnlyGuard(TRUE);
      $id = $this->input->post()['id_session_exam'];
      $row = $this->ParameterModel->getAvaliableSession(array('id_session_exam' => $id));
      if (empty($row)) {
        throw new UserException("Sorry Not Avaliable", USER_NOT_FOUND_CODE);
      }
      $cur =  $row[$id];
      $data = $this->ParameterModel->getAllBankSoal(array('id_mapel' => $cur['id_mapel'], 'limit' => $cur['limit_soal'], 'order_random' => true, 'result_array' => true));
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
      if (!empty($this->session->userdata()['id_user']))
        $filter['id_user'] = $this->session->userdata()['id_user'];
      else
        $filter['ip_address'] = $this->input->ip_address();

      $data = $this->ParameterModel->getExam($filter)[$id]['token'];

      echo json_encode(array('data' => $data));
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }


  public function start_exam($token)
  {
    try {
      // $this->SecurityModel->userOnlyGuard(TRUE);
      $filter['token'] = $token;
      // $filter['id_user'] = $this->session->userdata()['id_user'];
      if (!empty($this->session->userdata()['id_user']))
        $filter['id_user'] = $this->session->userdata()['id_user'];
      else
        $filter['ip_address'] = $this->input->ip_address();

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
      // $this->SecurityModel->userOnlyGuard(TRUE);
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

  public function activator($id, $activate)
  {
    try {
      // $this->SecurityModel->guestOnlyGuard(TRUE);
      $data['activator'] = $activate;
      $data['id'] = $id;
      $this->load->model(array('UserModel'));

      $data = $this->UserModel->activatorUser($data);
      // $this->email_send($data, 'activate');
      redirect('login');
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

  public function email_send($data, $action)
  {

    $serv = $this->PublicModel->getServerSTMP();
    $send['to'] = $data['email']; //KPB$
    $send['subject'] = 'Activation Your Course';
    $url_act = site_url("/activator/{$data['id']}/{$data['activator']}");
    $content = "<br><br> Username :  {$data['username']}
						<br> Password :  {$data['password_hash']}
						<br> Activator :  {$data['activator']}
						<br> 
						<br><a href='{$url_act}' target='_blank' style='text-decoration:none;color: #60d2ff;'>Click this to activate</a>

						<br> manual activate = {$url_act}";

    $content = "<h4>Welcome in YOUR COURSES</h4><br><br>Email anda telah berhasil didaftarkan.
                                            <br><br> Username : {$data['username']}
                                            <br> Password : {$data['password_hash']}
                                            <br> Activator : {$data['activator']}
                                            <br>
                                            <br> Untuk login harap melakukan aktivasi email terlebih dahulu dengan klik tombol aktifasi dibawah.";
    $content2 = "<a href='{$url_act}' target='_blank' class='btn-primary' style='text-decoration: none;color: #fff;background-color: #1ab394;border: solid #1ab394;border-width: 5px 10px;line-height: 2;font-weight: bold;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px; text-transform: capitalize;'>Aktifkan sekarang</a>
                                            <br> atau masuk kealamat {$url_act} ";
    $send['message'] = $this->template_email($send['subject'], $content, $content2);

    $config['protocol']    = 'smtp';
    $config['smtp_host']    = $serv['url_'];
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '120';
    $config['smtp_user']    = $serv['username'];    //Important
    $config['smtp_pass']    = $serv['key'];  //Important
    // $config['charset']    = 'utf-8';
    $config['charset']    = 'iso-8859-1';
    $config['newline']    = '\r\n';
    $config['smtp_crypto']    = 'ssl';
    //  '' => 'ssl'
    $config['mailtype'] = 'text'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not 
    $send['config'] = $config;
    // $this->load->libraries('email');
    $this->email->initialize($send['config']);
    $this->email->set_mailtype("html");
    $this->email->from($serv['username']);
    $this->email->to($send['to']);
    $this->email->subject($send['subject']);
    $this->email->message($send['message']);
    $this->email->send();
    $this->email->print_debugger();
    return 0;
  }

  function template_email($title, $content = '', $content2 = '')
  {
    return "<!DOCTYPE>
                <html xmlns='http://www.w3.org/1999/xhtml'>

                <head>
                <meta name='viewport' content='width=device-width' />
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                <title>Actionable emails e.g. reset password</title>
                </head>

                <body style='-webkit-font-smoothing: antialiased;
                -webkit-text-size-adjust: none;
                width: 100% !important;
                height: 100%;
                line-height: 1.6;background-color: #f6f6f6;
                font-family:  Helvetica, Arial, sans-serif;'>
                <table class='body-wrap' style='background-color: #f6f6f6;	width: 100%;'>
                  <tr>
                      <td></td>
                      <td class='container' width='600' style='display: block !important;
                                    max-width: 600px !important;
                                    margin: 0 auto !important;
                                    clear: both !important;'>
                          <div class='content' style='max-width: 600px;
                                margin: 0 auto;
                                display: block;
                                padding: 20px;'>
                              <table class='main' width='100%' cellpadding='0' cellspacing='0' style='	background: #fff;
                                  border: 1px solid #e9e9e9;
                                  border-radius: 3px;'>
                                  <tr>
                                      <td class='content-wrap' style='padding: 20px;'>
                                          <table cellpadding='0' cellspacing='0'>
                                              <tr>
                                                  <td class='alert alert-good' style='background: #1ab394;font-size: 16px;	color: #fff;	font-weight: 500;
                                                      padding: 20px;
                                                      text-align: center;
                                                      border-radius: 3px 3px 0 0;'>
                                                      {$title} </td>
                                              </tr>
                                              <tr>
                                                  <td class='content-block' style='padding: 0 0 20px;'>
                                                      <br>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td class='content-block' style='padding: 0 0 20px;'>
                                                      {$content}   
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td class='content-block' style='padding: 0 0 20px;'>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td class='content-block aligncenter' style='padding: 0 0 20px; text-align: center;'>
                                                      {$content2}                                          </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                            <div class='footer' style='width: 100%;	clear: both;	color: #999;	padding: 20px;'>
                                                                                <table width='100%'>
                                                                                    <tr style='text-align: center;'>
                                                                                        <td class='aligncenter content-block' style='padding: 0 0 20px;'>Follow <a style='color: #999;' href='https://instagram.com/ugikdev'>@ugikdev</a> on Instagram.</td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                            </table>

                                                        </body>

                                                        </html>";
  }
}
