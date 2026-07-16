<?php
class Leads_model extends CI_Model {

    function get_all()
    {
        return $this->db->get(LEADS)->result();
    }
    function get_total_followup_leads()
    {
        return $this->db->select('COUNT(DISTINCT lead_id) AS total', false)
                    ->get(LEAD_FOLLOWUPS)
                    ->row()
                    ->total;
    }
    function total_converted_leads()
    {
        return $this->db->where('status',2)->get(LEADS)->result();
    }
    function total_cancel_leads()
    {
        return $this->db->where('status',3)->get(LEADS)->result();
    }
    function total_transfer_leads()
    {
        return $this->db->where('seller_id !=', 0)->where('coming_form !=', 1)->get(LEADS)->result();
    }
	
    function get_all_reseller_leads()
    {
        return $this->db->where('seller_id !=', 0)->get(LEADS)->result();
    }
    function get_total_followup_reseller_leads()
    {
        return $this->db->select('COUNT(DISTINCT lead_id) AS total', false)
                    ->where('followup_by !=', 1)
                    ->get(LEAD_FOLLOWUPS)
                    ->row()
                    ->total;
    }
    function total_converted_reseller_leads()
    {
        return $this->db->where('seller_id !=', 0)->where('status',2)->get(LEADS)->result();
    }
    function total_cancel_reseller_leads()
    {
        return $this->db->where('seller_id !=', 0)->where('status',3)->get(LEADS)->result();
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
	
	public function get_last_followup($lead_id)
	{
		return $this->db->where('lead_id', $lead_id)
						->order_by('id', 'DESC')
						->limit(1)
						->get(LEAD_FOLLOWUPS)
						->row_array();
	}
	
	function convert_school($id,$data)
    {
		$this->db->where('id',$id)->update(LEADS, ['status'=>2]);
        return $this->db->insert(CONVERT_SCHOOL,$data);
    }
    function get_converted_lead($id)
    {
        return $this->db->where('id',$id)->get(CONVERT_SCHOOL)->row();
    }
    function get_converted_leads()
    {
        return $this->db->where('status', 1)->get(CONVERT_SCHOOL)->result();
    }
    function update_converted_lead($id,$data)
    {
        return $this->db->where('id',$id)->update(CONVERT_SCHOOL,$data);
    }
    function delete_converted_school($id)
    {
        return $this->db->where('id',$id)->update(CONVERT_SCHOOL, ['status'=>0]);
    }
    function send_payment_request($id,$amount)
    {
        return $this->db->where('id',$id)->update(CONVERT_SCHOOL,['pay_amount'=>$amount]);
    }
}
