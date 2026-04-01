<?php
class Leads_model extends CI_Model {

    function get_all()
    {
        return $this->db->get(LEADS)->result();
    }

    function get($id)
    {
        return $this->db->where('id',$id)->get(LEADS)->row();
    }

    function insert($data)
    {
        return $this->db->insert(LEADS,$data);
    }

    function update($id,$data)
    {
        return $this->db->where('id',$id)->update(LEADS,$data);
    }

    function delete($id)
    {
		$this->db->where('lead_id',$id)->delete(LEAD_FOLLOWUPS);
        return $this->db->where('id',$id)->delete(LEADS);
    }
	public function update_status($id,$status)
	{
		return $this->db
			->where('id',$id)
			->update(LEADS,['status'=>$status]);
	}
	
	
    function get_lead_followup($lead_id)
    {
        return $this->db->where('lead_id',$lead_id)->get(LEAD_FOLLOWUPS)->result();
    }
    function lead_followup_insert($data, $id = null)
    {
		if($id){
			return $this->db->where('id', $id)->update(LEAD_FOLLOWUPS, $data);
		}else{
			return $this->db->insert(LEAD_FOLLOWUPS, $data);
		}
    }
	function lead_followup_delete($id)
    {
        return $this->db->where('id',$id)->delete(LEAD_FOLLOWUPS);
    }
}
