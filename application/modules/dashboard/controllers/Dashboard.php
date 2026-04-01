<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function index()
	{		
		if($this->customlib->getSessionUserRole() == 1){
			redirect('leads');
		}
		
        $data['page'] = 'dashboard/dashboard';
        $data['script'] = 'dashboard/index_script';

        $this->load->view('layout/main',$data);

    }
}
