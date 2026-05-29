<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('leads/Leads_model','leads_model');
        $this->load->model('domain/Domain_model','domain_model');
        $this->load->model('tickets/Tickets_model','tickets_model');
    }
	
    public function index()
	{		
		if($this->customlib->getLoginSessionData('user_role') == 1){
			redirect('leads');
		}
		
		$data['datas']['no_of_leads'] = count($this->leads_model->get_all());
		$data['datas']['register_school'] = count($this->domain_model->get_school_count(1));
		$data['datas']['disable_school'] = count($this->domain_model->get_school_count(0));
		$data['datas']['pending_tickets'] = count($this->tickets_model->get_ticket_count(1));
		$data['datas']['open_tickets'] = count($this->tickets_model->get_ticket_count(2));
		$data['datas']['close_tickets'] = count($this->tickets_model->get_ticket_count(3));
		// print_r($data['datas']['no_of_leads']);exit;		
		
        $data['page'] = 'dashboard/dashboard';
        $data['script'] = 'dashboard/index_script';

        $this->load->view('layout/main',$data);

    }
}
