<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_alert_model extends CI_Model {

    // This module only ever holds a single record.
    function get_first()
    {
        return $this->db->order_by('id', 'asc')->limit(1)->get(MANAGE_ALERT)->row();
    }

    function get($id)
    {
        return $this->db->where('id', $id)->get(MANAGE_ALERT)->row();
    }

    function insert($data)
    {
        return $this->db->insert(MANAGE_ALERT, $data);
    }

    function update($id, $data)
    {
        return $this->db->where('id', $id)->update(MANAGE_ALERT, $data);
    }
}
