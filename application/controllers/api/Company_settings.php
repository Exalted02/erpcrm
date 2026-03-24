<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_settings extends MX_Controller  {
 
    public function __construct() {
        parent::__construct();
        $this->load->model('Api_model');
 
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *'); // VERY IMPORTANT
        header('Access-Control-Allow-Methods: GET');
    }
 
    public function get_company_settings() {
		$data = $this->Api_model->get_all();
		echo json_encode($data);
    }
}
