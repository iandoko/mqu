<?php

class Login extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('CI_auth', 'CI_menu'));
        $this->load->helper(array('html','form', 'url'));
        $this->load->model(array('CI_captcha', 'CI_menu', 'CI_encrypts'));
        $this->load->helper('security');
        

    }

    function index(){
        if($this->CI_auth->check_logged()=== true)
            redirect(base_url().'member_area/');

        $sub_data['login_failed'] ='';
        $sub_data['captcha_return'] ='';
        $sub_data['cap_img'] = $this ->CI_captcha->make_captcha();
        $data['title'] = 'Login';
        $data['menu_top'] = $this->CI_menu->menu_top();
        $data['body'] = $this->load->view('_login_form',$sub_data, true);


        if($this->input->post('submit_login')) {
            $this->form_validation->set_rules('username', 'No Anggota', 'trim|required|min_length[3]|max_length[20]|xss_clean');
            $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[5]|max_length[35]|xss_clean');
            $this->form_validation->set_rules('captcha', 'Captcha', 'required');
            $this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');

            if ($this->form_validation->run() == FALSE){
                $data['body'] = $this->load->view('_login_form',$sub_data , true);
                $this->load->view('_login_html', $data);
            }
            else{
                if($this->CI_captcha->check_captcha()==TRUE) {
                    $login_array = array($this->input->post('username'), $this->input->post('password'));
                    if ($this->CI_auth->process_login($login_array)) {
//login successfull
                        redirect(base_url() . 'member_area/');
                    } else {
                        if( $this->CI_auth->check_status($login_array) == '1' || !$this->CI_auth->check_status($login_array)) {
                            $sub_data['login_failed'] = "No anggota atau password salah.";
                        } else {
                            $sub_data['login_failed'] = "User Belum Aktif";
                        }
                        $data['body'] = $this->load->view('_login_form', $sub_data, true);
                        $this->load->view('_login_html', $data);
                    }
                } else {

                        $sub_data['captcha_return'] = "Karakter captcha yang diinput tidak sesuai. Silahkan coba kembali. <br/>";

                        $data['body']  = $this->load->view('_login_form', $sub_data, true);
                    $this->load->view('_login_html', $data);
                }
            }
        }
        else{
            $this->load->view('_login_html', $data);
        }
    }
    function logout(){
        $data = array(
            'logged_user' => $this->session->userdata('logged_user'),
            'logged_username' => $this->session->userdata('logged_username')

        );
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        redirect(base_url().'login/');
    }


}