<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_settings extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('domain/Domain_model','domain_model');
        $this->load->model('company_settings/Company_settings_model','company_settings_model');
        $this->load->model('Country_state_district');
    }

    public function index()
    {
		if (empty($this->input->post('id'))) {
			if (empty($_FILES['logo']['name'])) {
				$this->form_validation->set_rules('logo', 'Logo', 'required');
			}
		}

		$this->form_validation->set_rules('company_name', 'Company Name', 'required|trim');
		$this->form_validation->set_rules('product_name', 'Product Name', 'required|trim');
		$this->form_validation->set_rules('country', 'Country', 'required|trim');
		$this->form_validation->set_rules('state', 'State', 'required|trim');
		$this->form_validation->set_rules('district', 'District', 'required|trim');
		$this->form_validation->set_rules('city', 'City', 'required|trim');
		$this->form_validation->set_rules('pin_code', 'Pin Code', 'required|trim');
		$this->form_validation->set_rules('address', 'Address', 'trim');
		$this->form_validation->set_rules('pan_no', 'PAN NO', 'required|trim');
		$this->form_validation->set_rules('gst_no', 'GST No', 'required|trim');
		$this->form_validation->set_rules('contact_no', 'Contact No', 'required|trim');
		$this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email'
        );
		$this->form_validation->set_rules('support_no', 'Support No', 'required|trim');
		$this->form_validation->set_rules('relationship_manager_no', 'Relationship Manager No', 'required|trim');
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'required|trim');
		$this->form_validation->set_rules('account_no', 'Account No', 'required|trim');
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'required|trim');
		$this->form_validation->set_rules('branch_name', 'Branch Name', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$data['company'] = $this->company_settings_model->get_all();
			//echo $company[0]->id;
			//echo "<pre>"; print_r($company);die;
					
			$data['getAllState'] = $this->Country_state_district->get_all_state();
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
				'school_name' => $this->input->post('company_name', true),
				'product_name' => $this->input->post('product_name', true),
				'country' => $this->input->post('country', true),
                'state'      => $this->input->post('state', true),
                'district'      => $this->input->post('district', true),
                'city'      => $this->input->post('city', true),
                'pin_code'      => $this->input->post('pin_code', true),
                'address'      => $this->input->post('address', true),
                'pan_no'      => $this->input->post('pan_no', true),
                'gst_no'      => $this->input->post('gst_no', true),
                'contact_no'      => $this->input->post('contact_no', true),
                'email'      => $this->input->post('email', true),
                'support_no'      => $this->input->post('support_no', true),
                'relationship_manager_no'      => $this->input->post('relationship_manager_no', true),
                'bank_name'      => $this->input->post('bank_name', true),
                'account_no'      => $this->input->post('account_no', true),
                'ifsc_code'      => $this->input->post('ifsc_code', true),
                'branch_name'      => $this->input->post('branch_name', true),
				// 'website_url' => $this->input->post('website_url', true),
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
				$this->session->set_flashdata('success', 'Company Details updated Successfully');
			}

			redirect('company_settings');
		}
    }
	/*public function store()
	{
		
	}*/
}
