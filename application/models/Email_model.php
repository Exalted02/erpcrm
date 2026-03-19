<?php
class Email_model extends CI_Model {

    public function get_template($type)
    {
        return $this->db
            ->where('type', $type)
            ->get(EMAIL_TEMPLATE)
            ->row();
    }

}