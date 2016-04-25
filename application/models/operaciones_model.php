<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Operaciones_model extends CI_Model {

	public function alta($username){
		$data = array(
			'active' => 1
			);

		$this->db->where('username', $username);
		$this->db->update('users', $data); 

		$this->insertar_alta($username);
	}

	public function insertar_alta($username){
		$this->db->select('user_id, phone');
		$this->db->where('username', $username);
		$user = $this->db->get('users')->row();


		$data = array('user_id' => $user->user_id,
			'phone' => $user->phone,
			'fecha' => date('Y-m-d H:i:s')
			) ;

		$this->db->insert('altas', $data); 

	}

	public function baja($username){
		$data = array(
			'active' => 0
			);

		$this->db->where('username', $username);
		$this->db->update('users', $data); 

		$this->insertar_baja($username);
	}

	public function insertar_baja($username){
		$this->db->select('user_id, phone');
		$this->db->where('username', $username);
		$user = $this->db->get('users')->row();


		$data = array('user_id' => $user->user_id,
			'phone' => $user->phone,
			'fecha' => date('Y-m-d H:i:s')
			) ;

		$this->db->insert('bajas', $data); 

	}

	public function cambiar_telefono($username, $phone){
		$data = array(
			'phone' => $phone
			);

		$this->db->where('username', $username);
		$this->db->update('users', $data); 

	}

	public function anadir_saldo($username, $saldo){

		$this->db->set('saldo', 'saldo + '.$saldo, FALSE);
		$this->db->where('username', $username);
		$this->db->update('users');
	}

	public function get_saldo($username){		

		$this->db->select('saldo');
		$this->db->where('username', $username);
		return $this->db->get('users')->row();
	}


}