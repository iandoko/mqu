<?php
class CI_auth extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('url');
        $this->load->model(array('CI_encrypts'));
    }

    function process_login($login_array_input = NULL){
        if(!isset($login_array_input) OR count($login_array_input) != 2)
            return false;
//set its variable
        $username = $login_array_input[0];
        $password = $login_array_input[1];
// select data from database to check user exist or not?
        $query = $this->db->query("SELECT * FROM `user` WHERE `username`= '".$username."' AND `status` = '1' LIMIT 1");
        if ($query->num_rows() > 0)
        {
            $row = $query->row();
            $user_id = $row->userid;
            $username = $row->username;
            $user_pass = $row->password;
            $user_salt = $row->salt;
            if($this->CI_encrypts->encryptUserPwd( $password,$user_salt) === $user_pass){
                $this->session->set_userdata(array('logged_user'=> $user_id, 'logged_username' => $username));
                return true;
            }
            return false;
        }
        return false;
    }
    function check_status($login_array_input){
        $status = 0;
        $username = $login_array_input[0];
        $query = $this->db->get_where('user', array('username' => $username));
        $row = $query->row();
        if ($row) {
            $status = $row->status;
        }
        return $status;
    }

    function check_logged(){
        return ($this->session->userdata('logged_user'))?TRUE:FALSE;
    }


    function logged_id(){
        return ($this->check_logged())?$this->session->userdata('logged_user'):'';
    }
}