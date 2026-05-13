<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('seller/Seller_model','seller_model');
        $this->load->model('Country_state_district');
    }

    public function index()
    {
        $data['sellers'] = $this->seller_model->get_all();
        $data['page'] = 'seller/index';
        $data['script'] = 'seller/index_script';

        $this->load->view('layout/main',$data);
    }

    public function create()
    {
        $this->form_validation->set_rules('firm_name', 'Firm Name', 'required|trim');
        $this->form_validation->set_rules('name', 'Re-Seller Name', 'required|trim');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required|trim');
        $this->form_validation->set_rules('have_gst', 'GST', 'required|trim');
        if($this->input->post('have_gst') == 1){
			$this->form_validation->set_rules('gst_no', 'GST No', 'required|trim');
		}
        $this->form_validation->set_rules('working_experience', 'Working Experience', 'required|trim');
		$this->form_validation->set_rules('seller_country', 'Country', 'required|trim');
		$this->form_validation->set_rules('seller_state', 'State', 'required|trim');
		$this->form_validation->set_rules('seller_district', 'District', 'required|trim');
		$this->form_validation->set_rules('seller_city', 'City', 'required|trim');
		$this->form_validation->set_rules('seller_pin_code', 'Pin Code', 'required|trim');
		$this->form_validation->set_rules('seller_address', 'Address', 'trim');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email|is_unique[users.email]'
        );
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('discount_percent', 'Discount Percent', 'required');

        if ($this->form_validation->run() == FALSE)
        {
			$data['getAllState'] = $this->Country_state_district->get_all_state();
            $data['page'] = 'seller/form';
			$data['script'] = 'seller/form_script';
            $this->load->view('layout/main',$data);
        }
        else
        {
            $data = [
                'firm_name'       => $this->input->post('firm_name', true),
                'name'       => $this->input->post('name', true),
                'mobile_no'       => $this->input->post('mobile_no', true),
                'alternate_mobile_no'       => $this->input->post('alternate_mobile_no', true),
                'email'      => $this->input->post('email', true),
                'have_gst'      => $this->input->post('have_gst', true),
                'gst_no'      => $this->input->post('gst_no', true),
                'working_experience'      => $this->input->post('working_experience', true),
                'seller_country'      => $this->input->post('seller_country', true),
                'seller_state'      => $this->input->post('seller_state', true),
                'seller_district'      => $this->input->post('seller_district', true),
                'seller_city'      => $this->input->post('seller_city', true),
                'seller_pin_code'      => $this->input->post('seller_pin_code', true),
                'seller_address'      => $this->input->post('seller_address', true),
                'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'discount_percent'   => $this->input->post('discount_percent'),
                'user_role'  => 1,
                'status'     => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->seller_model->insert($data);

            $this->session->set_flashdata('success','Seller Added Successfully');
            redirect('seller');
        }
    }

    public function edit($id)
    {
        $seller = $this->seller_model->get($id);

        if(!$seller){
            show_404();
        }

        $this->form_validation->set_rules('firm_name', 'Firm Name', 'required|trim');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        // Email unique check (ignore current)
        $email = $this->input->post('email');
        if ($email && $email != $seller->email) {
            $this->form_validation->set_rules(
                'email',
                'Email',
                'required|valid_email|is_unique[users.email]'
            );
        } else {
            $this->form_validation->set_rules(
                'email',
                'Email',
                'required|valid_email'
            );
        }
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required|trim');
        $this->form_validation->set_rules('have_gst', 'GST', 'required|trim');
        if($this->input->post('have_gst') == 1){
			$this->form_validation->set_rules('gst_no', 'GST No', 'required|trim');
		}
        $this->form_validation->set_rules('working_experience', 'Working Experience', 'required|trim');
		$this->form_validation->set_rules('seller_country', 'Country', 'required|trim');
		$this->form_validation->set_rules('seller_state', 'State', 'required|trim');
		$this->form_validation->set_rules('seller_district', 'District', 'required|trim');
		$this->form_validation->set_rules('seller_city', 'City', 'required|trim');
		$this->form_validation->set_rules('seller_pin_code', 'Pin Code', 'required|trim');
		$this->form_validation->set_rules('seller_address', 'Address', 'trim');

        $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
        $this->form_validation->set_rules('discount_percent', 'Discount Percent', 'required');

        if ($this->form_validation->run() == FALSE)
        {
			$data['getAllState'] = $this->Country_state_district->get_all_state();
            $data['seller'] = $seller;
            $data['page'] = 'seller/form';
			$data['script'] = 'seller/form_script';
            $this->load->view('layout/main',$data);
        }
        else
        {
            $data = [
                'firm_name'       => $this->input->post('firm_name', true),
                'name'  => $this->input->post('name', true),
                'mobile_no'       => $this->input->post('mobile_no', true),
                'alternate_mobile_no'       => $this->input->post('alternate_mobile_no', true),
                'email' => $this->input->post('email', true),
                'have_gst'      => $this->input->post('have_gst', true),
                'gst_no'      => $this->input->post('gst_no', true),
                'working_experience'      => $this->input->post('working_experience', true),
                'seller_country'      => $this->input->post('seller_country', true),
                'seller_state'      => $this->input->post('seller_state', true),
                'seller_district'      => $this->input->post('seller_district', true),
                'seller_city'      => $this->input->post('seller_city', true),
                'seller_pin_code'      => $this->input->post('seller_pin_code', true),
                'seller_address'      => $this->input->post('seller_address', true),
                'discount_percent' => $this->input->post('discount_percent', true),
            ];

            // Update password only if entered
            if (!empty($this->input->post('password'))) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $this->seller_model->update($id,$data);

            $this->session->set_flashdata('success','Seller Updated Successfully');
            redirect('seller');
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');

        $this->seller_model->delete($id);

        echo json_encode([
            'status' => 'success'
        ]);
    }

    public function change_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $update = $this->seller_model->update_status($id,$status);

        if($update){
            echo json_encode(['status'=>'success']);
        }else{
            echo json_encode(['status'=>'error']);
        }
    }
}
