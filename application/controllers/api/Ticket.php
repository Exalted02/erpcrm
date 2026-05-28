<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends MX_Controller  {
 
    public function __construct() {
        parent::__construct();
        $this->load->model('Api_model');
        $this->load->model('Country_state_district');
        $this->load->model('subscription/Subscription_model','subscription_model');
 
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *'); // VERY IMPORTANT
        header('Access-Control-Allow-Methods: GET');
    }
 
    public function get_ticket_type($api_key) {
		$data['data'] = ticket_type_array();
		echo json_encode($data);
    }
	public function create_ticket()
	{
		$school_id = $this->input->post('school_id');
		$school_code_id = $this->input->post('school_code_id');
		$school_name = $this->input->post('school_name');
		$ticket_type = $this->input->post('ticket_type');
		$subject     = $this->input->post('subject');
		$body        = $this->input->post('body');

		$ticketData = [
			'school_id' => $school_id,
			'school_code_id' => $school_code_id,
			'school_name' => $school_name,
			'ticket_type' => $ticket_type,
			'subject'     => $subject,
			'body'        => $body,
			'status'      => 1,
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')
		];

		$this->db->insert(TICKETS, $ticketData);

		$ticket_id = $this->db->insert_id();

		// upload new files
		if (!empty($_FILES)) {

			$path = FCPATH . 'uploads/tickets/';

			// create folder if not exists
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			foreach ($_FILES as $key => $file) {

				// skip empty upload
				if (empty($file['tmp_name'])) {
					continue;
				}

				$_FILES['single_file']['name']     = $file['name'];
				$_FILES['single_file']['type']     = $file['type'];
				$_FILES['single_file']['tmp_name'] = $file['tmp_name'];
				$_FILES['single_file']['error']    = $file['error'];
				$_FILES['single_file']['size']     = $file['size'];

				$config['upload_path']   = $path;
				$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx';
				$config['encrypt_name']  = true;

				$this->load->library('upload');

				$this->upload->initialize($config);

				if ($this->upload->do_upload('single_file')) {

					$uploadData = $this->upload->data();

					$fileData = [
						'ticket_id' => $ticket_id ?? $id,
						'file'      => $uploadData['file_name']
					];

					$this->db->insert(TICKET_FILES, $fileData);

				} else {

					echo $this->upload->display_errors();
					exit;
				}
			}
		}

		echo json_encode([
			'status' => true,
			'message' => 'Ticket created successfully'
		]);
	}
	public function ticket_list($api_key)
	{
		$domain = $this->Api_model->get_domain_data($api_key);
		$this->db->where('status !=', 0);
		$this->db->where('school_id', $domain->id);

		$tickets = $this->db->get(TICKETS)->result_array();

		foreach ($tickets as &$ticket) {

			$files = $this->db
				->where('ticket_id', $ticket['id'])
				->get(TICKET_FILES)
				->result_array();

			$ticket['files'] = $files;
		}

		echo json_encode([
			'status' => true,
			'data' => $tickets
		]);
	}
	public function ticket_counter($api_key)
	{
		$domain = $this->Api_model->get_domain_data($api_key);

		// pending = 1
		$pending = $this->db
			->where('school_id', $domain->id)
			->where('status', 1)
			->count_all_results(TICKETS);

		// open = 2
		$open = $this->db
			->where('school_id', $domain->id)
			->where('status', 2)
			->count_all_results(TICKETS);

		// close = 3
		$close = $this->db
			->where('school_id', $domain->id)
			->where('status', 3)
			->count_all_results(TICKETS);

		// total active tickets
		$total = $this->db
			->where('school_id', $domain->id)
			->where('status !=', 0)
			->count_all_results(TICKETS);

		echo json_encode([
			'status' => true,
			'data' => [
				'total'   => $total,
				'pending' => $pending,
				'open'    => $open,
				'close'   => $close
			]
		]);
	}
	public function ticket_details($id)
	{
		$ticket = $this->db
			->where('id', $id)
			->get(TICKETS)
			->row_array();

		$files = $this->db
			->where('ticket_id', $id)
			->get(TICKET_FILES)
			->result_array();

		$ticket['files'] = $files;

		echo json_encode([
			'status' => true,
			'data' => $ticket
		]);
	}
	public function update_ticket($id)
	{
		$updateData = [
			'school_id' => $this->input->post('school_id'),
			'school_code_id' => $this->input->post('school_code_id'),
			'school_name' => $this->input->post('school_name'),
			'ticket_type' => $this->input->post('ticket_type'),
			'subject'     => $this->input->post('subject'),
			'body'        => $this->input->post('body'),
			'updated_at'  => date('Y-m-d H:i:s')
		];

		$this->db->where('id', $id);
		$this->db->update(TICKETS, $updateData);

		// upload new files
		if (!empty($_FILES)) {

			$path = FCPATH . 'uploads/tickets/';

			// create folder if not exists
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			foreach ($_FILES as $key => $file) {

				// skip empty upload
				if (empty($file['tmp_name'])) {
					continue;
				}

				$_FILES['single_file']['name']     = $file['name'];
				$_FILES['single_file']['type']     = $file['type'];
				$_FILES['single_file']['tmp_name'] = $file['tmp_name'];
				$_FILES['single_file']['error']    = $file['error'];
				$_FILES['single_file']['size']     = $file['size'];

				$config['upload_path']   = $path;
				$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx';
				$config['encrypt_name']  = true;

				$this->load->library('upload');

				$this->upload->initialize($config);

				if ($this->upload->do_upload('single_file')) {

					$uploadData = $this->upload->data();

					$fileData = [
						'ticket_id' => $ticket_id ?? $id,
						'file'      => $uploadData['file_name']
					];

					$this->db->insert(TICKET_FILES, $fileData);

				} else {

					echo $this->upload->display_errors();
					exit;
				}
			}
		}

		echo json_encode([
			'status' => true,
			'message' => 'Ticket updated successfully'
		]);
	}
	public function delete_ticket($id)
	{
		$this->db->where('id', $id);

		$this->db->update(TICKETS, [
			'status' => 0
		]);

		echo json_encode([
			'status' => true,
			'message' => 'Ticket deleted'
		]);
	}
	public function delete_ticket_file($id)
	{
		$file = $this->db
			->where('id', $id)
			->get(TICKET_FILES)
			->row_array();

		if (!empty($file)) {

			$path = FCPATH . 'uploads/tickets/' . $file['file'];

			if (file_exists($path)) {
				unlink($path);
			}

			$this->db->where('id', $id);
			$this->db->delete(TICKET_FILES);
		}

		echo json_encode([
			'status' => true
		]);
	}
}
