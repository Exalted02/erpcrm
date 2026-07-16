<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('leads/Leads_model','leads_model');
		$this->load->model('seller/Seller_model','seller_model');
        $this->load->model('subscription/Subscription_model','subscription_model');
        $this->load->model('Country_state_district');
    }

    /*public function index()
    {
		$data['getAllDistrict'] = $this->Country_state_district->get_all_district();
		$data['sellers'] = $this->seller_model->get_all();
        $data['datas'] = $this->leads_model->get_all();
        $data['page'] = 'leads/index';
        $data['script'] = 'leads/index_script';

        $this->load->view('layout/main',$data);
    }*/
	public function index()
	{
		$data['getAllState'] = $this->Country_state_district->get_all_state();
		// $data['getAllDistrict'] = $this->Country_state_district->get_all_district();
		$data['sellers'] = $this->seller_model->get_all();

		$school_name = $this->input->post('school_name');
		$email       = $this->input->post('email');
		$state    = $this->input->post('state');
		$district    = $this->input->post('district');
		$city_name    = $this->input->post('city_name');
		$seller      = $this->input->post('seller');
		$from_date   = $this->input->post('from_date');
		$to_date     = $this->input->post('to_date');

		$this->db->select('*');
		$this->db->from('leads');

		if($this->customlib->getLoginSessionData('user_role') == 1) {
			$this->db->where('seller_id', $this->customlib->getLoginSessionData('user_id'));
		}
		if (!empty($school_name)) {
			$this->db->like('school_name', $school_name);
		}

		if (!empty($email)) {
			$this->db->like('school_email', $email);
		}

		if (!empty($state)) {
			$this->db->where('school_state', $state);
		}

		if (!empty($district)) {
			$this->db->where('school_district', $district);
		}

		if (!empty($city_name)) {
			$this->db->like('school_city', $city_name);
		}

		if (!empty($seller)) {
			$this->db->where('seller_id', $seller);
		}

		// From date
		if (!empty($from_date)) {
			$this->db->where('DATE(created_at) >=', $from_date);
		}

		// To date
		if (!empty($to_date)) {
			$this->db->where('DATE(created_at) <=', $to_date);
		}
		
		$data['datas'] = $this->db->get()->result();

		$data['page'] = 'leads/index';
		$data['script'] = 'leads/index_script';

		$this->load->view('layout/main', $data);
	}

    public function create()
	{
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
			$data['page'] = 'leads/form';
			$data['script'] = 'leads/form_script';
			$this->load->view('layout/main',$data);
		}
		else
		{
			$data = [
				'seller_id' => $this->input->post('coming_form') == 0 ? 0 : $this->customlib->getLoginSessionData('user_id'),
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
				'coming_form' => $this->input->post('coming_form'),
				'status' => 1,
				'created_at' => date('Y-m-d H:i:s')
			];

			$this->leads_model->insert($data);

			$this->session->set_flashdata('success','Leads Added Successfully');
			redirect('leads');
		}
	}

    public function edit($id)
	{
		$lead = $this->leads_model->get($id);

		if(!$lead){
			show_404();
		}

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
			$data['lead'] = $lead;
			$data['page'] = 'leads/form';
			$data['script'] = 'leads/form_script';
			$this->load->view('layout/main',$data);
		}
		else
		{
			
			$data = [
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
			];
			
			$this->leads_model->update($id,$data);

			$this->session->set_flashdata('success','Leads Updated Successfully');
			redirect('leads');
		}
	}
    public function delete()
	{
		$id = $this->input->post('id');

		$this->leads_model->delete($id);

		echo json_encode([
			'status' => 'success'
		]);
	}
	public function change_status()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		$update = $this->leads_model->update_status($id,$status);

		if($update){
			echo json_encode(['status'=>'success']);
		}else{
			echo json_encode(['status'=>'error']);
		}
	}
	
	
    public function followup($id)
	{
		$lead_followup = $this->leads_model->get_lead_followup($id);
		$data['lead_id'] = $id;
		$data['lead_followup'] = $lead_followup;
		$data['remarks'] = $this->db->get(FOLLOWUP_REMARKS)->result();
		
		$data['page'] = 'leads/followup';
        $data['script'] = 'leads/followup_script';
		$this->load->view('layout/main',$data);
	}
	public function save_followup()
	{
		$id = $this->input->post('id');

		$data = [
			'lead_id' => $this->input->post('lead_id'),
			'followup_remarks' => $this->input->post('followup_remarks'),
			'remark_val' => $this->input->post('remark_val'),
			'followup_by' => $this->customlib->getLoginSessionData('user_id'),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		];
		
		$followup_save = $this->leads_model->lead_followup_insert($data, $id);
		if($followup_save){
			if($this->input->post('followup_remarks') == 'Converted'){
				$update = $this->leads_model->update_status($this->input->post('lead_id'), 2);
			}
			if($this->input->post('followup_remarks') == 'Cancel'){
				$update = $this->leads_model->update_status($this->input->post('lead_id'), 3);
			}
			echo json_encode(['status'=>'success', 'message'=>'Followup updated successfully.']);
		}else{
			echo json_encode(['status'=>'error', 'message'=>'Followup not updated.']);
		}
	}
	public function delete_followup($id,$lead_id)
	{
		$followup_save = $this->leads_model->lead_followup_delete($id);
		
		$last_followup = $this->leads_model->get_last_followup($lead_id);
		$lead_status = 1;
		if(isset($last_followup) && $last_followup['id'] != ''){
			if($last_followup['followup_remarks'] == 'Converted'){
				$lead_status = 2;
			}else if($last_followup['followup_remarks'] == 'Cancel'){
				$lead_status = 3;
			}
		}
		$update = $this->leads_model->update_status($lead_id, $lead_status);
		
		echo json_encode(['status' => 'success']);
	}


    public function convert_school($id)
	{
		$lead = $this->leads_model->get($id);

		if(!$lead){
			show_404();
		}

		$this->form_validation->set_rules('school_name', 'School Name', 'required|trim');
		$this->form_validation->set_rules('school_code', 'Code', 'required|trim');
		$this->form_validation->set_rules('school_email', 'Email', 'required|trim');
		$this->form_validation->set_rules('school_phone', 'Phone', 'required|trim');
		$this->form_validation->set_rules('school_address', 'Address', 'trim');
		$this->form_validation->set_rules('total_student', 'Total Student', 'required|numeric');
		$this->form_validation->set_rules('subscription_id', 'Subscription', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['subscriptions'] = $this->subscription_model->get_all();
			$data['lead'] = $lead;
			$data['page'] = 'leads/convert-school';
			$data['script'] = 'leads/convert_script';
			$this->load->view('layout/main',$data);
		}
		else
		{	
			if (isset($_FILES["school_logo"]) && !empty($_FILES['school_logo']['name'])) {
				$fileInfo = pathinfo($_FILES["school_logo"]["name"]);
				// echo '<pre>';print_r($fileInfo);echo'</pre>';exit;
                $school_logo = $this->input->post('school_name', true).time().'.' . $fileInfo['extension'];
				
				$path1 = "uploads/convert_school/" . $lead->school_logo;
				$url = FCPATH . $path1;

				if (file_exists($url)) {
					unlink($url);
				}
				move_uploaded_file($_FILES["school_logo"]["tmp_name"], "./uploads/convert_school/" . $school_logo);
			}
			
			$data = [
				'lead_id' => $lead->id,
				'seller_id' => $lead->seller_id,
				'school_name' => $this->input->post('school_name', true),
				'school_code' => $this->input->post('school_code', true),
				'school_email' => $this->input->post('school_email', true),
				'school_phone' => $this->input->post('school_phone', true),
				'school_address' => $this->input->post('school_address'),
				'total_student' => $this->input->post('total_student'),
				'subscription_id' => $this->input->post('subscription_id'),
				'school_logo' => $school_logo,
			];
			
			$this->leads_model->convert_school($id,$data);
			

			$this->session->set_flashdata('success','Leads Converted to School Successfully');
			redirect('leads');
		}
	}
    public function convertedleads()
    {
        $data['datas'] = $this->leads_model->get_converted_leads();
        $data['subscriptions'] = $this->subscription_model->get_all();
        $data['page'] = 'leads/convertedleads';
        $data['script'] = 'leads/convert_lead_script';

        $this->load->view('layout/main',$data);
    }
    public function convert_school_edit($id)
	{
		$lead = $this->leads_model->get_converted_lead($id);

		if(!$lead){
			show_404();
		}

		$this->form_validation->set_rules('school_name', 'School Name', 'required|trim');
		$this->form_validation->set_rules('school_code', 'Code', 'required|trim');
		$this->form_validation->set_rules('school_email', 'Email', 'required|trim');
		$this->form_validation->set_rules('school_phone', 'Phone', 'required|trim');
		$this->form_validation->set_rules('school_address', 'Address', 'trim');
		$this->form_validation->set_rules('total_student', 'Total Student', 'required|numeric');
		$this->form_validation->set_rules('subscription_id', 'Subscription', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['subscriptions'] = $this->subscription_model->get_all();
			$data['lead'] = $lead;
			$data['page'] = 'leads/convert-school';
			$data['script'] = 'leads/convert_script';
			$this->load->view('layout/main',$data);
		}
		else
		{
			$school_logo = $lead->school_logo;
			if (isset($_FILES["school_logo"]) && !empty($_FILES['school_logo']['name'])) {
				$fileInfo = pathinfo($_FILES["school_logo"]["name"]);
				// echo '<pre>';print_r($fileInfo);echo'</pre>';exit;
                $school_logo = $this->input->post('school_name', true).time().'.' . $fileInfo['extension'];
				
				$path1 = "uploads/convert_school/" . $lead->school_logo;
				$url = FCPATH . $path1;

				if (file_exists($url)) {
					unlink($url);
				}
				move_uploaded_file($_FILES["school_logo"]["tmp_name"], "./uploads/convert_school/" . $school_logo);
			}
			$data = [
				'school_name' => $this->input->post('school_name', true),
				'school_code' => $this->input->post('school_code', true),
				'school_email' => $this->input->post('school_email', true),
				'school_phone' => $this->input->post('school_phone', true),
				'school_address' => $this->input->post('school_address'),
				'total_student' => $this->input->post('total_student'),
				'subscription_id' => $this->input->post('subscription_id'),
				'school_logo' => $school_logo,
			];
			
			$this->leads_model->update_converted_lead($id,$data);

			$this->session->set_flashdata('success','Converted Leads Updated Successfully');
			redirect('leads/convertedleads');
		}
	}
    public function convert_school_delete()
	{
		$id = $this->input->post('id');

		$this->leads_model->delete_converted_school($id);

		echo json_encode([
			'status' => 'success'
		]);
	}
    public function convert_school_data()
	{
		$id = $this->input->post('id');

		$lead = $this->leads_model->get_converted_lead($id);
		$seller = $this->seller_model->get($lead->seller_id);
		$seller_percent = 0;
		if(isset($seller) && $seller->discount_percent != null){
			$seller_percent = $seller->discount_percent;
		}
		echo json_encode([
			'total_student' => $lead->total_student,
			'seller_percent' => $seller_percent,
			'payment_amount' => $lead->total_student - ($lead->total_student * $seller_percent/100),
			'status' => 'success'
		]);
	}
    public function send_payment_request()
	{
		$id = $this->input->post('id');
		$amount = $this->input->post('amount');

		$this->leads_model->send_payment_request($id, $amount);
		
		echo json_encode([
			'status' => 'success'
		]);
	}
    public function get_lead_transfer()
	{
		$id = $this->input->post('id');
		
		$sellers = $this->seller_model->get_all();
		$lead = $this->leads_model->get($id);
		
		echo '<option value="">Please select</option>';
		foreach($sellers as $seller_val){

			echo '<option value="'.$seller_val->id.'" '
				. ($seller_val->id == $lead->seller_id ? 'selected' : '')
				. '>'
				. $seller_val->name .
				'</option>';
		}
	}
    public function submit_transfer_lead()
	{
		$seller_id = $this->input->post('seller_id');
		$lead_id = $this->input->post('lead_id');

		$data = [
			'seller_id' => $seller_id,
		];
		
		$this->leads_model->update($lead_id,$data);
		
		echo json_encode([
			'status' => 'success'
		]);
	}
}
