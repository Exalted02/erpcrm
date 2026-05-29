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
		
		$image = $this->input->post('old_image');

		// Upload Image
		if (!empty($_FILES['followup_image']['name'])) {

			$config['upload_path']   = './uploads/followups/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['encrypt_name']  = true;

			if (!is_dir($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('followup_image')) {

				// delete old image
				if (!empty($image) && file_exists('./uploads/followups/' . $image)) {
					unlink('./uploads/followups/' . $image);
				}

				$uploadData = $this->upload->data();
				$image = $uploadData['file_name'];
			}
		}
		$data = [
			'ticket_id' => $this->input->post('ticket_id'),
			'user_type' => 0,
			'message' => $this->input->post('message'),
			'image'     => $image,
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
		// Get followup details
		$followup = $this->db
			->where('id', $id)
			->get(TICKET_FOLLOWUPS)
			->row();

		if (!empty($followup)) {

			// Delete image if exists
			if (!empty($followup->image)) {

				$image_path = './uploads/followups/' . $followup->image;

				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}

			// Delete database row
			$delete = $this->db
				->where('id', $id)
				->delete(TICKET_FOLLOWUPS);

			if ($delete) {

				echo json_encode([
					'status' => 'success',
					'message' => 'Followup deleted successfully.'
				]);

			} else {

				echo json_encode([
					'status' => 'error',
					'message' => 'Delete failed.'
				]);
			}

		} else {

			echo json_encode([
				'status' => 'error',
				'message' => 'Followup not found.'
			]);
		}
	}
}
