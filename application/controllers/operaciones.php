<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Operaciones extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('operaciones_model');
	}

	// CUANDO SE CARGA EL CONTROLADOR SE VA A LA PAGINA PRINCIPAL DE LA WEB
	public function index(){	
		$this->load->view('portada');
	}

	//CONTROLADOR PARA LAS OPERACIONES DE LAS CUENTAS DE LOS USUARIOS DE LA WEB

	//PARA DAR DE ALTA A UN USUARIO
	public function alta(){
		$this->operaciones_model->alta($this->session->userdata('username'));
		redirect(base_url().'/users/cuenta');
	}

	//PARA DAR DE BAJA A UN USUARIO
	public function baja(){
		$this->operaciones_model->baja($this->session->userdata('username'));
		redirect(base_url().'/users/cuenta');
	}

	//PARA CAMBIAR EL TELÉFONO A UN USUARIO
	public function cambiar_telefono(){
		
		$this->form_validation->set_rules('telefono', 'telefono cambio', 'required|min_length[9]|max_length[12]');

		if ($this->form_validation->run() == TRUE) {

			$telefono = $this->input->post('telefono');
			$username = $this->session->userdata('username');

			$this->operaciones_model->cambiar_telefono($username, $telefono);
			redirect(base_url().'users/cuenta');

		} else {
			redirect(base_url().'users/cuenta');
		}
	}

	//AÑADE SALDO A UNA CUENTA SEGÚN EL FORMULARIO
	public function anadir_saldo(){

		$this->form_validation->set_rules('saldo', 'saldo cambio', 'required|numeric');

		if ($this->form_validation->run() == TRUE) {
	
			$saldo = $this->input->post('saldo');

			if (! ((is_int($saldo) || ctype_digit($saldo)) && (int)$saldo > 0 )) {
				redirect(base_url().'users/cuenta');
			 }


			$username = $this->session->userdata('username');

			$this->operaciones_model->anadir_saldo($username, $saldo);
			redirect(base_url().'users/cuenta');

		} else {
			redirect(base_url().'users/cuenta');
		}

	}

}