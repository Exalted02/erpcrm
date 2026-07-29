<?php
class Services_model extends CI_Model {

    function get_all()
    {
        return $this->db->get(SERVICES)->result();
    }
    function get_all_active()
    {
        return $this->db->where('status',1)->get(SERVICES)->result();
    }

    function get($id)
    {
        return $this->db->where('id',$id)->get(SERVICES)->row();
    }

    function get_by_ids($ids)
    {
        $ids = array_filter((array) $ids);
        if(empty($ids)){
            return [];
        }
        return $this->db->where_in('id',$ids)->get(SERVICES)->result();
    }

    function insert($data)
    {
        return $this->db->insert(SERVICES,$data);
    }

    function update($id,$data)
    {
        return $this->db->where('id',$id)->update(SERVICES,$data);
    }

    function delete($id)
    {
        return $this->db->where('id',$id)->delete(SERVICES);
    }
	public function update_status($id,$status)
	{
		return $this->db
			->where('id',$id)
			->update(SERVICES,['status'=>$status]);
	}

}
