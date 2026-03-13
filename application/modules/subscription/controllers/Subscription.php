<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('subscription/Subscription_model','subscription_model');
    }

    public function index()
    {
        $data['subscriptions'] = $this->subscription_model->get_all();
        $data['page'] = 'subscription/index';
        $data['script'] = 'subscription/index_script';

        $this->load->view('layout/main',$data);
    }

    public function create()
    {
        $data['page'] = 'subscription/form';
        $this->load->view('layout/main',$data);
    }

    public function store()
    {
        $data = [
            'title' => $this->input->post('title'),
            'price' => $this->input->post('price'),
            'duration' => $this->input->post('duration'),
            'description' => $this->input->post('description'),
            'status' => 1
        ];

        $this->subscription_model->insert($data);

        $this->session->set_flashdata('success', 'Subscription Added Successfully');
		redirect('subscription');
    }

    public function edit($id)
    {
        $data['subscription'] = $this->subscription_model->get($id);
        $data['page'] = 'subscription/form';

        $this->load->view('layout/main',$data);
    }

    public function update($id)
    {
        $data = [
            'title' => $this->input->post('title'),
            'price' => $this->input->post('price'),
            'duration' => $this->input->post('duration'),
            'description' => $this->input->post('description'),
        ];

        $this->subscription_model->update($id,$data);

        $this->session->set_flashdata('success', 'Subscription Updated Successfully');
        redirect('subscription');
    }

    public function delete()
	{
		$id = $this->input->post('id');

		$this->subscription_model->delete($id);

		echo json_encode([
			'status' => 'success'
		]);
	}
	public function change_status()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		$update = $this->subscription_model->update_status($id,$status);

		if($update){
			echo json_encode(['status'=>'success']);
		}else{
			echo json_encode(['status'=>'error']);
		}
	}
}