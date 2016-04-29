<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Europe/Madrid');		
		$this->load->model('users_model');		
	}

	// CONTROLADOR QUE REALIZA LAS OPERACIONES DE LOS USUARIOS DE LA WEB

	// CARGA EL VIEW DE REGISTRO
	public function registrarse(){		
		$this->load->view('registro');
	}

	// CARGA EL VIEW DE ENTRAR A TU CUENTA
	public function entrar(){		
		$this->load->view('entrar');
	}

	// CIERRA LA SESIÓN
	public function salir(){
		$session = array(
			'username' => '',				
			'is_logged_in' => FALSE,
			'admin' => 0
			);
		$this -> session -> set_userdata($session); 
		redirect(base_url());
	}

	// COMPRUEBA QUE EL USUARIO INTRODUCIDO ESTÉ EN LA BASE DE DATOS
	public function comprobar_login(){
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[20]');		
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[20]');

		if ($this->form_validation->run() == TRUE) {
			
			$username = $this -> input -> post('username');
			$password = hash('sha256', ($this -> input -> post('password'))) ;

			if($user = $this -> users_model -> validate_credentials($username, $password)){  // SI EXISTE EL USUARIO SE CREA LA SESIÓN
				$this->crear_session($username);
				redirect(base_url());
			} else {
				$this->load->view('entrar', array('error' => TRUE));	
			}

		} else {
			$this->load->view('entrar');
		}

	}

	// CREA LA SESIÓN DEL USUARIO QUE SE HA LOGGEADO
	public function crear_session($username){

		// SI EL USUARIO ES UN ADMINISTRADOR LE PONE EL CAMPO A 1
		$admin = 0;
		if ($admin = $this->users_model->is_admin($username)){
			$admin = 1;
		}

		$session = array(
			'username' => $username,				
			'is_logged_in' => TRUE,
			'admin' => $admin
			);
		$this -> session -> set_userdata($session);
	}

	// OBTIENE EL USUARIO INTRODUCIDO DEL FORMULARIO Y LO INTRODUCE EN LA BBDD
	public function new_user(){


		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[20]');
		$this->form_validation->set_rules('email', 'Email', 'required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('phone', 'phone', 'required|min_length[9]|max_length[12]');
		
		if ($this->form_validation->run() == TRUE)
		{
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
				);
			if($this->users_model->insert_user('users', $user)){                        
				$this->crear_session($username);
				redirect(base_url());
			}

		}
		else
		{
			$this->load->view('registro');
		}
	}

	// CARGA LA VISTA DE LA CUENTA PASANDOLE LOS DATOS DEL USUARIO QUE ESTA LOGUEADO
	public function cuenta(){
		
		$usuario_actual = $this->session->userdata('username');
		$data['usuario'] = $this->users_model->datos_usuario($usuario_actual);
		$this->load->view('cuenta', $data);

	}

	//CARGA LA VISTA DE LA CUENTA PASANDOLE QUE HA HABIDO UN ERROR EN EL ALTA
	public function cuenta_error(){
		$usuario_actual = $this->session->userdata('username');
		$data['usuario'] = $this->users_model->datos_usuario($usuario_actual);
		$data['error_alta'] = array('error' => TRUE);
		$this->load->view('cuenta', $data);
	}

}