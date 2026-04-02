<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('leads/Leads_model','leads_model');
        $this->load->model('subscription/Subscription_model','subscription_model');
    }

    public function index()
    {
        $data['datas'] = $this->leads_model->get_all();
        $data['page'] = 'leads/index';
        $data['script'] = 'leads/index_script';

        $this->load->view('layout/main',$data);
    }

    public function create()
	{
		$this->form_validation->set_rules('school_name', 'School Name', 'required|trim');
		$this->form_validation->set_rules('school_code', 'Code', 'required|trim');
		$this->form_validation->set_rules('school_email', 'Email', 'required|trim');
		$this->form_validation->set_rules('school_phone', 'Phone', 'required|trim');
		$this->form_validation->set_rules('school_address', 'Address', 'trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['page'] = 'leads/form';
			$this->load->view('layout/main',$data);
		}
		else
		{
			$data = [
				'seller_id' => $this->customlib->getLoginSessionData('user_id'),
				'school_name' => $this->input->post('school_name', true),
				'school_code' => $this->input->post('school_code', true),
				'school_email' => $this->input->post('school_email', true),
				'school_phone' => $this->input->post('school_phone', true),
				'school_address' => $this->input->post('school_address'),
				'status' => 1
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
		$this->form_validation->set_rules('school_code', 'Code', 'required|trim');
		$this->form_validation->set_rules('school_email', 'Email', 'required|trim');
		$this->form_validation->set_rules('school_phone', 'Phone', 'required|trim');
		$this->form_validation->set_rules('school_address', 'Address', 'trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['lead'] = $lead;
			$data['page'] = 'leads/form';
			$this->load->view('layout/main',$data);
		}
		else
		{
			
			$data = [
				'school_name' => $this->input->post('school_name', true),
				'school_code' => $this->input->post('school_code', true),
				'school_email' => $this->input->post('school_email', true),
				'school_phone' => $this->input->post('school_phone', true),
				'school_address' => $this->input->post('school_address'),
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
			echo json_encode(['status'=>'success', 'message'=>'Followup updated successfully.']);
		}else{
			echo json_encode(['status'=>'error', 'message'=>'Followup not updated.']);
		}
	}
	public function delete_followup($id)
	{
		$followup_save = $this->leads_model->lead_followup_delete($id);
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

		if ($this->form_validation->run() == FALSE)
		{
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
        $data['script'] = 'leads/convert_list_script';

        $this->load->view('layout/main',$data);
    }
}
