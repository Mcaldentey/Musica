<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Requests_model extends CI_Model {

    public function insert_user($table, $data){ //insert a table on the database

    	return $this->db->insert($table, $data);
    }

    public function validate_credentials($username, $password){
    	$this ->db->where('username', $username);
    	$this ->db->where('password', $password);
    	return $this->db->get('users')->row();
    }

    public function datos_usuario($username){
    	$this->db->select('saldo, phone, active');
    	$this->db->where('username', $username);
        return $this->db->get('users')->row();
    }
}