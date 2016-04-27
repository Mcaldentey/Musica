<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Web_service extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('requests_model');
		$this->load->library('xml_post');
	}
	
	public function web_service_call() {
		$URL_sms = "http://52.30.94.95/send_sms";
		$URL_token = "http://52.30.94.95/token";
		$URL_bill = "http://52.30.94.95/bill";
		
		$users = $this->requests_model->select_active();
		$texto = $this->input->post('texto');
		
		foreach ($users as $user) {
			$transaccion = $this->requests_model->get_transaccion();
			$phone = $user->phone;
			$user_id = $user->user_id;
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
				$transaccion
				);
			$transaccion = $this->requests_model->get_transaccion();
			// CREA EL XML DEL COBRO Y LO ENVÍA AL WEB SERVICE.
			$xml_cobro = $this->xml_post->get_xml_cobro($transaccion, $phone, $token);
			$mnsj_cobro = $this->xml_post->http_post($URL_bill, $xml_cobro);
			// OBTIENE EL STATUS MESSAGE DEL COBRO
			$rsp_cobro = new SimpleXMLElement($mnsj_cobro);
			$cobro_status_code = $rsp_cobro->statusCode;
			/*
			while (strcmp($cobro_status_code, 'SUCCESS') !== 0 ) {
				
				//SI NO ES CORRECTO SE VUELVE A PEDIR OTRO HASTA QUE VAYA BIEN.
				$transaccion = $this->requests_model->get_transaccion();
				// CREA EL XML DEL COBRO Y LO ENVÍA AL WEB SERVICE.
				$xml_cobro = $this->xml_post->get_xml_cobro($transaccion, $phone, $token);
				$mnsj_cobro = $this->xml_post->http_post($URL_bill, $xml_cobro);
				// OBTIENE EL STATUS MESSAGE DEL COBRO
				$rsp_cobro = new SimpleXMLElement($mnsj_cobro);
				$cobro_status_code = $rsp_cobro->statusCode;
			}
			*/
			// INSERTA LA OPERACION EN LA BBDD DE REQUESTS Y COBROS
			$this->requests_model->insert_cobro_req(
				$transaccion,
				$phone,
				2,
				$token,
				$user_id
				);
			
			$this->requests_model->insert_cobro_res(
				$rsp_cobro->txId,
				$rsp_cobro->statusCode,
				$rsp_cobro->statusMessage,
				$transaccion
				);
			// CREA EL XML DEL SMS Y LO ENVÍA AL WEB SERVICE.
			$transaccion = $this->requests_model->get_transaccion();
			if (! strcmp($cobro_status_code, 'SUCCESS')) {
				//SI SE HA REALIZADO EL COBRO CORRECTAMENTE, SE ACTUALIZA EL SALDO Y SE ENVIA EL SMS
				$this->requests_model->update_saldo($user_id);
				$xml_sms = $this->xml_post->get_xml_sms($texto, $phone, $transaccion);
				$mnsj_sms = $this->xml_post->http_post($URL_sms, $xml_sms);
				// OBTIENE EL STATUS MESSAGE DEL SMS
				$rsp_sms = new SimpleXMLElement($mnsj_sms);
				$sms_status_code = $rsp_sms->statusCode;
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
					$transaccion
					);
			} else {
				$this->requests_model->insert_sms_req(
					$transaccion,
					'+34',
					'ERROR EN EL COBRO, SMS NO ENVIADO',
					$phone,
					$user_id
					);
			}		
		}
		redirect(base_url());
	}
}