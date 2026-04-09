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
    if (empty($this->input->post('id'))) {
        if (empty($_FILES['logo']['name'])) {
            $this->form_validation->set_rules('logo', 'Logo', 'required');
        }
    }

    $this->form_validation->set_rules('school_name', 'School name', 'required|trim');
    $this->form_validation->set_rules('website_url', 'Website url', 'required|trim');

    if ($this->form_validation->run() == FALSE) {
        $data['page'] = 'company_settings/index';
        $data['script'] = 'company_settings/index_script';
        $this->load->view('layout/main', $data);
    } else {

        $logo = null;

        if (!empty($_FILES['logo']['name'])) {

            // ✅ Get extension safely
            $ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));

            // ✅ Upload config
            $config['upload_path']   = './uploads/company_settings/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
            $config['file_name']     = 'easyskool.' . $ext;
            $config['overwrite']     = TRUE;

            // 🔥 IMPORTANT FIX FOR WEBP
           // $config['detect_mime']   = FALSE;
            //$config['mod_mime_fix']  = FALSE;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('logo')) {

                $uploadData = $this->upload->data();
                $logo = $uploadData['file_name'];

                // ✅ Delete old file ONLY after successful upload
                if ($this->input->post('id')) {
                    $fetch = $this->company_settings_model->get($this->input->post('id'));

                    if (!empty($fetch->logo)) {
                        $oldPath = './uploads/company_settings/' . $fetch->logo;

                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                        }
                    }
                }

            } else {
                echo $this->upload->display_errors();
                exit;
            }
        }

        // ✅ Prepare data
        $data = [
            'school_name' => $this->input->post('school_name', true),
            'website_url' => $this->input->post('website_url', true),
            'created_at'  => date('Y-m-d H:i:s')
        ];

        if ($logo !== null) {
            $data['logo'] = $logo;
        }

        // ✅ Insert or Update
        if ($this->input->post('id')) {

            $this->company_settings_model->update($this->input->post('id'), $data);
            $this->session->set_flashdata('success', 'Company Updated Successfully');

        } else {

            $this->company_settings_model->insert($data);
            $this->session->set_flashdata('success', 'Company Added Successfully');
        }

        redirect('company_settings');
    }
}
}
