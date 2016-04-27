<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model {

    // INSERTA UN USUARIO EN LA BASE DE DATOS
    public function insert_user($table, $data){ 
    	return $this->db->insert($table, $data);
    }

    // COMPRUEBA QUE UN USUARIO EXISTA EN LA BASE DE DATOS
    public function validate_credentials($username, $password){
    	$this ->db->where('username', $username);
    	$this ->db->where('password', $password);
    	return $this->db->get('users')->row();
    }

    // DEVUELE EL SALDO, TELEFONO Y SI ESTÁ DE ALTA DE UN USUARIO
    public function datos_usuario($username){
    	$this->db->select('saldo, phone, active');
    	$this->db->where('username', $username);
        return $this->db->get('users')->row();
    }
    
    // DEVUELVE 1 SI EL USUARIO ES ADMIN, 0 EN CASO CONTRARIO
    public function is_admin($username){

        $this->db->where('username', $username);
        $this->db->where('admin', 1);
        return $this->db->get('users')->row();
    }
}