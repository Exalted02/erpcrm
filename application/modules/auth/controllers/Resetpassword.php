<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resetpassword extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('user/User_model');
        $this->load->library('session');
    }

    public function index($token = null)
    {
        if(!$token){
            show_error('Invalid request');
        }

        // check token
        $user = $this->User_model->checkToken($token);

        if(!$user){
            $data['error'] = "Invalid or expired link.";
            $data['token'] = $token;
            $this->load->view('reset-password',$data);
            return;
        }

        // HANDLE POST (form submit)
        if($this->input->post()){

            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');

            // validation
            if($password != $confirm_password){
                $this->session->set_flashdata('error','Passwords and Confirm password not match');
                redirect('resetpassword/'.$token);
            }

            // update password
            $update_record = [
                'id' => $user->id,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'verification_code' => NULL
            ];

            $this->User_model->add($update_record);

            $this->session->set_flashdata('success','Password reset successfully');

            redirect('login');
        }

        // LOAD PAGE (GET)
        $data['token'] = $token;
        $this->load->view('reset-password', $data);
    }

}