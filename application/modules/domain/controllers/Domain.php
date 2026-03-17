<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Domain extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('domain/Domain_model','domain_model');
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
        $data['page'] = 'domain/form';
		
        $data['script'] = 'domain/form_script';
		
        $this->load->view('layout/main',$data);
    }

    public function store()
    {
		$domain = $this->input->post('domain_name');
        $api_key = $this->input->post('api_key');
		
        $data = [
            'domain_name' => $domain,
            'api_key' => $api_key,
            'status' => 1
        ];

        $this->domain_model->insert($data);
		
		/* -----------------------
           CALL ERP API
        ------------------------ */
        $this->update_erp_api_key($domain,$api_key);

        $this->session->set_flashdata('success', 'Domain Added Successfully');
		redirect('api-domain');
    }

    public function edit($id)
    {
        $data['domain'] = $this->domain_model->get($id);
        $data['page'] = 'domain/form';

        $data['script'] = 'domain/form_script';
		
        $this->load->view('layout/main',$data);
    }

    public function update($id)
    {
		$domain = $this->input->post('domain_name');
        $api_key = $this->input->post('api_key');
		
        $data = [
            'domain_name' => $this->input->post('domain_name'),
            'api_key' => $this->input->post('api_key'),
        ];

        $this->domain_model->update($id,$data);
		
		/* -----------------------
           CALL SCHOOL API
        ------------------------ */
        $response = $this->update_erp_api_key($domain,$api_key);
		if($response['status']){
			$this->session->set_flashdata('success', $response['message']);
		}else{
			$this->session->set_flashdata('error', $response['message']);
		}
        redirect('api-domain');
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

		$update = $this->domain_model->update_status($id,$status);

		if($update){
			echo json_encode(['status'=>'success']);
		}else{
			echo json_encode(['status'=>'error']);
		}
	}
	
	private function update_erp_api_key($domain,$api_key)
    {

        $url = $domain."/api/system/update_api_key";

        $post = [
            'api_key'=>$api_key
        ];
		
		$response = call_api_post($url, $post);
		
        return $response;

    }
}