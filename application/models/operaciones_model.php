<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Operaciones_model extends CI_Model {

	// CAMBIA EL CAMPO ALTA DE UN USUARIO DE LA BASE DE DATOS
	public function alta($username){
		$data = array(
			'active' => 1
			);

		$this->db->where('username', $username);
		$this->db->update('users', $data); 

		$this->insertar_alta($username);
	}

	// CUANDO UN USUARIO SE DA DE ALTA EN EL SERVICIO SE REGISTRA EN LA BASE DE DATOS.
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

	// SE CAMBIA EL CAMPO DE BAJA DE LA BSE DE DATOS
	public function baja($username){
		$data = array(
			'active' => 0
			);

		$this->db->where('username', $username);
		$this->db->update('users', $data); 

		$this->insertar_baja($username);
	}

	// CUANDO UN USUARIO SE DA DE BAJA EN LA WEB, SE INSERTA EN LA BASE DE DATOS
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

	// SE HACE UN UPDATE DEL CAMPO PHONE DEL USERNAME, CON LOS CAMPOS PASADOS POR PARÁMETRO
	public function cambiar_telefono($username, $phone){
		$data = array(
			'phone' => $phone
			);

		$this->db->where('username', $username);
		$this->db->update('users', $data); 

	}

	public function get_username($user_id){
		$this->db->select('username');
		$this->db->where('user_id', $user_id);
		return $this->db->get('users')->row()->username;
	}


}