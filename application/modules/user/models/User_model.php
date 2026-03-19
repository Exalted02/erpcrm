<?php
class User_model extends CI_Model {
	
	public function getByEmail($email)
    {
        return $this->db
			->where('email',$email)
			->get(USERS)
			->row();
    }
	public function checkToken($token)
    {
        return $this->db
            ->where('verification_code', $token)
            ->get(USERS)
            ->row();
    }
	public function add($data)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update(USERS, $data);
			$id = $data['id'];
        } else {
            $this->db->insert(USERS, $data);
            $id        = $this->db->insert_id();
        }
        //======================Code End==============================

        $this->db->trans_complete(); # Completing transaction
        /*Optional*/

        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;

        } else {
            return $id;
        }
    }

}