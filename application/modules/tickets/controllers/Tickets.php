<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tickets/Tickets_model','tickets_model');
    }
	public function index()
	{
		$school_name = $this->input->post('school_name');
		$school_code_id = $this->input->post('school_code_id');
		$ticket_type = $this->input->post('ticket_type');
		$ticket_status = $this->input->post('ticket_status');

		$this->db->select('*');
		$this->db->from(TICKETS);

		if (!empty($school_name)) {
			$this->db->like('school_name', $school_name);
		}

		if (!empty($school_code_id)) {
			$this->db->like('school_code_id', $school_code_id);
		}

		if (isset($ticket_type) && $ticket_type !== '') {
			$this->db->where('ticket_type', $ticket_type);
		}
		
		if (!empty($ticket_status)) {
			$this->db->where('status', $ticket_status);
		}else{
			$this->db->where('status !=', 0);
		}
		
		$data['datas'] = $this->db->get()->result();

		$data['page'] = 'tickets/index';
		$data['script'] = 'tickets/index_script';

		$this->load->view('layout/main', $data);
	}
	public function followup($id)
	{
		$data['ticket_id'] = $id;
		$data['ticket_followup'] = $this->tickets_model->get_ticket_followup($id);
		
		$data['get_ticket_details'] = $this->tickets_model->get_ticket_by_id($id);
		$data['ticket_files'] = $this->db
			->where('ticket_id', $id)
			->get(TICKET_FILES)
			->result_array();;
		if($data['get_ticket_details']->status == 1){
			$update_ticket_status = $this->tickets_model->add_ticket(['id'=>$id, 'status'=>2]);
		}
		
		$data['page'] = 'tickets/followup';
        $data['script'] = 'tickets/followup_script';
		$this->load->view('layout/main',$data);
	}
	public function save_followup()
	{
		$id = $this->input->post('id');

		$data = [
			'ticket_id' => $this->input->post('ticket_id'),
			'user_type' => 0,
			'message' => $this->input->post('message'),
		];
		
		$followup_save = $this->tickets_model->ticket_followup_insert($data, $id);
		if($followup_save){
			echo json_encode(['status'=>'success', 'message'=>'Followup successfully.']);
		}else{
			echo json_encode(['status'=>'error', 'message'=>'Followup not updated.']);
		}
	}
	public function delete_followup($id)
	{
		$followup_save = $this->tickets_model->ticket_followup_delete($id);
		echo json_encode(['status' => 'success']);
	}
}
