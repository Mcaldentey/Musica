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

		$xml_token = $this->xml_post->get_xml_token('123123123123123123123123');
		$mnsj_token = $this->xml_post->http_post($URL_token, $xml_token);

		$rsp_token = new SimpleXMLElement($mnsj_token);
		$token = $rsp_token->token;



		$data = array('output' => $mnsj_token, 'token' => $token);
		$this->load->view('test', $data);

	}

/*
	public function web_operation(){

		$mnsj_token = $this->get_token();

		$rsp_token = new SimpleXMLElement($mnsj_token);
		$token = $rsp_token->token;

		$mnsj_cobro = $this->cobro($token);
		$mnsj_sms = $this->envio_sms();

		$rsp_cobro = new SimpleXMLElement($mnsj_cobro);
		$rsp_sms = new SimpleXMLElement($mnsj_sms);

		$msnj_status_cobro = $rsp_cobro->statusMessage;
		$msnj_status_sms = $rsp_sms->statusMessage;


		$data = array('output' => $mnsj_token, 'token' => $token, 'cobro' => $mnsj_cobro, 'sms' => $msnj_status_sms);
		$this->load->view('test', $data);
	}

	*/

	

}