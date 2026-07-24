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
            $remove_image      = $this->input->post('remove_popup_alert_image');

            $has_payment_side = (!empty($payment_reminder) && !empty($payment_schools));
            $has_popup_side   = (!empty($popup_alert) && !empty($popup_schools));

            if (!$has_payment_side && !$has_popup_side) {

                $this->session->set_flashdata('error', 'Please fill the message and select at least one school on either side.');
                redirect('manage_alert');
                return;
            }

            // Start with whatever image filename already exists in DB (if any)
            $popup_alert_image = (!empty($existing->popup_alert_image)) ? $existing->popup_alert_image : null;

            // Only the popup-alert side can have an image, so if that side is empty, drop any existing image too.
            if (!$has_popup_side) {

                if (!empty($popup_alert_image)) {
                    $this->_delete_alert_image($popup_alert_image);
                }
                $popup_alert_image = null;

            } else {

                // User explicitly ticked "remove current image" and did not upload a new one
                if ($remove_image && empty($_FILES['popup_alert_image']['name'])) {

                    if (!empty($popup_alert_image)) {
                        $this->_delete_alert_image($popup_alert_image);
                    }
                    $popup_alert_image = null;
                }

                // A new file was uploaded — replace the old one
                if (!empty($_FILES['popup_alert_image']['name'])) {

                    $upload_dir = './uploads/manage_alert/';

                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }

                    $ext = pathinfo($_FILES['popup_alert_image']['name'], PATHINFO_EXTENSION);

                    $config['upload_path']   = $upload_dir;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
                    $config['file_name']     = 'popup_alert_' . time() . '.' . $ext;
                    $config['max_size']      = 2048; // KB

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('popup_alert_image')) {

                        $upload_data = $this->upload->data();

                        // Delete the previous image only after the new one is uploaded successfully
                        if (!empty($popup_alert_image)) {
                            $this->_delete_alert_image($popup_alert_image);
                        }

                        $popup_alert_image = $upload_data['file_name'];

                    } else {

                        $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                        redirect('manage_alert');
                        return;
                    }
                }
            }

            $data = [
                'payment_reminder'         => $has_payment_side ? $payment_reminder : null,
                'payment_reminder_schools' => $has_payment_side ? implode(',', (array) $payment_schools) : null,
                'popup_alert'              => $has_popup_side ? $popup_alert : null,
                'popup_alert_schools'      => $has_popup_side ? implode(',', (array) $popup_schools) : null,
                'popup_alert_image'        => $popup_alert_image
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

        } else {

            $data['schools'] = $this->domain_model->get_all();
            $data['alert']   = $existing; // single row (or null if none saved yet)
            $data['page']    = 'manage_alert/index';
            $data['script']  = 'manage_alert/index_script';

            $this->load->view('layout/main', $data);
        }
    }

    private function _delete_alert_image($filename)
    {
        $path = './uploads/manage_alert/' . $filename;

        if (!empty($filename) && file_exists($path)) {
            unlink($path);
        }
    }
}
