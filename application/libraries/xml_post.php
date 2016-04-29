<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');
class Xml_post {

	// LIBRERÍA PARA LA BIBLIOTECA CURL Y LA CONEXIÓN POST

	// DEVUELVE UN STRING EN FORMATO XML PARA EL SMS
	public function get_xml_sms($text, $msisdn,$transaction){
		$xml_data ='<?xml version="1.0" encoding="UTF-8"?>'.
		'<request>'.				
		'<shortcode>'.'+34'.'</shortcode>'.
		'<text>'.$text.'</text>'.
		'<msisdn>'.$msisdn.'</msisdn>'.
		'<transaction>'.$transaction.'</transaction>'.
		'</request>';
		return $xml_data;
	}

	// DEVUELVE UN STRING EN FORMATO XML PARA EL COBRO
	public function get_xml_cobro($transaction, $msisdn, $token){
		$xml_data ='<?xml version="1.0" encoding="UTF-8"?>'.
		'<request>'.
		'<transaction>'.$transaction.'</transaction>'.		
		'<msisdn>'.$msisdn.'</msisdn>'.
		'<amount>'.'2'.'</amount>'.
		'<token>'.$token.'</token>'.
		'</request>';
		return $xml_data;
	}

	// DEVUELVE UN STRING EN FORMATO XML PARA EL TOKEN
	public function get_xml_token($transaction){
		$xml_data ='<?xml version="1.0" encoding="UTF-8"?>'.
		'<request>'.
		'<transaction>'.$transaction.'</transaction>'.
		'</request>';
		return $xml_data;
	}

	// DADA UNA URL Y XML REALIZA LA CONEXIÓN POST A ESA URL Y LE ENVÍA ESE XML, Y DEVUELVE EL RESULTADO
	public function http_post($URL, $xml){
		
		$conexion = curl_init($URL);
		curl_setopt($conexion, CURLOPT_USERPWD, 'mcaldentey' . ":" . '8yFqL8Qx');
		curl_setopt($conexion, CURLOPT_POST, 1);
		curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($conexion, CURLOPT_POSTFIELDS, "$xml");
		curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($conexion);
		curl_close($conexion);
		return $output;
	}
	
	public function get_rsp_cobro($transaccion, $phone, $token){
		
		$URL_bill = "http://52.30.94.95/bill";

		// CREA EL XML DEL COBRO Y LO ENVÍA AL WEB SERVICE.
		$xml_cobro = $this->get_xml_cobro($transaccion, $phone, $token);
		$mnsj_cobro = $this->http_post($URL_bill, $xml_cobro);
		// OBTIENE EL STATUS MESSAGE DEL COBRO
		$rsp_cobro = new SimpleXMLElement($mnsj_cobro);

		return $rsp_cobro;
	}

	public function get_rsp_sms($texto, $phone, $transaccion){

		$URL_sms = "http://52.30.94.95/send_sms";

		// CREA EL XML DEL SMS Y LO ENVÍA AL WEB SERVICE.
		$xml_sms = $this->get_xml_sms($texto, $phone, $transaccion);
		$mnsj_sms = $this->http_post($URL_sms, $xml_sms);

				// OBTIENE EL STATUS MESSAGE DEL SMS
		$rsp_sms = new SimpleXMLElement($mnsj_sms);	

		return $rsp_sms;
	}

	public function get_rsp_token($transaccion){
		$URL_token = "http://52.30.94.95/token";

		// CREA EL XML DEL TOKEN Y LO ENVÍA AL WEB SERVICE.
		$xml_token = $this->get_xml_token($transaccion);
		$mnsj_token = $this->http_post($URL_token, $xml_token);
		// OBTIENE EL TOKEN DEL XML DEVOLVIDO
		$rsp_token = new SimpleXMLElement($mnsj_token);
		
		return $rsp_token;
		
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

}
?>