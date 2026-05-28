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
		
		$data['page'] = 'tickets/followup';
        $data['script'] = 'tickets/followup_script';
		$this->load->view('layout/main',$data);
	}
}
