<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Operaciones extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('operaciones_model');
		$this->load->model('requests_model');
	}

	// CUANDO SE CARGA EL CONTROLADOR SE VA A LA PAGINA PRINCIPAL DE LA WEB
	public function index(){	
		$this->load->view('portada');
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

}