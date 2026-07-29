<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptions extends MX_Controller  {
 
    public function __construct() {
        parent::__construct();
        $this->load->model('Api_model');
        $this->load->model('Country_state_district');
        $this->load->model('subscription/Subscription_model','subscription_model');
		$this->load->model('services/Services_model', 'services_model');
 
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *'); // VERY IMPORTANT
        header('Access-Control-Allow-Methods: GET');
    }
 
    public function get_subscription_list($api_key) {
		$subscription = $this->subscription_model->get_all_active();
		$data['data'] = $subscription;
		echo json_encode($data);
    }
    public function get_service_list($api_key) {
		$services = $this->services_model->get_all_active();
		$data['data'] = $services;
		echo json_encode($data);
    }
}
