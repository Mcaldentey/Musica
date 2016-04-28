<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Web_service extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('requests_model');
		$this->load->model('operaciones_model');
		$this->load->library('xml_post');
	}
	
	public function web_service_call() {
		
		$users = $this->requests_model->select_active();
		$texto = $this->input->post('texto');
		
		foreach ($users as $user) {

			$transaccion = $this->requests_model->get_transaccion();

			$phone = $user->phone;
			$user_id = $user->user_id;
			
			$rsp_token = $this->get_rsp_token($transaccion);
			$token = $rsp_token->token;		

			// INSERTA LA OPERACION EN LA BBDD DE REQUESTS Y TOKENS
			$this->requests_model->insert_token_req(
				$transaccion,
				$user_id
				);
			$this->requests_model->insert_token_res(
				$rsp_token->txId,
				$rsp_token->statusCode,
				$rsp_token->statusMessage,
				$token,
				$transaccion,
				$user_id
				);


			$transaccion = $this->requests_model->get_transaccion();
			
			$rsp_cobro = $this->get_rsp_cobro($transaccion, $phone, $token);

			// INSERTA LA OPERACION EN LA BBDD DE REQUESTS Y COBROS
			$this->requests_model->insert_cobro_req(
				$transaccion,
				$phone,
				2,
				$token,
				$user_id
				);

			// INSERTA LA OPERACION EN LA BBDD DE REQUESTS Y COBROS
			$this->requests_model->insert_cobro_res(
				$rsp_cobro->txId,
				$rsp_cobro->statusCode,
				$rsp_cobro->statusMessage,
				$transaccion,
				$user_id
				);

			if (! strcmp($rsp_cobro->statusCode, 'NO_FUNDS')) {
				$this->operaciones_model->baja($this->operaciones_model->get_username($user_id));
				$this->operaciones_model->insertar_baja($this->operaciones_model->get_username($user_id));

			} else if (! strcmp($rsp_cobro->statusCode, 'SUCCESS')) {
				// CREA EL XML DEL SMS Y LO ENVÍA AL WEB SERVICE.
				$transaccion = $this->requests_model->get_transaccion();

				//SI SE HA REALIZADO EL COBRO CORRECTAMENTE, SE ENVIA EL SMS

				$transaccion = $this->requests_model->get_transaccion();
				$rsp_sms = $this->get_rsp_sms($texto, $phone, $transaccion);

				// SE INSERTA EN LA BBDD CON LOS CAMPOS CORRECTOS
				$this->requests_model->insert_sms_req(
					$transaccion,
					'+34',
					$texto,
					$phone,
					$user_id
					);

				$this->requests_model->insert_sms_res(
					$rsp_sms->txId,
					$rsp_sms->statusCode,
					$rsp_sms->statusMessage,
					$transaccion,
					$user_id
					);	
			}
		}
		redirect(base_url());
	}

	public function get_rsp_token($transaccion){
		$URL_token = "http://52.30.94.95/token";

		// CREA EL XML DEL TOKEN Y LO ENVÍA AL WEB SERVICE.
		$xml_token = $this->xml_post->get_xml_token($transaccion);
		$mnsj_token = $this->xml_post->http_post($URL_token, $xml_token);
		// OBTIENE EL TOKEN DEL XML DEVOLVIDO
		$rsp_token = new SimpleXMLElement($mnsj_token);
		$token = $rsp_token->token;
		// CONTROLAMOS SI EL TOKEN ES CORRECTO
		while (empty($token)) {

			//SI NO ES CORRECTO SE VUELVE A PEDIR OTRO HASTA QUE VAYA BIEN.
			$transaccion = $this->requests_model->get_transaccion();
			$xml_token = $this->xml_post->get_xml_token($transaccion);
			$mnsj_token = $this->xml_post->http_post($URL_token, $xml_token);
			$rsp_token = new SimpleXMLElement($mnsj_token);
			$token = $rsp_token->token;
		}

		return $rsp_token;
	}

	public function get_rsp_cobro($transaccion, $phone, $token){
		
		$URL_bill = "http://52.30.94.95/bill";

		// CREA EL XML DEL COBRO Y LO ENVÍA AL WEB SERVICE.
		$xml_cobro = $this->xml_post->get_xml_cobro($transaccion, $phone, $token);
		$mnsj_cobro = $this->xml_post->http_post($URL_bill, $xml_cobro);
		// OBTIENE EL STATUS MESSAGE DEL COBRO
		$rsp_cobro = new SimpleXMLElement($mnsj_cobro);

		return $rsp_cobro;
	}

	public function get_rsp_sms($texto, $phone, $transaccion){

		$URL_sms = "http://52.30.94.95/send_sms";

		// CREA EL XML DEL SMS Y LO ENVÍA AL WEB SERVICE.
		$xml_sms = $this->xml_post->get_xml_sms($texto, $phone, $transaccion);
		$mnsj_sms = $this->xml_post->http_post($URL_sms, $xml_sms);

				// OBTIENE EL STATUS MESSAGE DEL SMS
		$rsp_sms = new SimpleXMLElement($mnsj_sms);	

		return $rsp_sms;
	}

	//PARA DAR DE ALTA A UN USUARIO
	public function alta_usuario(){

		$transaccion = $this->requests_model->get_transaccion();
		$user = $this->requests_model->select_active_now($this->session->userdata('username'));

		$texto = "Te has dado de alta satisfactoriamente";
		$phone = $user->phone;
		$user_id = $user->user_id;

		$rsp_token = $this->get_rsp_token($transaccion);

		$this->requests_model->insert_token_req(
			$transaccion,
			$user_id
			);
		$this->requests_model->insert_token_res(
			$rsp_token->txId,
			$rsp_token->statusCode,
			$rsp_token->statusMessage,
			$rsp_token->token,
			$transaccion,
			$user_id
			);

		$transaccion = $this->requests_model->get_transaccion();

		$rsp_cobro = $this->get_rsp_cobro($transaccion, $phone, $rsp_token->token);

		// INSERTA LA OPERACION EN LA BBDD DE REQUESTS Y COBROS
		$this->requests_model->insert_cobro_req(
			$transaccion,
			$phone,
			2,
			$rsp_token->token,
			$user_id
			);

			// INSERTA LA OPERACION EN LA BBDD DE REQUESTS Y COBROS
		$this->requests_model->insert_cobro_res(
			$rsp_cobro->txId,
			$rsp_cobro->statusCode,
			$rsp_cobro->statusMessage,
			$transaccion,
			$user_id
			);

		if (! strcmp($rsp_cobro->statusCode, 'NO_FUNDS')) {
			redirect(base_url().'/users/cuenta_error');
			

		} else if (! strcmp($rsp_cobro->statusCode, 'SUCCESS')) {
				// CREA EL XML DEL SMS Y LO ENVÍA AL WEB SERVICE.
			$transaccion = $this->requests_model->get_transaccion();

				//SI SE HA REALIZADO EL COBRO CORRECTAMENTE, SE ENVIA EL SMS

			$transaccion = $this->requests_model->get_transaccion();
			$rsp_sms = $this->get_rsp_sms($texto, $phone, $transaccion);

				// SE INSERTA EN LA BBDD CON LOS CAMPOS CORRECTOS
			$this->requests_model->insert_sms_req(
				$transaccion,
				'+34',
				$texto,
				$phone,
				$user_id
				);

			$this->requests_model->insert_sms_res(
				$rsp_sms->txId,
				$rsp_sms->statusCode,
				$rsp_sms->statusMessage,
				$transaccion,
				$user_id
				);

			$this->operaciones_model->alta($this->session->userdata('username'));
			redirect(base_url().'/users/cuenta');	
		}
		redirect(base_url().'/users/cuenta_error');
	}

}
