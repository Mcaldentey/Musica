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

    // CON LOS PARAMETROS PASADOS INSERTA LOS TOKENS EN LA BASE DE DATOS DE TOKEN
    public function insert_token($transaccion, $user_id, $rsp_token){

        $web_token = array(
            'transaction' => $transaccion,
            'user_id' => $user_id,
            'fecha' => date('Y-m-d H:i:s'),
            'txID' => $rsp_token->txId,
            'statusCode' => $rsp_token->statusCode,
            'statusMessage' => $rsp_token->statusMessage,
            'token' => $rsp_token->token
            );
        $this->db->insert('web_token', $web_token);
    }

    // CON LOS PARAMETROS PASADOS INSERTA LOS TOKENS EN LA BASE DE DATOS DE COBROS
    public function insert_cobro($transaccion, $phone, $user_id, $token, $rsp_cobro){

        $web_cobro = array(            
            'transaction' => $transaccion,
            'msisdn' => $phone,
            'amount' => '2',
            'token' => $token,
            'user_id' => $user_id,
            'fecha' => date('Y-m-d H:i:s'),
            'txID' => $rsp_cobro->txId,
            'statusCode' => $rsp_cobro->statusCode,
            'statusMessage' => $rsp_cobro->statusMessage
            );

        $this->db->insert('web_cobro', $web_cobro);
    }

    // CON LOS PARAMETROS PASADOS INSERTA LOS TOKENS EN LA BASE DE DATOS DE SMS
    public function insert_sms($transaccion, $user_id, $texto, $phone, $rsp_sms){
        
        $web_sms = array(
            'transaction' => $transaccion,
            'shortcode' => '+34',
            'sms_text' => $texto,
            'msisdn' => $phone,
            'user_id' => $user_id,
            'fecha' => date('Y-m-d H:i:s'),
            'statusCode' => $rsp_sms->statusCode,
            'statusMessage' => $rsp_sms->statusMessage,
            'txId' => $rsp_sms->txId,
            );
        $this->db->insert('web_sms', $web_sms);

    }

    public function insert_cobro_user($user_id){
        $cobro = array(
            'user_id' => $user_id,
            'amount' => 2,
            'fecha' => date('Y-m-d H:i:s'),
            );
        $this->db->insert('cobros', $cobro);
    }
}