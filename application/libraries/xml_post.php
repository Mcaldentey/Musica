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
	
}
?>