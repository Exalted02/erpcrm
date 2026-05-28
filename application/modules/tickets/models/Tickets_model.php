<?php
class Tickets_model extends CI_Model {
	function get_ticket_followup($ticket_id)
    {
        return $this->db->where('ticket_id',$ticket_id)->get(TICKET_FOLLOWUPS)->result();
    }
}
