<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpassword extends MX_Controller {

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

			if($this->form_validation->run() == FALSE){
				// validation failed
				$this->load->view('forgot-password');
			}else{
				$email = $this->input->post('email');

				$result = $this->User_model->getByEmail($email);

				if ($result && $result->email != "") {
					if($result->status == 1){
						$verification_code = bin2hex(random_bytes(32));
						$update_record     = array('id' => $result->id, 'verification_code' => $verification_code);
						$this->User_model->add($update_record);
						
						$resetPassLink  = site_url('resetpassword') . "/" . $verification_code;
						// send email
						send_dynamic_email($this, $email, 'forgot_password', [
							'name' => $result->name,
							'resetPassLink' => $resetPassLink
						]);
						$data['success'] = "Please check your email to recover your password.";
						$this->load->view('forgot-password',$data);
					}else{
						$data['error'] = "Your account is disabled please contact to administrator.";
						$this->load->view('forgot-password',$data);
					}
				}else{

					$data['error'] = "Email not exists";
					$this->load->view('forgot-password',$data);

				}

			}

		}else{

			$this->load->view('forgot-password');

		}
	}

    public function logout(){
		
        $this->session->sess_destroy();

        redirect('login');

    }

}
