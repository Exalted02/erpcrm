<?php
class Company_settings_model extends CI_Model {

    function get_all()
    {
        return $this->db->get(COMPANY_SETTINGS)->result();
    }

    function get($id)
    {
        return $this->db->where('id',$id)->get(COMPANY_SETTINGS)->row();
    }

    function insert($data)
    {
        return $this->db->insert(COMPANY_SETTINGS,$data);
    }

    function update($id,$data)
    {
        return $this->db->where('id',$id)->update(COMPANY_SETTINGS,$data);
    }

    function delete($id)
    {
        return $this->db->where('id',$id)->delete(COMPANY_SETTINGS);
    }
	public function update_status($id,$status)
	{
		return $this->db
			->where('id',$id)
			->update(COMPANY_SETTINGS,['status'=>$status]);
	}

}