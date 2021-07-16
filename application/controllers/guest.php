<?php
defined('BASEPATH') or exit('No direct script access allowed');

class guest extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('PublicModel', 'ParameterModel'));
        $this->load->helper(array('DataStructure', 'Validation'));
    }

    public function index()
    {
        try {

            // $this->SecurityModel->userOnlyGuard(TRUE);
            $pageData = array(
                'title' => 'My Task',
                'content' => 'public/MyTask',
                'breadcrumb' => array(
                    'Home' => base_url(),
                ),
            );
            $this->load->view('PublicPage', $pageData);
        } catch (Exception $e) {
            ExceptionHandler::handle($e);
        }
    }
}
