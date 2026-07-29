<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('services/Services_model','services_model');
    }

    public function index()
    {
		$data['subscriptionDuration'] = $this->customlib->subscriptionDuration();
        $data['services'] = $this->services_model->get_all();
        $data['page'] = 'services/index';
        $data['script'] = 'services/index_script';

        $this->load->view('layout/main',$data);
    }

    public function create()
	{
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
		$this->form_validation->set_rules('duration', 'Duration', 'required|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['subscriptionDuration'] = $this->customlib->subscriptionDuration();
			$data['page'] = 'services/form';
			$data['script'] = 'services/form_script';
			$this->load->view('layout/main',$data);
		}
		else
		{
			$data = [
				'title' => $this->input->post('title', true),
				'price' => $this->input->post('price', true),
				'duration' => $this->input->post('duration', true),
				'description' => $this->input->post('description', false),
				'status' => 1
			];

			$this->services_model->insert($data);

			$this->session->set_flashdata('success','Service Added Successfully');
			redirect('services');
		}
	}

    public function edit($id)
	{
		$service = $this->services_model->get($id);

		if(!$service){
			show_404();
		}

		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
		$this->form_validation->set_rules('duration', 'Duration', 'required|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['subscriptionDuration'] = $this->customlib->subscriptionDuration();
			$data['service'] = $service;
			$data['script'] = 'services/form_script';
			$data['page'] = 'services/form';
			$this->load->view('layout/main',$data);
		}
		else
		{
			$data = [
				'title' => $this->input->post('title', true),
				'price' => $this->input->post('price', true),
				'duration' => $this->input->post('duration', true),
				'description' => $this->input->post('description', false),
			];

			$this->services_model->update($id,$data);

			$this->session->set_flashdata('success','Service Updated Successfully');
			redirect('services');
		}
	}

    public function delete()
	{
		$id = $this->input->post('id');

		$this->services_model->delete($id);

		echo json_encode([
			'status' => 'success'
		]);
	}
	public function change_status()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		$update = $this->services_model->update_status($id,$status);

		if($update){
			echo json_encode(['status'=>'success']);
		}else{
			echo json_encode(['status'=>'error']);
		}
	}
}
