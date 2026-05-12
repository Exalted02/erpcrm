<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('domain/Domain_model','domain_model');
        $this->load->model('Country_state_district');
    }

    public function index()
    {
        $data['domains'] = $this->domain_model->get_all();
				
        $data['page'] = 'settings/index';
        // $data['script'] = 'settings/index_script';

        $this->load->view('layout/main',$data);
    }
	public function edit($id)
	{
		$domain = $this->domain_model->get($id);

		if(!$domain){
			show_404();
		}
		
		$form_type = $this->input->post('form_type');
		if($form_type == 'registration'){
			$this->form_validation->set_rules('name', 'School Name', 'required|trim');
			$this->form_validation->set_rules('dise_code', 'School Code', 'required|trim');
			$this->form_validation->set_rules('aff_no', 'Affiliate No.', 'required|trim');
			$this->form_validation->set_rules('address', 'Address', 'required|trim');
			$this->form_validation->set_rules('phone', 'Phone', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|trim');
			$this->form_validation->set_rules('school_country', 'Country', 'required|trim');
			$this->form_validation->set_rules('school_state', 'State', 'required|trim');
			$this->form_validation->set_rules('school_district', 'District', 'required|trim');
			$this->form_validation->set_rules('school_city', 'City', 'required|trim');
			$this->form_validation->set_rules('school_pin_code', 'Pin Code', 'required|trim');
		}
		if($form_type == 'login'){
			$this->form_validation->set_rules('login_id', 'Login ID', 'required|trim');
			$this->form_validation->set_rules('login_password', 'Password', 'trim');
		}
			
		if ($this->form_validation->run() == FALSE)
		{			
			// Call ERP API
			$url = $domain->domain_name . "/api/setting/get_sch_setting";

			$headers = [
				'Api-Key: '.$domain->api_key
			];

			$response = call_api_get($url, $headers);
			$data['active_tab'] = $form_type;
			$data['getAllState'] = $this->Country_state_district->get_all_state();
			$data['school_api'] = $response['data'] ?? null;
			$data['school_sessions'] = $response['sessions'] ?? [];
			$data['login_data'] = $response['login_data'] ?? [];
			$data['school'] = (array) $domain;
			$data['page'] = 'settings/setting_form';
			$data['script'] = 'settings/form_script';

			$this->load->view('layout/main',$data);
		}else{
			$headers = [
				'Api-Key: '.$domain->api_key
			];
			if($form_type == 'registration'){
				$url = $domain->domain_name."/api/setting/update_sch_setting";

				$post = [
					'name'=>$this->input->post('name'),
					'dise_code'=>$this->input->post('dise_code'),
					'aff_no'=>$this->input->post('aff_no'),
					'address'=>$this->input->post('address'),
					'phone'=>$this->input->post('phone'),
					'email'=>$this->input->post('email')
				];
				// Add sch_id only if present
				$sch_id = $this->input->post('sch_id');	
				if(!empty($sch_id)){
					$post['id'] = $sch_id;
				}
				
				// echo "<pre>";print_r($post);die;
								
				$response = call_api_post($url, $post, $headers);
				
				$data = [
					'name' => $this->input->post('name', true),
					'dise_code' => $this->input->post('dise_code', true),
					'aff_no' => $this->input->post('aff_no', true),
					'address'     => $this->input->post('address', true),
					'phone'     => $this->input->post('phone', true),
					'email'     => $this->input->post('email', true),
					'school_country'     => $this->input->post('school_country', true),
					'school_state'     => $this->input->post('school_state', true),
					'school_district'     => $this->input->post('school_district', true),
					'school_city'     => $this->input->post('school_city', true),
					'school_pin_code'     => $this->input->post('school_pin_code', true),
				];
				$this->domain_model->update($domain->id, $data);
			}
			if($form_type == 'login'){

				$login_id = $this->input->post('login_id', true);
				$password = $this->input->post('login_password', true);

				// API URL
				$url = $domain->domain_name."/api/setting/update_login";

				$post = [
					'email' => $login_id
				];

				// Send password only if entered
				if(!empty($password)){
					$post['password'] = $password;
				}
				$response = call_api_post($url, $post, $headers);
			}
			if($response['status']){
				$this->session->set_flashdata('success', $response['message']);
				// $this->session->set_flashdata('domain_id', $domain_id);
			}else{
				$this->session->set_flashdata('error', $response['message']);
			}
			redirect('settings/edit/'.$id);
		}
	}
	public function get_school_details()
	{
		$form_type = $this->input->post('form_type');
		$session_id = $this->input->post('session_id');
		
		$domain_id = $this->input->post('domain_id');
		$domain = $this->domain_model->get($domain_id);
		
		// Call ERP API
		$url = $domain->domain_name . "/api/setting/get_school_details";

		$headers = [
			'Api-Key: '.$domain->api_key
		];
		$post = [
			'form_type' => $form_type,
			'session_id' => $session_id
		];
		$response = call_api_post($url, $post, $headers);
		echo json_encode([
			'status' => true,
			'html' => $response['html'] ?? null,
		]);
	}
	/*public function get_school_data()
	{
		$domain_id = $this->input->post('domain_id');
		$domain = $this->domain_model->get($domain_id);
		
        //echo "<pre>";print_r($domain);die;
		// Call ERP API
		$url = $domain->domain_name . "/api/setting/get_sch_setting";

		$headers = [
			'Api-Key: '.$domain->api_key
		];

		$response = call_api_get($url, $headers);
		// echo "<pre>";print_r($response);die;
		$data['school_api'] = $response['data'] ?? null;
		$data['school_sessions'] = $response['sessions'] ?? [];
		$data['school'] = (array) $domain;
		$data['domain_name'] = $domain->domain_name ?? null;
		$data['getAllState'] = $this->Country_state_district->get_all_state();

		// Load partial view
		$html = $this->load->view('settings/partials/setting_form', $data, true);
		
		$session_html = '<option>Please select</option>';
		foreach($data['school_sessions'] as $session_Val){
			$session_html .= '<option value="'.$session_Val['id'].'">'.$session_Val['session'].'</option>';
		}
		echo json_encode([
			'status' => true,
			'html' => $html,
			'school' => $data['school'],
			'school_api' => $data['school_api'],
			'session_html' => $session_html
		]);
	}*/
	/*public function store()
    {		
		
		$this->form_validation->set_rules('name', 'School Name', 'required|trim');
		$this->form_validation->set_rules('dise_code', 'School Code', 'required|trim');
		$this->form_validation->set_rules('aff_no', 'Affiliate No.', 'required|trim');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');
		$this->form_validation->set_rules('phone', 'Phone', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('school_country', 'Country', 'required|trim');
		$this->form_validation->set_rules('school_state', 'State', 'required|trim');
		$this->form_validation->set_rules('school_district', 'District', 'required|trim');
		$this->form_validation->set_rules('school_city', 'City', 'required|trim');
		$this->form_validation->set_rules('school_pin_code', 'Pin Code', 'required|trim');

		$domain_id = $this->input->post('domain');
		$domain = $this->domain_model->get($domain_id);		
		$url = $domain->domain_name."/api/setting/update_sch_setting";

        $post = [
            'name'=>$this->input->post('name'),
            'dise_code'=>$this->input->post('dise_code'),
            'aff_no'=>$this->input->post('aff_no'),
            'address'=>$this->input->post('address'),
            'phone'=>$this->input->post('phone'),
            'email'=>$this->input->post('email')
        ];
		
		if (!empty($_FILES['admin_small_logo']['tmp_name'])) {

			$post['admin_small_logo'] = new CURLFile(
				$_FILES['admin_small_logo']['tmp_name'],
				$_FILES['admin_small_logo']['type'],
				$_FILES['admin_small_logo']['name']
			);
		}
		
		if (!empty($_FILES['admin_logo']['tmp_name'])) {

			$post['admin_logo'] = new CURLFile(
				$_FILES['admin_logo']['tmp_name'],
				$_FILES['admin_logo']['type'],
				$_FILES['admin_logo']['name']
			);
		}
		
		
		// Add sch_id only if present
		$sch_id = $this->input->post('sch_id');	
		if(!empty($sch_id)){
			$post['id'] = $sch_id;
		}
		
		// echo "<pre>";print_r($post);die;
		
		$headers = [
            'Api-Key: '.$domain->api_key
        ];
		
		$response = call_api_post($url, $post, $headers);
		
		$data = [
			'name' => $this->input->post('name', true),
			'dise_code' => $this->input->post('dise_code', true),
			'aff_no' => $this->input->post('aff_no', true),
			'address'     => $this->input->post('address', true),
			'phone'     => $this->input->post('phone', true),
			'email'     => $this->input->post('email', true),
			'school_country'     => $this->input->post('school_country', true),
			'school_state'     => $this->input->post('school_state', true),
			'school_district'     => $this->input->post('school_district', true),
			'school_city'     => $this->input->post('school_city', true),
			'school_pin_code'     => $this->input->post('school_pin_code', true),
		];
		$this->domain_model->update($domain->id, $data);
		
		if($response['status']){
			$this->session->set_flashdata('success', $response['message']);
			$this->session->set_flashdata('domain_id', $domain_id);
		}else{
			$this->session->set_flashdata('error', $response['message']);
		}
		redirect('settings');
    }*/
}
