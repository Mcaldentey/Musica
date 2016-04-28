<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Requests_model extends CI_Model {

    // DEVUELVE LOS USUARIOS ACTIVOS Y QUE TIENEN AL MENOS 2 DE SALDO
    public function select_active(){
        $active = 1;
        $this->db->select('phone, user_id');
        $this->db->where('active =', $active);
        return $this->db->get('users')->result();
    }

    // DEVUELVE EL USUARIO ACTUAL
    public function select_active_now($username){
        $active = 1;
        $this->db->select('phone, user_id');
        $this->db->where('username', $username);
        return $this->db->get('users')->row();
    }

    // DEVUELVE LA EL ID DE LA TRANSACCION QUE SE HA DE USAR
    public function get_transaccion(){
        $this->db->select('transaccion');
        $transaccion = $this->db->get('transaccion')->row()->transaccion;
        $this->update_transaccion($transaccion);
        return $transaccion;
    }

    // AÑADE 1 AL ID DE LA TRANSACCION PARA PREPARAR EL SIGUIENTE
    public function update_transaccion($transaccion){
        $nuevo = $transaccion + 1; 

        $data = array('transaccion' => $nuevo);
        $this->db->update('transaccion', $data); 
    }

    // INSERCION EN LA BBDD
    public function insert_token_req($transaction, $user_id){
        $token_request = array(
            'transaction' => $transaction,            
            'user_id' => $user_id,
            'fecha' => date('Y-m-d H:i:s'));
        $this->db->insert('token_request', $token_request);
    }

    // INSERCION EN LA BBDD
    public function insert_token_res($txID,  $statusCode, $statusMessage, $token, $transaction, $user_id){
       $token_response = array(
            'txID' => $txID,
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
            'token' => $token,
            'transaction' => $transaction,
            'fecha' => date('Y-m-d H:i:s'),
            'user_id' => $user_id
            );
        $this->db->insert('token_response', $token_response);
    }

    // INSERCION EN LA BBDD
    public function insert_sms_req($transaction, $shortcode, $sms_text, $msisdn, $user_id){
        $sms_request = array(            
            'transaction' => $transaction,
            'shortcode' => $shortcode,
            'sms_text' => $sms_text,
            'msisdn' => $msisdn,
            'user_id' => $user_id,
            'fecha' => date('Y-m-d H:i:s'));
        $this->db->insert('sms_request', $sms_request);
    }

    // INSERCION EN LA BBDD
    public function insert_sms_res($txId, $statusCode, $statusMessage, $transaction, $user_id){
        $sms_response = array(
            'txId' => $txId,
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
            'transaction' => $transaction,            
            'fecha' => date('Y-m-d H:i:s'),
            'user_id' => $user_id
            );
        $this->db->insert('sms_response', $sms_response);
    }

// INSERCION EN LA BBDD
    public function insert_cobro_req($transaction, $msisdn, $amount, $token, $user_id){
        $cobro_request = array(            
            'transaction' => $transaction,
            'msisdn' => $msisdn,
            'amount' => $amount,
            'token' => $token,
            'user_id' => $user_id,
            'fecha' => date('Y-m-d H:i:s'));
        $this->db->insert('cobro_request', $cobro_request);        
    }

    // INSERCION EN LA BBDD
    public function insert_cobro_res($txID, $statusCode, $statusMessage, $transaction, $user_id){
        $cobro_response = array(
            'txID' => $txID,
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
            'transaction' => $transaction,            
            'fecha' => date('Y-m-d H:i:s'),
            'user_id' => $user_id
            );
        $this->db->insert('cobro_response', $cobro_response);
    }
}