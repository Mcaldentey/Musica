<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Requests_model extends CI_Model {

    // DEVUELVE LOS USUARIOS ACTIVOS Y QUE TIENEN AL MENOS 2 DE SALDO
    public function select_active(){
        $active = 1;
        $saldo = 2;
        $this->db->select('phone, user_id');
        $this->db->where('active =', $active);
        $this->db->where('saldo >=', $saldo);
        return $this->db->get('users')->result();
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
    public function insert_token_res($txID,  $statusCode, $statusMessage, $token, $transaction){
       $token_response = array(
            'txID' => $txID,
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
            'token' => $token,
            'transaction' => $transaction,
            'fecha' => date('Y-m-d H:i:s'));
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
    public function insert_sms_res($txId, $statusCode, $statusMessage, $transaction){
        $sms_response = array(
            'txId' => $txId,
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
            'transaction' => $transaction,            
            'fecha' => date('Y-m-d H:i:s'));
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
    public function insert_cobro_res($txID, $statusCode, $statusMessage, $transaction){
        $cobro_response = array(
            'txID' => $txID,
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
            'transaction' => $transaction,            
            'fecha' => date('Y-m-d H:i:s'));
        $this->db->insert('cobro_response', $cobro_response);
    }

    // DEVUELVE EL SALDO DE UN USUARIO
    public function get_saldo($user_id){
        $this->db->select('saldo');
        $this->db->where('user_id', $user_id);
        return $this->db->get('users')->row()->saldo;
    }

    // SE RESTA 2 AL SALDO DE UN USUARIO
    public function update_saldo($user_id){
        $Baja = 0;
        $saldo = $this->get_saldo($user_id);
        $saldo = $saldo - 2;
        if ($saldo < 2) {
            $this->update_active($user_id);
            $Baja = 1;
        }
        $data = array('saldo' => $saldo);
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data); 
        return $Baja;
    }
    
    // SI EL SALDO DE UN USUARIO PASA A SER MENOR QUE 2, SE LE DA DE BAJA
    public function update_active($user_id){
        $data = array('active' => 0);        
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);

    }
}