<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Operaciones extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('operaciones_model');
	}

	public function alta(){
		$this->operaciones_model->alta($this->session->userdata('username'));
		redirect(base_url().'/users/cuenta');
	}

	public function baja(){
		$this->operaciones_model->baja($this->session->userdata('username'));
		redirect(base_url().'/users/cuenta');
	}

	public function cambiar_telefono(){
		$telefono = $this->input->post('telefono');
		$username = $this->session->userdata('username');

		$this->operaciones_model->cambiar_telefono($username, $telefono);
		redirect(base_url().'users/cuenta');

	}

	public function anadir_saldo(){
		$saldo = $this->input->post('saldo');
		$username = $this->session->userdata('username');

		$this->operaciones_model->anadir_saldo($username, $saldo);
		redirect(base_url().'users/cuenta');

	}
}