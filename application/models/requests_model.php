<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Requests_model extends CI_Model {
    public function select_active(){
        $active = 1;
        $saldo = 2;
        $this->db->select('phone, user_id');
        $this->db->where('active =', $active);
        $this->db->where('saldo >=', $saldo);
        return $this->db->get('users')->result();
    }
    public function get_transaccion(){
        $this->db->select('transaccion');
        $transaccion = $this->db->get('transaccion')->row()->transaccion;
        $this->update_transaccion($transaccion);
        return $transaccion;
    }
    public function update_transaccion($transaccion){
        $nuevo = $transaccion + 1; 
        $data = array('transaccion' => $nuevo);
        $this->db->update('transaccion', $data); 
    }
    public function insert_token_req($transaction, $user_id){
        $token_request = array(
            'transaction' => $transaction,            
            'user_id' => $user_id,
            'fecha' => date('Y-m-d H:i:s'));
        $this->db->insert('token_request', $token_request);
    }
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
    public function insert_sms_res($txId, $statusCode, $statusMessage, $transaction){
        $sms_response = array(
            'txId' => $txId,
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
            'transaction' => $transaction,            
            'fecha' => date('Y-m-d H:i:s'));
        $this->db->insert('sms_response', $sms_response);
    }
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
    public function insert_cobro_res($txID, $statusCode, $statusMessage, $transaction){
        $cobro_response = array(
            'txID' => $txID,
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
            'transaction' => $transaction,            
            'fecha' => date('Y-m-d H:i:s'));
        $this->db->insert('cobro_response', $cobro_response);
    }
    public function get_saldo($user_id){
        $this->db->select('saldo');
        $this->db->where('user_id', $user_id);
        return $this->db->get('users')->row()->saldo;
    }
    public function update_saldo($user_id){
        $saldo = $this->get_saldo($user_id);
        $saldo = $saldo - 2;
        if ($saldo < 2) {
            $this->update_active($user_id);
        }
        $data = array('saldo' => $saldo);
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data); 
    }
    public function update_active($user_id){
        $data = array('active' => 0);
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data); 
    }
}