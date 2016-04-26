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

		$transaccion = $this->requests_model->select_max_transaction();

/*
		$xml_token = $this->xml_post->get_xml_token('11231231232312339123123');
		$mnsj_token = $this->xml_post->http_post($URL_token, $xml_token);

		$rsp_token = new SimpleXMLElement($mnsj_token);
		$token = $rsp_token->token;

		$xml_sms = $this->xml_post->get_xml_sms('texto de prueba', '123123123', '12393032711123123123123');
		$mnsj_sms = $this->xml_post->http_post($URL_sms, $xml_sms);

		$xml_cobro = $this->xml_post->get_xml_cobro('11232332101231921233123', '123123321', $token);
		$mnsj_cobro = $this->xml_post->http_post($URL_bill, $xml_cobro);

		$rsp_sms = new SimpleXMLElement($mnsj_sms);
		$sms_status_message = $rsp_sms->statusMessage;

		$rsp_cobro = new SimpleXMLElement($mnsj_cobro);
		$cobro_status_message = $rsp_cobro->statusMessage;
*/
		$users = $this->requests_model->select_active();
		$texto = 'Texto de prueba';
		

		foreach ($users as $user) {
			$phone = $user->phone;

			// CREA EL XML DEL TOKEN Y LO ENVÍA AL WEB SERVICE.
			$xml_token = $this->xml_post->get_xml_token($transaccion);
			$mnsj_token = $this->xml_post->http_post($URL_token, $xml_token);

			// OBTIENE EL TOKEN DEL XML DEVOLVIDO
			$rsp_token = new SimpleXMLElement($mnsj_token);
			$token = $rsp_token->token;

			// INSERTA LA OPERACION EN LA BBDD DE REQUESTS Y TOKENS
			$this->requests_model->insert_token(
				$rsp_token->txId,
				$transaccion,
				$rsp_token->statusCode,
				$rsp_token->statusMessage,
				$token);

			$this->requests_model->insert_request(0, $user->user_id);


			// CREA EL XML DEL SMS Y LO ENVÍA AL WEB SERVICE.
			$transaccion = $transaccion +1;
			$xml_sms = $this->xml_post->get_xml_sms($texto, $phone, $transaccion);
			$mnsj_sms = $this->xml_post->http_post($URL_sms, $xml_sms);

			// OBTIENE EL STATUS MESSAGE DEL SMS
			$rsp_sms = new SimpleXMLElement($mnsj_sms);
			$sms_status_message = $rsp_sms->statusMessage;

			// INSERTA LA OPERACION EN LA BBDD DE REQUESTS Y SMS
			$this->requests_model->insert_sms(
				$rsp_sms->txId,
				$transaccion,
				'+34',
				$texto,
				$user->phone,
				$rsp_sms->statusCode,
				$rsp_sms->statusMessage,
				$token);
			$this->requests_model->insert_request(1, $user->user_id);

			$transaccion = $transaccion +1;
			// CREA EL XML DEL COBRO Y LO ENVÍA AL WEB SERVICE.
			$xml_cobro = $this->xml_post->get_xml_cobro($transaccion, $phone, $token);
			$mnsj_cobro = $this->xml_post->http_post($URL_bill, $xml_cobro);

			// OBTIENE EL STATUS MESSAGE DEL COBRO
			$rsp_cobro = new SimpleXMLElement($mnsj_cobro);
			$cobro_status_message = $rsp_cobro->statusMessage;

			// INSERTA LA OPERACION EN LA BBDD DE REQUESTS Y COBROS
			$this->requests_model->insert_request(2, $user->user_id);
			$this->requests_model->insert_cobro(
				$rsp_cobro->txId,
				$transaccion,				
				$user->phone,
				'2',
				$rsp_cobro->statusCode,
				$rsp_cobro->statusMessage,
				$token);

			$transaccion++;
		}

		redirect(base_url());
	}


}