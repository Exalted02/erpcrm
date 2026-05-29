<?php
class Tickets_model extends CI_Model {
	function get_ticket_by_id($ticket_id)
    {
        return $this->db->where('id',$ticket_id)->get(TICKETS)->row();
    }
	function add_ticket($data)
    {
		if($data['id']){			
			return $this->db->where('id', $data['id'])->update(TICKETS, $data);
		}else{
			return $this->db->insert(TICKETS, $data);
		}
    }
	function get_ticket_followup($ticket_id)
    {
        return $this->db->where('ticket_id',$ticket_id)->get(TICKET_FOLLOWUPS)->result();
    }
	function ticket_followup_insert($data, $id = null)
    {
		if($id){
			$data['updated_at'] = date('Y-m-d H:i:s');
			return $this->db->where('id', $id)->update(TICKET_FOLLOWUPS, $data);
		}else{
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['updated_at'] = date('Y-m-d H:i:s');
			return $this->db->insert(TICKET_FOLLOWUPS, $data);
		}
    }
	function ticket_followup_delete($id)
    {
        return $this->db->where('id',$id)->delete(TICKET_FOLLOWUPS);
    }
}
