<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alert extends MX_Controller  {
 
    public function __construct() {
        parent::__construct();
        $this->load->model('Api_model');
         $this->load->model('manage_alert/Manage_alert_model', 'manage_alert_model');
 
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *'); // VERY IMPORTANT
        header('Access-Control-Allow-Methods: GET');
    }
 
    public function get_alert($api_key)
	{
		$domain = $this->Api_model->get_domain_data($api_key);
	 
		// manage_alert is a single-record table, so just fetch that one row.
		$alert = $this->db->get(MANAGE_ALERT)->row_array();
	 
		$payment_reminder = null;
		$popup_alert       = null;
		$popup_alert_image   = null;
	 
		if (!empty($alert)) {
	 
			// Check if this school's id is inside the comma separated list
			if (!empty($alert['payment_reminder_schools'])) {
				$payment_ids = explode(',', $alert['payment_reminder_schools']);
				if (in_array($domain->id, $payment_ids)) {
					$payment_reminder = $alert['payment_reminder'];
				}
			}
	 
			if (!empty($alert['popup_alert_schools'])) {
				$popup_ids = explode(',', $alert['popup_alert_schools']);
				if (in_array($domain->id, $popup_ids)) {
					$popup_alert = $alert['popup_alert'];
					if (!empty($alert['popup_alert_image'])) {
						$popup_alert_image = base_url('uploads/manage_alert/' . $alert['popup_alert_image']);
					}
				}
			}
		}
	 
		echo json_encode([
			'status' => true,
			'data'   => [
				'payment_reminder' => $payment_reminder,
				'popup_alert'      => $popup_alert,
				'popup_alert_image'  => $popup_alert_image,
			]
		]);
	}
}
