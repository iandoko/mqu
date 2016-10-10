<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Download extends CI_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model(array('parameter_data'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('CI_auth', 'CI_menu'));
        $this->load->helper(array('html','form', 'url'));
    }



    public function index($file)
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');

        else {


        }

    }
}