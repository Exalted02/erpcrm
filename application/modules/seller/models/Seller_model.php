<?php
class Seller_model extends CI_Model {

    function get_all()
    {
        return $this->db->where('user_role',1)->get(USERS)->result();
    }

    function get($id)
    {
        return $this->db->where('id',$id)->get(USERS)->row();
    }

    function insert($data)
    {
        return $this->db->insert(USERS,$data);
    }

    function update($id,$data)
    {
        return $this->db->where('id',$id)->update(USERS,$data);
    }

    function delete($id)
    {
        return $this->db->where('id',$id)->delete(USERS);
    }
	public function update_status($id,$status)
	{
		return $this->db
			->where('id',$id)
			->update(USERS,['status'=>$status]);
	}

}