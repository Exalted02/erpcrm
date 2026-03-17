<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('domain/Domain_model','domain_model');
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

		// Call ERP API
		$url = $domain->domain_name . "/api/setting/get_sch_setting";

		$headers = [
			'Api-Key: '.$domain->api_key
		];

		$response = call_api_get($url, $headers);
		
		$data['school'] = $response['data'] ?? null;

		// Load partial view
		$this->load->view('settings/partials/setting_form',$data);
	}
	public function store()
    {		
		$domain_id = $this->input->post('domain');
		$domain = $this->domain_model->get($domain_id);		
		$url = $domain->domain_name."/api/setting/update_sch_setting";

        $post = [
            'name'=>$this->input->post('name'),
        ];
		
		// Add sch_id only if present
		$sch_id = $this->input->post('sch_id');	
		if(!empty($sch_id)){
			$post['id'] = $sch_id;
		}
		
		$headers = [
            'Api-Key: '.$domain->api_key
        ];
		
		$response = call_api_post($url, $post, $headers);
		
		if($response['status']){
			$this->session->set_flashdata('success', $response['message']);
		}else{
			$this->session->set_flashdata('error', $response['message']);
		}
		redirect('settings');
    }
}