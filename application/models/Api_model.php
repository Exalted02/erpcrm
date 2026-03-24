<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {
	
	/*public function __construct() {
        parent::__construct();
        //$this->load->database();
    }*/
    public function get_all() {
        return $this->db->get(COMPANY_SETTINGS)->result_array();
    }
}
