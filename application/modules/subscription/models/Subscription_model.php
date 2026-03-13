<?php
class Subscription_model extends CI_Model {

    function get_all()
    {
        return $this->db->get(SUBSCRIPTIONS)->result();
    }

    function get($id)
    {
        return $this->db->where('id',$id)->get(SUBSCRIPTIONS)->row();
    }

    function insert($data)
    {
        return $this->db->insert(SUBSCRIPTIONS,$data);
    }

    function update($id,$data)
    {
        return $this->db->where('id',$id)->update(SUBSCRIPTIONS,$data);
    }

    function delete($id)
    {
        return $this->db->where('id',$id)->delete(SUBSCRIPTIONS);
    }
	public function update_status($id,$status)
	{
		return $this->db
			->where('id',$id)
			->update(SUBSCRIPTIONS,['status'=>$status]);
	}

}