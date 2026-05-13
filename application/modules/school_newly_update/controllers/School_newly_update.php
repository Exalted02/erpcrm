<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School_newly_update extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('school_newly_update/School_newly_update_model','school_newly_update_model');
    }

    public function index()
    {
        $data['schoolnewly'] = $this->school_newly_update_model->get_all();
        $data['page'] = 'school_newly_update/index';
        $data['script'] = 'school_newly_update/index_script';

        $this->load->view('layout/main',$data);
    }

    public function create()
	{
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('release_date', 'Release date', 'required|trim');
		$this->form_validation->set_rules('details', 'Details', 'required|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['page'] = 'school_newly_update/form';
			$this->load->view('layout/main',$data);
		}
		else
		{
			$data = [
				'title' => $this->input->post('title', true),
				'release_date' => date('Y-m-d H:i:s', strtotime($this->input->post('release_date', true))),
				'details' => $this->input->post('details', true),
				'status' => 1
			];

			$this->school_newly_update_model->insert($data);

			$this->session->set_flashdata('success','ERP Updates Added Successfully');
			redirect('school_newly_update');
		}
	}

    public function edit($id)
	{
		$schoolnewly = $this->school_newly_update_model->get($id);

		if(!$schoolnewly){
			show_404();
		}

		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('release_date', 'Release date', 'required|trim');
		$this->form_validation->set_rules('details', 'Details', 'required|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['schoolnewly'] = $schoolnewly;
			$data['page'] = 'school_newly_update/form';
			$this->load->view('layout/main',$data);
		}
		else
		{
			
			$data = [
				'title' => $this->input->post('title', true),
				'release_date' => date('Y-m-d H:i:s', strtotime($this->input->post('release_date', true))),
				'details' => $this->input->post('details', true)
			];
			
			$this->school_newly_update_model->update($id,$data);

			$this->session->set_flashdata('success','ERP Updates Updated Successfully');
			redirect('school_newly_update');
		}
	}

    public function delete()
	{
		$id = $this->input->post('id');

		$this->school_newly_update_model->delete($id);

		echo json_encode([
			'status' => 'success'
		]);
	}
	public function change_status()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		$update = $this->school_newly_update_model->update_status($id,$status);

		if($update){
			echo json_encode(['status'=>'success']);
		}else{
			echo json_encode(['status'=>'error']);
		}
	}
}
