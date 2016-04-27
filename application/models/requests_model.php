<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Requests_model extends CI_Model {

    public function insert_user($table, $data){ //insert a table on the database

    	return $this->db->insert($table, $data);
    }

    public function select_active(){
        $active = 1;
        $saldo = 2;

        $this->db->select('phone, user_id');
        $this->db->where('active =', $active);
        $this->db->where('saldo >=', $saldo);
        return $this->db->get('users')->result();

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


}