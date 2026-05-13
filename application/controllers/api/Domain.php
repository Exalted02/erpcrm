<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Domain extends MX_Controller  {
 
    public function __construct() {
        parent::__construct();
        $this->load->model('Api_model');
        $this->load->model('Country_state_district');
 
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *'); // VERY IMPORTANT
        header('Access-Control-Allow-Methods: GET');
    }
 
    public function get_domain_data($api_key) {
		$domain = $this->Api_model->get_domain_data($api_key);
		$state = $this->Country_state_district->get_state_name($domain->school_state);
		$district = $this->Country_state_district->get_district_name($domain->school_district);
		$domain->school_state = $state->state_name;
		$domain->school_district = $district->district_name;
		$data['data'] = $domain;
		echo json_encode($data);
    }
}
