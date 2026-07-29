<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('domain/Domain_model','domain_model');
        $this->load->model('Country_state_district');
        $this->load->model('subscription/Subscription_model','subscription_model');
		$this->load->model('seller/Seller_model','seller_model');
		$this->load->model('invoice/Invoice_model', 'invoice_model');
		$this->load->model('services/Services_model', 'services_model');
    }

    public function index()
    {
        $data['domains'] = $this->domain_model->get_all();
				
        $data['page'] = 'settings/index';
        $data['script'] = 'settings/index_script';

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
			$this->form_validation->set_rules('plan_id', 'Plan', 'required|trim');
			$this->form_validation->set_rules('school_type', 'School Type', 'required|trim');
			if($this->input->post('school_type')==1){
				$this->form_validation->set_rules('seller_id', 'Seller', 'required|trim');
			}
		}
		if($form_type == 'login'){
			$this->form_validation->set_rules('login_id', 'Login ID', 'required|valid_email|trim');
			$this->form_validation->set_rules('login_password', 'Password', 'required|trim');
		}
		if($form_type == 'plan_dates'){
			$this->form_validation->set_rules('subscription_start_date', 'Subscription Start Date', 'required|trim');
			$this->form_validation->set_rules('subscription_end_date', 'Subscription End Date', 'required|trim');
		}
			
		if ($this->form_validation->run() == FALSE)
		{			
			// Call ERP API
			$url = $domain->domain_name . "/api/setting/get_sch_setting";

			$headers = [
				'Api-Key: '.$domain->api_key
			];

			$response = call_api_get($url, $headers);
			$data['active_tab'] = $form_type ? $form_type : $this->session->flashdata('active_tab');
			$data['subscriptions'] = $this->subscription_model->get_all_active();
			$data['services'] = $this->services_model->get_all_active();
			$data['getAllState'] = $this->Country_state_district->get_all_state();
			$data['school_api'] = $response['data'] ?? null;
			$data['school_sessions'] = $response['sessions'] ?? [];
			$data['login_data'] = $response['login_data'] ?? [];
			$data['school'] = (array) $domain;
			if(isset($domain) && $domain->plan_id!=null){
				$data['plan_details'] = $this->subscription_model->get($domain->plan_id);
				// echo '<pre>';print_r($data['plan_details']);exit;
			}
			$data['school_type'] = school_type_array();
			$data['sellers'] = $this->seller_model->get_all();
			$data['invoices'] = $this->invoice_model->get_by_domain($domain->id);
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
					'alternate_no' => $this->input->post('alternate_no'),
					'email'=>$this->input->post('email')
				];
				// Add sch_id only if present
				$sch_id = $this->input->post('sch_id');	
				if(!empty($sch_id)){
					$post['id'] = $sch_id;
				}
				
				// echo "<pre>";print_r($post);die;
								
				$response = call_api_post($url, $post, $headers);
			// echo '<pre>';print_r($headers);die;
				$seller_id = $this->input->post('seller_id', true);
				if($this->input->post('school_type')==0){
					$seller_id = null;
				}
				
				$data = [
					'name' => $this->input->post('name', true),
					'dise_code' => $this->input->post('dise_code', true),
					'aff_no' => $this->input->post('aff_no', true),
					'address'     => $this->input->post('address', true),
					'phone'     => $this->input->post('phone', true),
					'alternate_no' => $this->input->post('alternate_no'),
					'email'     => $this->input->post('email', true),
					'school_country'     => $this->input->post('school_country', true),
					'school_state'     => $this->input->post('school_state', true),
					'school_district'     => $this->input->post('school_district', true),
					'school_city'     => $this->input->post('school_city', true),
					'school_pin_code'     => $this->input->post('school_pin_code', true),
					'plan_id'     => $this->input->post('plan_id', true),
					'extra_add_on_students' => $this->input->post('extra_add_on_students') !== '' 
						? $this->input->post('extra_add_on_students', true) 
						: null,
					'school_type'     => $this->input->post('school_type', true),
					'seller_id'     => $seller_id,
					'service_ids'     => implode(',', (array) $this->input->post('service_ids')),
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
					
					$data = [
						'domain_login_password' => $password,
					];
					$this->domain_model->update($domain->id, $data);
				}
				$response = call_api_post($url, $post, $headers);				
			}
			if($form_type == 'plan_dates'){

				$start_date = $this->input->post('subscription_start_date', true);
				$end_date   = $this->input->post('subscription_end_date', true);

				if(!empty($start_date)){
					$start_date = DateTime::createFromFormat('d-m-Y', $start_date)->format('Y-m-d');
				}
				if(!empty($end_date)){
					$end_date = DateTime::createFromFormat('d-m-Y', $end_date)->format('Y-m-d');
				}

				$data = [
					'subscription_start_date' => $start_date,
					'subscription_end_date'   => $end_date,
				];
				$this->domain_model->update($domain->id, $data);

				$response = [
					'status'  => true,
					'message' => 'Subscription period updated successfully.',
				];
			}
			if($response['status']){
				$this->session->set_flashdata('success', $response['message']);
				// $this->session->set_flashdata('domain_id', $domain_id);
			}else{
				$this->session->set_flashdata('error', $response['message']);
			}
			$this->session->set_flashdata('active_tab', $form_type);
			redirect('settings/edit/'.$id);
		}
	}
	public function get_school_details()
	{
		$form_type = $this->input->post('form_type');
		$session_id = $this->input->post('session_id');
		$from_date  = $this->input->post('from_date', true);
		$to_date    = $this->input->post('to_date', true);
		if (!empty($from_date)) {
			$from_date = DateTime::createFromFormat('d-m-Y', $from_date)->format('Y-m-d');
		}

		if (!empty($to_date)) {
			$to_date = DateTime::createFromFormat('d-m-Y', $to_date)->format('Y-m-d');
		}
		
		$domain_id = $this->input->post('domain_id');
		$domain = $this->domain_model->get($domain_id);
		
		// Call ERP API
		$url = $domain->domain_name . "/api/setting/get_school_details";

		$headers = [
			'Api-Key: '.$domain->api_key
		];
		$post = [
			'form_type' => $form_type,
			'session_id' => $session_id,
			'from_date' => $from_date,
			'to_date' => $to_date,
		];
		$response = call_api_post($url, $post, $headers);
		echo json_encode([
			'status' => true,
			'html' => $response['html'] ?? null,
		]);
	}
}
