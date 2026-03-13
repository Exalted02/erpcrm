<?php
class Users extends MY_Controller {

    public function index(){

        $data['users'] = $this->db->get(USERS)->result();

        $data['page'] = 'users';

        $this->load->view('layout/main',$data);

    }

}