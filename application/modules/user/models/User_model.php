<?php
class User_model extends CI_Model {

    public function login($email){

        return $this->db
        ->where('email',$email)
        ->where('status',1)
        ->get(USERS)
        ->row();

    }

}