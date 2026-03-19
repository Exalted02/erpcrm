<?php

function send_dynamic_email($ci, $to, $type, $data = [])
{
    $ci->load->model('Email_model');

    $template = $ci->Email_model->get_template($type);

    if(!$template){
        return false;
    }

    $message = $template->template;

    // Replace dynamic variables
    foreach($data as $key => $value){
        $message = str_replace('['.strtoupper($key).']', $value, $message);
    }

    // Load email library
    $ci->load->library('email');

    $ci->email->from('exaltedsol02@email.com','Easy Skool ERP');
    $ci->email->to($to);
    $ci->email->subject($template->subject);
    $ci->email->message($message);

    return $ci->email->send();
}