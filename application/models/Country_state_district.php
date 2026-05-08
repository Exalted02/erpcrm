<?php
class Country_state_district extends CI_Model {

    public function get_all_state()
    {
        return $this->db->get(STATES)->result();
    }
    public function get_all_district($state_id)
    {
        return $this->db->where('state_id', $state_id)->order_by('district_name', 'ASC')->get(DISTRICTS)->result();
    }
    public function get_district_name($district_id)
    {
        return $this->db->where('id', $district_id)->get(DISTRICTS)->row();
    }

}