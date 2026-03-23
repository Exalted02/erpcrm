<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_settings extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('domain/Domain_model','domain_model');
        $this->load->model('company_settings/Company_settings_model','company_settings_model');
    }

    public function index()
    {
        $data['company'] = $this->company_settings_model->get_all();
		//echo $company[0]->id;
		//echo "<pre>"; print_r($company);die;
				
        $data['page'] = 'company_settings/index';
        $data['script'] = 'company_settings/index_script';

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
		//echo "<pre>";print_r($_FILES);die;
		//$this->form_validation->set_rules('logo', '	layout/mainogo', 'required|trim');
		$this->form_validation->set_rules('school_name', 'School name', 'required|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['page'] = 'company_settings/index';
			$this->load->view('layout/main',$data);
		}
		else
		{
			$logo = null;
			if(!empty($_FILES['logo']['name']))
			{
				$_FILES['file']['name']     = $_FILES['logo']['name'];
				$_FILES['file']['type']     = $_FILES['logo']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['logo']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['logo']['error'];
				$_FILES['file']['size']     = $_FILES['logo']['size'];
				
				$config['upload_path']   = './uploads/company_settings/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('file')){
					$uploadData = $this->upload->data();
					$logo = $uploadData['file_name'];
				}
				
				// unlink file 
				$fetch = $this->company_settings_model->get($this->input->post('id'));
				$unlinklogo = $fetch->logo;
			    $path = './uploads/company_settings/'. $unlinklogo;
				if(file_exists($path))
				{
					unlink($path);
				}
				
				$data = [
					'id' => $this->input->post('id', true),
					'school_name' => $this->input->post('school_name', true),
					'logo' => $logo,
					'created_at' => date('Y-m-d h:i:s')
				];
			}
			else{
				
				$data = [
					'id' => $this->input->post('id', true),
					'school_name' => $this->input->post('school_name', true),
					'created_at' => date('Y-m-d h:i:s')
				];
				
			}
			
			
			
			
			if($this->input->post('id'))
			{
				
				$this->company_settings_model->update($this->input->post('id'), $data);
			}
			else{
				
				$this->company_settings_model->insert($data);
			}

			$this->session->set_flashdata('success','Company Added Successfully');
			redirect('company_settings');
		}
		//redirect('company_settings');
    }
}
