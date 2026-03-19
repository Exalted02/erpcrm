<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('user/User_model');
    }

    public function index()
	{
		// already logged in
		if($this->session->userdata('logged_in')){
			redirect('dashboard');
		}

		if($this->input->post()){

			// validation rules			
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|trim');

			if($this->form_validation->run() == FALSE){

				// validation failed
				$this->load->view('login');

			}else{

				$email = $this->input->post('email');
				$password = $this->input->post('password');

				$user = $this->User_model->getByEmail($email);

				if($user && password_verify($password,$user->password)){
					if($user->status == 1){
						$session = [
							'user_id'   => $user->id,
							'name'      => $user->name,
							'user_role' => $user->user_role,
							'logged_in' => true
						];

						$this->session->set_userdata($session);

						redirect('dashboard');
					}else{
						$data['error'] = "Your account is disabled please contact to administrator.";
						$this->load->view('login',$data);
					}
				}else{

					$data['error'] = "Invalid email or password";
					$this->load->view('login',$data);

				}

			}

		}else{

			$this->load->view('login');

		}
	}

    public function logout(){
		
        $this->session->sess_destroy();

        redirect('login');

    }

}
