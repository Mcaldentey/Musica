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

        $token_req = array(            
            'transaction' => $transaction,            
            'user_id' => $user_id,
            'fecha' => date('Y-m-d H:i:s'));

        $this->db->insert('token_req', $token_req);
    }

    public function insert_token_req($transaction, $user_id){

        $token_req = array(            
            'transaction' => $transaction,            
            'user_id' => $user_id,
            'fecha' => date('Y-m-d H:i:s'));

        $this->db->insert('token_req', $token_req);
    }    

    public function insert_sms($txID, $transaction, $shortcode, $sms_text, $msisdn, $statusCode, $statusMessage, $token){

        $sms_req = array(
            'txID' => $txID,
            'transaction' => $transaction,
            'shortcode' => $shortcode,
            'sms_text' => $sms_text,
            'msisdn' => $msisdn,
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
            'token' => $token,
            'fecha' => date('Y-m-d H:i:s'));

        $this->db->insert('sms_req', $sms_req);
    }

    public function insert_cobro($txID, $transaction, $msisdn, $amount, $statusCode, $statusMessage, $token){

        $bill_req = array(
            'txID' => $txID,
            'transaction' => $transaction,
            'msisdn' => $msisdn,
            'amount' => $amount,
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
            'token' => $token,
            'fecha' => date('Y-m-d H:i:s'));

        $this->db->insert('bill_req', $bill_req);        
    }


}