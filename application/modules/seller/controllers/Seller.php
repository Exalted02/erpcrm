<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('seller/Seller_model','seller_model');
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
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email|is_unique[users.email]'
        );
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE)
        {
            $data['page'] = 'seller/form';
            $this->load->view('layout/main',$data);
        }
        else
        {
            $data = [
                'name'       => $this->input->post('name', true),
                'email'      => $this->input->post('email', true),
                'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
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

        $this->form_validation->set_rules('password', 'Password', 'min_length[6]');

        if ($this->form_validation->run() == FALSE)
        {
            $data['seller'] = $seller;
            $data['page'] = 'seller/form';
            $this->load->view('layout/main',$data);
        }
        else
        {
            $data = [
                'name'  => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
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
