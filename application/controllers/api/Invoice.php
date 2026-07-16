<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MX_Controller  {
 
    public function __construct() {
        parent::__construct();
        $this->load->model('Api_model');
		$this->load->model('invoice/Invoice_model', 'invoice_model');
 
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *'); // VERY IMPORTANT
        header('Access-Control-Allow-Methods: GET');
    }
 
    public function get_invoice_list($id) {
		$invoice = $this->Api_model->get_invoice_list($id);
		$data['data'] = $invoice;
		echo json_encode($data);
    }
	public function print_invoice($id)
    {
        $invoice = $this->invoice_model->get_with_domain($id);

        $data['invoice']  = $invoice;
        $data['company']  = $this->invoice_model->get_company_settings();
        // Return HTML fragment (no layout wrapper) for embedding in modal
        $html = $this->load->view('invoice/print_invoice', $data);
		
		echo $html;
    }
}
