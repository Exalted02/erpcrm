<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_alert extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('manage_alert/Manage_alert_model', 'manage_alert_model');
        $this->load->model('domain/Domain_model', 'domain_model');
    }

    public function index()
    {
        // Single record module: only one row ever exists in `manage_alert`.
        $existing = $this->manage_alert_model->get_first();

        if ($this->input->method() === 'post') {

            $payment_reminder  = $this->input->post('payment_reminder', true);
            $payment_schools   = $this->input->post('payment_reminder_schools');
            $popup_alert       = $this->input->post('popup_alert', true);
            $popup_schools     = $this->input->post('popup_alert_schools');

            $has_payment_side = (!empty($payment_reminder) && !empty($payment_schools));
            $has_popup_side   = (!empty($popup_alert) && !empty($popup_schools));

            if (!$has_payment_side && !$has_popup_side) {

                $this->session->set_flashdata('error', 'Please fill the message and select at least one school on either side.');
                redirect('manage_alert');

            } else {

                $data = [
                    'payment_reminder'         => $has_payment_side ? $payment_reminder : null,
                    'payment_reminder_schools' => $has_payment_side ? implode(',', (array) $payment_schools) : null,
                    'popup_alert'              => $has_popup_side ? $popup_alert : null,
                    'popup_alert_schools'      => $has_popup_side ? implode(',', (array) $popup_schools) : null
                ];

                if ($existing) {
                    // Update the single existing record
                    $this->manage_alert_model->update($existing->id, $data);
                } else {
                    // First time: insert the only record
                    $this->manage_alert_model->insert($data);
                }

                $this->session->set_flashdata('success', 'Alert Saved Successfully');
                redirect('manage_alert');
            }

        } else {

            $data['schools'] = $this->domain_model->get_all();
            $data['alert']   = $existing; // single row (or null if none saved yet)
            $data['page']    = 'manage_alert/index';
            $data['script']  = 'manage_alert/index_script';

            $this->load->view('layout/main', $data);
        }
    }
}
