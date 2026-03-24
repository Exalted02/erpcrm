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
		$arr = $this->Api_model->get_all();
		$arr['logo'] = isset($arr['logo']) ? $arr['logo'] : 'default-logo.png';
		$arr['website_url'] = isset($arr['website_url']) ? $arr['website_url'] : 'https://easyskool.in/';
		$arr['school_name'] = isset($arr['school_name']) ? $arr['school_name'] : 'Easy Skool ERP';
		$data['data'] = $arr;
		echo json_encode($data);
    }
}
