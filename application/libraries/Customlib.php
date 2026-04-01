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
    }

    public function getCSRF()
    {
        $csrf_input = "<input type='hidden' ";
        $csrf_input .= "name='" . $this->CI->security->get_csrf_token_name() . "'";
        $csrf_input .= " value='" . $this->CI->security->get_csrf_hash() . "'/>";

        return $csrf_input;
    }

    public function getSessionUserRole()
    {
        $student_session = $this->CI->session->userdata();
        $user_role        = $student_session['user_role'];
        return $user_role;
    }
    public function getSessionUserName()
    {
        $student_session = $this->CI->session->userdata();
        $username        = $student_session['username'];
        return $username;
    }

}
