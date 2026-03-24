<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function index(){

        $data['page'] = 'dashboard/dashboard';
        $data['script'] = 'dashboard/index_script';

        $this->load->view('layout/main',$data);

    }
}
