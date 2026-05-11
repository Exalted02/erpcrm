<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends MX_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Country_state_district');
    }
	
	public function getDistricts()
	{
		$state_id = $this->input->post('state_id');

		$districts = $this->Country_state_district->get_all_district($state_id);

		echo '<option value="">Please select</option>';
		foreach($districts as $district){

			echo '<option value="'.$district->id.'">'
					.$district->district_name.
				 '</option>';
		}
	}
}
