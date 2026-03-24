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
		$data['logo'] = isset($data['logo']) ? $data['logo'] : 'default-logo.png';
		$data['website_url'] = isset($data['website_url']) ? $data['website_url'] : 'https://easyskool.in/';
		echo json_encode($data);
    }
}
