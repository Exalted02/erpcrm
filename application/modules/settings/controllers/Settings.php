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
        $data['script'] = 'settings/index_script';

        $this->load->view('layout/main',$data);
    }
	public function get_school_data()
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
		$data['school_sessions'] = $response['sessions'] ?? null;
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
	}
	public function store()
    {		
		$domain_id = $this->input->post('domain');
		$domain = $this->domain_model->get($domain_id);		
		$url = $domain->domain_name."/api/setting/update_sch_setting";

        $post = [
            'name'=>$this->input->post('name'),
            // 'dise_code'=>$this->input->post('dise_code'),
            'address'=>$this->input->post('address'),
            'phone'=>$this->input->post('phone'),
            'email'=>$this->input->post('email')
        ];
		
		/*if (!empty($_FILES['admin_small_logo']['tmp_name'])) {

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
		}*/
		
		
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
    }
}
