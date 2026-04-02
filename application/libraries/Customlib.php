<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Customlib
{

    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session');
        $this->CI->load->model('user/User_model', '', true);
    }

    public function getCSRF()
    {
        $csrf_input = "<input type='hidden' ";
        $csrf_input .= "name='" . $this->CI->security->get_csrf_token_name() . "'";
        $csrf_input .= " value='" . $this->CI->security->get_csrf_hash() . "'/>";

        return $csrf_input;
    }

    public function getLoginSessionData($type)
    {
        $student_session = $this->CI->session->userdata();
        $type_data        = $student_session[$type];
        return $type_data;
    }
    public function getUserDetailsById($id)
    {
        $result = $this->CI->User_model->getById($id);
        return $result;
    }

}
