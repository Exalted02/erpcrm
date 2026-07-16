<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('subscription/Subscription_model','subscription_model');
        $this->load->model('leads/Leads_model','leads_model');
        $this->load->model('domain/Domain_model','domain_model');
        $this->load->model('tickets/Tickets_model','tickets_model');
        $this->load->model('invoice/Invoice_model','invoice_model');
    }
	
    public function index()
	{		
		if($this->customlib->getLoginSessionData('user_role') == 1){
			redirect('leads');
		}
		
		$data['datas']['no_of_plans'] = count($this->subscription_model->get_all());
		
		$data['datas']['no_of_leads'] = count($this->leads_model->get_all());
		$data['datas']['get_total_followup_leads'] = $this->leads_model->get_total_followup_leads();
		$data['datas']['total_converted_leads'] = count($this->leads_model->total_converted_leads());
		$data['datas']['total_cancel_leads'] = count($this->leads_model->total_cancel_leads());
		$data['datas']['total_transfer_leads'] = count($this->leads_model->total_transfer_leads());
		
		$data['datas']['no_of_reseller_leads'] = count($this->leads_model->get_all_reseller_leads());
		$data['datas']['get_total_followup_reseller_leads'] = $this->leads_model->get_total_followup_reseller_leads();
		$data['datas']['total_converted_reseller_leads'] = count($this->leads_model->total_converted_reseller_leads());
		$data['datas']['total_cancel_reseller_leads'] = count($this->leads_model->total_cancel_reseller_leads());
		
		$data['datas']['register_school'] = count($this->domain_model->get_school_count(1));
		$data['datas']['disable_school'] = count($this->domain_model->get_school_count(0));
		$data['datas']['pending_tickets'] = count($this->tickets_model->get_ticket_count(1));
		$data['datas']['open_tickets'] = count($this->tickets_model->get_ticket_count(2));
		$data['datas']['close_tickets'] = count($this->tickets_model->get_ticket_count(3));
		
		$data['datas']['invoice_summary'] = $this->invoice_model->get_invoice_dashboard();
		$data['datas']['invoice_monthly_summary'] = $this->invoice_model->get_total_paid_this_month();
		// print_r($data['datas']['no_of_leads']);exit;		
		
        $data['page'] = 'dashboard/dashboard';
        $data['script'] = 'dashboard/index_script';

        $this->load->view('layout/main',$data);

    }
}
