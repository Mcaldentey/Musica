<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Requests_model extends CI_Model {

    public function insert_user($table, $data){ //insert a table on the database

    	return $this->db->insert($table, $data);
    }

    public function select_max_transaction(){
        $this->db->select_max('transaction');
        $max = $this->db->get('request');
        if($max->num_rows() > 0)
        {
            $res = $max->result_array();
            return ($res[0]['transaction']) +69687425564;
        }
        return 1;
    }

    public function select_active(){
        $active = 1;
        $saldo = 2;

        $this->db->select('phone, user_id');
        $this->db->where('active =', $active);
        $this->db->where('saldo >=', $saldo);
        return $this->db->get('users')->result();

    }

    public function insert_request($type, $user_id){
        $request = array('type' => $type, 'user_id' => $user_id);
        $this->db->insert('request', $request);
    }

    public function insert_token($txID, $transaction, $statusCode, $statusMessage, $token){

        $token_req = array(
            'txID' => $txID,
            'transaction' => $transaction,
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
            'token' => $token,
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