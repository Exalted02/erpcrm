<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('user/User_model');
    }

    public function index(){
        // if already logged in redirect to dashboard
        if($this->session->userdata('logged_in')){
            redirect('dashboard');
        }
		
        if($this->input->post()){

            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->User_model->login($email);

            if($user && password_verify($password,$user->password)){

                $session = [
                    'user_id'=>$user->id,
                    'name'=>$user->name,
                    'user_role'=>$user->user_role,
                    'logged_in'=>true
                ];

                $this->session->set_userdata($session);

                redirect('dashboard');

            }else{

                $data['error']="Invalid login";

            }

        }

        $this->load->view('login');

    }

    public function logout(){
		
        $this->session->sess_destroy();

        redirect('login');

    }

}
