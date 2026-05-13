<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('user/User_model');
        $this->load->model('leads/Leads_model','leads_model');
        $this->load->model('seller/Seller_model','seller_model');
        $this->load->model('Country_state_district');
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
							'username'  => $user->name,
							'useremail' => $user->email,
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
    public function create_lead(){
        $this->form_validation->set_rules('school_name', 'School Name', 'required|trim');
		$this->form_validation->set_rules('affiliated_with', 'Affiliated with', 'required|trim');
		$this->form_validation->set_rules('no_of_students', 'No of Students', 'required|numeric|trim');
		$this->form_validation->set_rules('school_principal_name', 'School Principal Name', 'required|trim');
		$this->form_validation->set_rules('school_phone', 'Contact No.', 'required|trim');
		$this->form_validation->set_rules('school_email', 'Email ID', 'required|valid_email|trim');
		$this->form_validation->set_rules('school_country', 'Country', 'required|trim');
		$this->form_validation->set_rules('school_state', 'State', 'required|trim');
		$this->form_validation->set_rules('school_district', 'District', 'required|trim');
		$this->form_validation->set_rules('school_city', 'City', 'required|trim');
		$this->form_validation->set_rules('school_pin_code', 'Pin Code', 'required|trim');
		$this->form_validation->set_rules('school_address', 'Address', 'trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['getAllState'] = $this->Country_state_district->get_all_state();
			$data['schoolAffiliated'] = $this->customlib->schoolAffiliated();
			// $data['page'] = 'leads/form';
			// $data['script'] = 'leads/form_script';
			// $this->load->view('layout/main',$data);
			
			$this->load->view('create_lead',$data);
		}
		else
		{
			$data = [
				'seller_id' => 0,
				'school_name' => $this->input->post('school_name', true),
				'school_email' => $this->input->post('school_email', true),
				'school_phone' => $this->input->post('school_phone', true),
				'affiliated_with' => $this->input->post('affiliated_with'),
				'no_of_students' => $this->input->post('no_of_students'),
				'school_principal_name' => $this->input->post('school_principal_name'),
				'school_country' => $this->input->post('school_country'),
				'school_state' => $this->input->post('school_state'),
				'school_district' => $this->input->post('school_district'),
				'school_city' => $this->input->post('school_city'),
				'school_pin_code' => $this->input->post('school_pin_code'),
				'school_address' => $this->input->post('school_address'),
				'alternate_no' => $this->input->post('alternate_no'),
				'school_website' => $this->input->post('school_website'),
				'coming_form' => 2,
				'status' => 1,
				'created_at' => date('Y-m-d H:i:s')
			];

			$this->leads_model->insert($data);

			$this->session->set_flashdata('success','Leads Added Successfully');
			redirect('create-lead');
		}

    }
    public function reseller_registration(){
        $this->form_validation->set_rules('firm_name', 'Firm Name', 'required|trim');
        $this->form_validation->set_rules('name', 'Re-Seller Name', 'required|trim');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required|trim');
        $this->form_validation->set_rules('have_gst', 'GST', 'required|trim');
        if($this->input->post('have_gst') == 1){
			$this->form_validation->set_rules('gst_no', 'GST No', 'required|trim');
		}
        $this->form_validation->set_rules('working_experience', 'Working Experience', 'required|trim');
		$this->form_validation->set_rules('seller_country', 'Country', 'required|trim');
		$this->form_validation->set_rules('seller_state', 'State', 'required|trim');
		$this->form_validation->set_rules('seller_district', 'District', 'required|trim');
		$this->form_validation->set_rules('seller_city', 'City', 'required|trim');
		$this->form_validation->set_rules('seller_pin_code', 'Pin Code', 'required|trim');
		$this->form_validation->set_rules('seller_address', 'Address', 'trim');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email|is_unique[users.email]'
        );
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('discount_percent', 'Discount Percent', 'required');

        if ($this->form_validation->run() == FALSE)
        {
			$data['getAllState'] = $this->Country_state_district->get_all_state();
			
			$this->load->view('reseller_registration',$data);
		}
		else
		{
			$data = [
                'firm_name'       => $this->input->post('firm_name', true),
                'name'       => $this->input->post('name', true),
                'mobile_no'       => $this->input->post('mobile_no', true),
                'alternate_mobile_no'       => $this->input->post('alternate_mobile_no', true),
                'email'      => $this->input->post('email', true),
                'have_gst'      => $this->input->post('have_gst', true),
                'gst_no'      => $this->input->post('gst_no', true),
                'working_experience'      => $this->input->post('working_experience', true),
                'seller_country'      => $this->input->post('seller_country', true),
                'seller_state'      => $this->input->post('seller_state', true),
                'seller_district'      => $this->input->post('seller_district', true),
                'seller_city'      => $this->input->post('seller_city', true),
                'seller_pin_code'      => $this->input->post('seller_pin_code', true),
                'seller_address'      => $this->input->post('seller_address', true),
                'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'discount_percent'   => $this->input->post('discount_percent'),
                'user_role'  => 1,
                'status'     => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->seller_model->insert($data);

			$this->session->set_flashdata('success','Successfully Registered');
			redirect('reseller-registration');
		}

    }

}
