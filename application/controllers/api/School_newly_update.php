<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School_newly_update extends MX_Controller  {
 
    public function __construct() {
        parent::__construct();
        $this->load->model('Api_model');
 
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *'); // VERY IMPORTANT
        header('Access-Control-Allow-Methods: GET');
    }
 
    public function get_school_newly_settings() {
		$data = $this->Api_model->get_school_newly_all();
		echo json_encode($data);
    }
}
