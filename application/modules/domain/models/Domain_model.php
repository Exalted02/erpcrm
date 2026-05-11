<?php
class Domain_model extends CI_Model {

    function get_all()
    {
        return $this->db->get(API_DOMAINS)->result();
    }

    function get($id)
    {
        return $this->db->where('id',$id)->get(API_DOMAINS)->row();
    }

    function insert($data)
    {
        return $this->db->insert(API_DOMAINS,$data);
    }

    function update($id,$data)
    {
        return $this->db->where('id',$id)->update(API_DOMAINS,$data);
    }

    function delete($id)
    {
        return $this->db->where('id',$id)->delete(API_DOMAINS);
    }
	public function update_status($id,$status)
	{
		return $this->db
			->where('id',$id)
			->update(API_DOMAINS,['status'=>$status]);
	}
	public function get_last_code($currentYear)
	{
		return $this->db
			->select('code_number')
			->from(API_DOMAINS)
			->where('code_year', $currentYear)
			->order_by('code_number', 'DESC')
			->limit(1)
			->get()
			->row();
	}

}