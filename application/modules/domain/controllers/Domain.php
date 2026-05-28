<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Domain extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('domain/Domain_model','domain_model');
        $this->load->model('Country_state_district');
    }

    public function index()
    {
        $data['domains'] = $this->domain_model->get_all();
        $data['page'] = 'domain/index';
        $data['script'] = 'domain/index_script';

        $this->load->view('layout/main',$data);
    }

    public function create()
	{
		// validation rules
		$this->form_validation->set_rules('domain_name', 'Domain Name', 'required|trim|valid_url');
		$this->form_validation->set_rules('api_key', 'API Key', 'required|trim');
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

		if ($this->form_validation->run() == FALSE)
		{
			$data['school_code_data'] = $this->generate_school_code();
			
			$data['getAllState'] = $this->Country_state_district->get_all_state();
			$data['page'] = 'domain/form';
			$data['script'] = 'domain/form_script';

			$this->load->view('layout/main',$data);
		}
		else
		{
			$domain  = $this->input->post('domain_name', true);
			$api_key = $this->input->post('api_key', true);
			$code_year = $this->input->post('code_year', true);
			$code_number = $this->input->post('code_number', true);

			$data = [
				'domain_name' => $domain,
				'api_key'     => $api_key,
				'code_year'     => $code_year,
				'code_number'     => $code_number,
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
				'status'      => 1
			];

			$this->domain_model->insert($data);

			// API call
			$this->update_erp_api_key($domain,$api_key);

			$this->session->set_flashdata('success','Domain Added Successfully');
			redirect('api-domain');
		}
	}
	
	public function edit($id)
	{
		$domainData = $this->domain_model->get($id);

		if(!$domainData){
			show_404();
		}

		$this->form_validation->set_rules('domain_name', 'Domain Name', 'required|trim|valid_url');
		$this->form_validation->set_rules('api_key', 'API Key', 'required|trim');
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

		if ($this->form_validation->run() == FALSE)
		{
			if(!empty($domainData->code_year) && !empty($domainData->code_number)){

				$schoolCode = $domainData->code_year .
					str_pad((string)$domainData->code_number, 4, '0', STR_PAD_LEFT);

			}else{

				// Generate new code for old records
				$newCode = $this->generate_school_code();

				$schoolCode = $newCode['school_code'];
			}

			$data['school_code_data'] = [
				'school_code' => $schoolCode
			];
			
			$data['getAllState'] = $this->Country_state_district->get_all_state();
			$data['domain'] = $domainData;
			$data['page'] = 'domain/form';
			$data['script'] = 'domain/form_script';

			$this->load->view('layout/main',$data);
		}
		else
		{
			$domain  = $this->input->post('domain_name', true);
			$api_key = $this->input->post('api_key', true);
			$code_year = $this->input->post('code_year', true);
			$code_number = $this->input->post('code_number', true);

			$data = [
				'domain_name' => $domain,
				'api_key'     => $api_key,
				'code_year'     => $code_year,
				'code_number'     => $code_number,
				'name' => $this->input->post('name', true),
				'dise_code' => $this->input->post('dise_code', true),
				'aff_no' => $this->input->post('aff_no', true),
				'address'     => $this->input->post('address', true),
				'phone'     => $this->input->post('phone', true),
				'alternate_no' => $this->input->post('alternate_no', true),
				'email'     => $this->input->post('email', true),
				'school_country'     => $this->input->post('school_country', true),
				'school_state'     => $this->input->post('school_state', true),
				'school_district'     => $this->input->post('school_district', true),
				'school_city'     => $this->input->post('school_city', true),
				'school_pin_code'     => $this->input->post('school_pin_code', true),
			];

			$this->domain_model->update($id,$data);
			
			$post = [
				'domain_api_key'=>$api_key,
				'name'=>$this->input->post('name'),
				'dise_code'=>$this->input->post('dise_code'),
				'aff_no'=>$this->input->post('aff_no'),
				'address'=>$this->input->post('address'),
				'phone'=>$this->input->post('phone'),
				'alternate_no'=>$this->input->post('alternate_no'),
				'email'=>$this->input->post('email')
			];
			$url = $domain."/api/system/update_api_key";

			$response = $this->update_erp_api_key($url,$post);

			if(isset($response['status']) && $response['status']){
				$this->session->set_flashdata('success',$response['message']);
			}else{
				$this->session->set_flashdata('error',$response['message'] ?? 'API failed');
			}

			redirect('api-domain');
		}
	}

    public function delete()
	{
		$id = $this->input->post('id');

		$this->domain_model->delete($id);

		echo json_encode([
			'status' => 'success'
		]);
	}
	public function change_status()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$reason = trim($this->input->post('reason'));
		
		// Validation
		if($status == 0 && empty($reason)){

			return $this->response->setJSON([
				'status' => 'error',
				'message' => 'Reason is required'
			]);

		}
		
		$data = [
			'status' => $status,
			'disable_reason' => $reason
		];

		$update = $this->domain_model->update_status($id,$data);

		if($update){

			echo json_encode([
				'status'  => 'success',
				'message' => 'Status updated successfully'
			]);

		}else{

			echo json_encode([
				'status'  => 'error',
				'message' => 'Failed to update status'
			]);

		}
	}
	
	private function update_erp_api_key($url,$post)
    {
		$response = call_api_post($url, $post);
		
        return $response;

    }
	private function generate_school_code()
	{
		$currentYear = date('Y');

		$lastCode = $this->domain_model->get_last_code($currentYear);
		
		if ($lastCode) {
			$nextNumber = $lastCode->code_number + 1;
		} else {
			$nextNumber = 1;
		}

		return [
			'code_year'   => $currentYear,
			'code_number' => $nextNumber,
			'school_code' => $currentYear . str_pad($nextNumber, 4, '0', STR_PAD_LEFT)
		];
	}
}
