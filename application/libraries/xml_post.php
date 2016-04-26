<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

class Xml_post {

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

	public function get_xml_token($transaction){

		$xml_data ='<?xml version="1.0" encoding="UTF-8"?>'.
		'<request>'.
		'<transaction>'.$transaction.'</transaction>'.
		'</request>';

		return $xml_data;
	}

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

}

?>


