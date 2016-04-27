<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Europe/Madrid');		
		$this->load->model('users_model');
	}

	public function registrarse(){		
		$this->load->view('registro');
	}

	public function entrar(){		
		$this->load->view('entrar');
	}

	public function salir(){
		$session = array(
			'username' => '',				
			'is_logged_in' => FALSE,                        
			);
		$this -> session -> set_userdata($session); 
		redirect(base_url());
	}

	public function comprobar_login(){
		$username = $this -> input -> post('username');
		$password = hash('sha256', ($this -> input -> post('password'))) ;

		if($user = $this -> users_model -> validate_credentials($username, $password)){  //Si existe el usuario en la bbdd crea sessión y redirije al inicio			
			$this->crear_session($username);
			redirect(base_url());
		} else {

			$this->load->view('entrar', array('error'=>TRUE)); //Si el usuario no existe devuelve un error
		}

	}

	public function crear_session($username){

		$admin = 0;
		if ($admin = $this->users_model->is_admin($username)){
			$admin = 1;
		}

		
		$session = array(
			'username' => $username,				
			'is_logged_in' => TRUE,
			'admin' => 1
			);
		$this -> session -> set_userdata($session);
	}

	public function new_user(){ //Obtiene el form del registro y lo inserta en la bbdd como usuario nuevo
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$phone = $this->input->post('phone');
		$tarjeta = $this->input->post('tarjeta');
		$tarjeta_crc = $this->input->post('crc');	

		

		$user = array(                                			
			'username' => $username,
			'email' => $email,
			'password' => hash('sha256', $password),
			'phone' => $phone,
			'tarjeta' => hash('sha256', $tarjeta),
			'tarjeta_crc' => $tarjeta_crc
			);
		if($this->users_model->insert_user('users', $user)){                        
			$this->crear_session($username);
			redirect(base_url());
		} else {
			$this->load->view('registro', array('error'=>TRUE));
			
		}
	}

	public function cuenta(){
		$usuario_actual = $this->session->userdata('username');
		$data['usuario'] = $this->users_model->datos_usuario($usuario_actual);		
		$this->load->view('cuenta', $data);

	}

}