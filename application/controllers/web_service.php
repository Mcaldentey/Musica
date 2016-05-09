<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Web_service extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('requests_model');
		$this->load->model('operaciones_model');
		$this->load->library('xml_post');
	}

	//ENVIA UN SMS CON TEXTO A TODOS LOS USUARIOS ACTIVOS DE LA BBDD
	public function web_service_call() {
		
		$users = $this->requests_model->select_active();
		
		// PARA SABER SI VIENE DE LA TAREA O DEL ENVÍO DE SMS
		if (null !== $this->input->post('texto')) {
			$texto = $this->input->post('texto');	
		} else {
			$texto = 'Cobro REALIZADO';
		}

		//POR CADA USUARIO
		foreach ($users as $user) {

			$transaccion = $this->requests_model->get_transaccion();

			$phone = $user->phone;
			$user_id = $user->user_id;

			//COGE LA RESPUESTA DE LA PETICION DE TOKEN
			$rsp_token = $this->get_rsp_valid_token($transaccion);
			$token = $rsp_token->token;

			// INSERTA LA OPERACION EN LA BBDD DE REQUESTS Y TOKENS
			$this->requests_model->insert_token(
				$transaccion,
				$user_id,
				$rsp_token
				);


			$transaccion ++;
			
			//COGE LA RESPUESTA DE LA PETICIÓN DE COBRO
			$rsp_cobro = $this->xml_post->get_rsp_cobro($transaccion, $phone, $token);

			// INSERTA LA OPERACION EN LA BBDD DE REQUESTS Y COBROS
			$this->requests_model->insert_cobro(
				$transaccion,
				$phone,			
				$user_id,
				$rsp_token->token,
				$rsp_cobro
				);


			// SI NO TIENE SALDO, SE LE DA DE BAJA Y SE INSERTA LA BAJA EN LA BBDD
			if (! strcmp($rsp_cobro->statusCode, 'NO_FUNDS')) {
				$this->operaciones_model->baja($this->operaciones_model->get_username($user_id));
				$this->operaciones_model->insertar_baja($this->operaciones_model->get_username($user_id));

			//SI SE HA REALIZADO EL COBRO CORRECTAMENTE, SE ENVIA EL SMS
			} else if (! strcmp($rsp_cobro->statusCode, 'SUCCESS')) {
				
				$transaccion ++;
				
				// CREA EL XML DEL SMS Y LO ENVÍA AL WEB SERVICE.
				$rsp_sms = $this->xml_post->get_rsp_sms($texto, $phone, $transaccion);

				// SE INSERTA EN LA BBDD CON LOS CAMPOS CORRECTOS
				$this->requests_model->insert_sms(
					$transaccion,
					$user_id,				
					$texto,
					$phone,
					$rsp_sms
					);

				// SI SE COBRA CORRECTAMENTE SE INSERTA EL COBRO EN LA BBDD COBRO
				$this->requests_model->insert_cobro_user($user_id);
			}
		}
		$this->requests_model->update_transaccion($transaccion);
		// EN EL CASO DE QUE VENGA DEL ENVÍO DE SMS SE REDIRIJE A LA PAGINA PRINCIPAL
		if (strcmp($texto, 'Cobro REALIZADO')){
			redirect(base_url());	
		}
		
	}

	public function get_rsp_valid_token($transaccion){

		// OBTIENE EL TOKEN DEL XML DEVOLVIDO
		$rsp_token = $this->xml_post->get_rsp_token($transaccion);
		// CONTROLAMOS SI EL TOKEN ES CORRECTO
		while (empty($rsp_token->token)) {

			//SI NO ES CORRECTO SE VUELVE A PEDIR OTRO HASTA QUE VAYA BIEN.
			$transaccion = $this->requests_model->get_transaccion();			
			$rsp_token = $this->xml_post->get_rsp_token($transaccion);			
		}
		return $rsp_token;
	}

	

	//PARA DAR DE ALTA A UN USUARIO
	public function alta_usuario(){

		$transaccion = $this->requests_model->get_transaccion();
		$user = $this->requests_model->select_active_now($this->session->userdata('username'));

		$texto = "Te has dado de alta satisfactoriamente";
		$phone = $user->phone;
		$user_id = $user->user_id;

		$rsp_token = $this->get_rsp_valid_token($transaccion);

		$this->requests_model->insert_token(
			$transaccion,
			$user_id,
			$rsp_token
			);

		$transaccion = $this->requests_model->get_transaccion();

		$rsp_cobro = $this->xml_post->get_rsp_cobro($transaccion, $phone, $rsp_token->token);

		// INSERTA LA OPERACION EN LA BBDD DE COBROS
		$this->requests_model->insert_cobro(
			$transaccion,
			$phone,			
			$user_id,
			$rsp_token->token,
			$rsp_cobro
			);

		if (! strcmp($rsp_cobro->statusCode, 'NO_FUNDS')) {
			redirect(base_url().'users/cuenta_error_founds');


		} else if (! strcmp($rsp_cobro->statusCode, 'SUCCESS')) {
				// CREA EL XML DEL SMS Y LO ENVÍA AL WEB SERVICE.
			$transaccion = $this->requests_model->get_transaccion();

				//SI SE HA REALIZADO EL COBRO CORRECTAMENTE, SE ENVIA EL SMS

			$transaccion = $this->requests_model->get_transaccion();
			$rsp_sms = $this->xml_post->get_rsp_sms($texto, $phone, $transaccion);

				// SE INSERTA EN LA BBDD CON LOS CAMPOS CORRECTOS
			$this->requests_model->insert_sms(
				$transaccion,
				$user_id,				
				$texto,
				$phone,
				$rsp_sms
				);

			$this->requests_model->insert_cobro_user($user_id);
			$this->operaciones_model->alta($this->session->userdata('username'));
			redirect(base_url().'users/cuenta');	
		}
		redirect(base_url().'users/cuenta_error');
	}

}
