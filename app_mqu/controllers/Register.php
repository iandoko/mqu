<?php
class Register extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation', 'session'));
        $this->load->model(array('CI_captcha', 'CI_menu', 'CI_encrypts', 'Member_data', 'User_m'));
        $this->load->helper(array('form', 'url'));
        $this->load->helper('security');
        $this->load->database();
    }

    function index()
    {
        if ($this->CI_auth->check_logged() == true) {
            $status = 1;
        } else {
            $status = 0;
        }
        //redirect(base_url().'member_area/');

        $data['title'] = 'M-QU Register User';
        $data['username'] = $this->session->userdata('logged_username');
        $data['userid'] = $this->session->userdata('logged_user');
        $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));
        $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
        $data['menu_top'] = $this->CI_menu->menu_top();
        $sub_data['captcha_return'] = '';
        $sub_data['cap_img'] = $this->CI_captcha->make_captcha();
        $sub_data["jenis_members"] = $this->db->get('jenis_member')->result();
        $sub_data['status'] = $status;

        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('username', 'User name', 'trim|required|alpha_dash|min_length[3]|max_length[20]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[20]|matches[passconf]|xss_clean');
            $this->form_validation->set_rules('passconf', 'Confirm Password', 'trim|required|min_length[3]|max_length[20]|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|max_length[30]|valid_email');
            $this->form_validation->set_rules('jenis_member', 'Jenis Member', 'trim|required|xss_clean');

// Set Custom messages
//$this->form_validation->set_message('required', 'Your custom message here');


            if ($this->form_validation->run() == FALSE) {
                $data['body'] = $this->load->view('_join_form', $sub_data, true);
            } else {
                if ($status == 1) {
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    $email = $this->input->post('email');
                    $jenis_member = $this->input->post('jenis_member');
                    $status_post = $this->input->post('status');
                    $check_query = "SELECT * FROM `user` WHERE `username`='$username' OR `email`='$email'";
                    $query = $this->db->query($check_query);
                    if ($query->num_rows() > 0) {
                        $sub_data['captcha_return'] = 'username or email address you entered is already used by another, please change<br/>';
                        $data['body'] = $this->load->view('_join_form', $sub_data, true);
                    } else {
                        $rand_salt = $this->CI_encrypts->genRndSalt();
                        $encrypt_pass = $this->CI_encrypts->encryptUserPwd($this->input->post('password'), $rand_salt);
                        $input_data = array(
                            'username' => $username,
                            'email' => $email,
                            'password' => $encrypt_pass,
                            'status' => 0,
                            'jenis_member_memberid' => $jenis_member,
                            'salt' => $rand_salt,
                            'ref_uid' => $this->session->userdata('logged_user')
                        );
                        if ($this->db->insert('user', $input_data)) {
                            $data['body'] = "Registrasi berhasil<br/>";
                        } else
                            $data['body'] = "error on query";
                    }
                } else {
                    if ($this->CI_captcha->check_captcha() == TRUE) {
                        $username = $this->input->post('username');
                        $password = $this->input->post('password');
                        $email = $this->input->post('email');
                        $jenis_member = $this->input->post('jenis_member');
                        $status_post = $this->input->post('status');
                        $check_query = "SELECT * FROM `user` WHERE `username`='$username' OR `email`='$email'";
                        $query = $this->db->query($check_query);
                        if ($query->num_rows() > 0) {
                            $sub_data['captcha_return'] = 'username or email address you entered is already used by another, please change<br/>';
                            $data['body'] = $this->load->view('_join_form', $sub_data, true);
                        } else {
                            $rand_salt = $this->CI_encrypts->genRndSalt();
                            $encrypt_pass = $this->CI_encrypts->encryptUserPwd($this->input->post('password'), $rand_salt);
                            $input_data = array(
                                'username' => $username,
                                'email' => $email,
                                'password' => $encrypt_pass,
                                'status' => 0,
                                'jenis_member_memberid' => $jenis_member,
                                'salt' => $rand_salt,
                                'ref_uid' => $this->session->userdata('logged_user')
                            );
                            if ($this->db->insert('user', $input_data)) {
                                $data['body'] = "Registrasi berhasil<br/>";
                            } else
                                $data['body'] = "error on query";
                        }
                    } else {
                        $sub_data['captcha_return'] = "Karakter captcha yang diinput tidak sesuai. Silahkan coba kembali. <br/>";
                        $data['body'] = $this->load->view('_join_form', $sub_data, true);
                    }
                }
            }

        } else {
            $data['body'] = $this->load->view('_join_form', $sub_data, true);
        }
        $this->load->view('_output_html', $data);

    }

    function reset($id)
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');
        else {
            if ($id != $this->session->userdata('logged_user')) {
                redirect(base_url());
            } else {
                $data['title'] = 'Ganti Password';
                $data['username'] = $this->session->userdata('logged_username');
                $data['userid'] = $this->session->userdata('logged_user');
                $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));
                $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
                $data['menu_top'] = $this->CI_menu->menu_top();

                $sub_data['useredit'] = $this->db->get_where('member_list', array('userid' => $id))->result();

                if ($this->input->post('submit')) {

                    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[20]|matches[passconf]|xss_clean');
                    $this->form_validation->set_rules('passconf', 'Confirm Password', 'trim|required|min_length[3]|max_length[20]|xss_clean');

                    if ($this->form_validation->run() == FALSE) {
                        $data['body'] = $this->load->view('_user_reset', $sub_data, true);
                    } else {
                        $rand_salt = $this->CI_encrypts->genRndSalt();
                        $encrypt_pass = $this->CI_encrypts->encryptUserPwd($this->input->post('password'), $rand_salt);


                        $userid = $this->input->post('userid');

                        $input_data = array(
                            'password' => $encrypt_pass,
                            'salt' => $rand_salt,
                        );
                        if ($this->db->update('user', $input_data, array('userid' => $userid))) {
                            $data['body'] = "Reset password berhasil<br/>";
                        } else
                            $data['body'] = "error on query";
                    }

                } else {
                    $data['body'] = $this->load->view('_user_reset', $sub_data, true);
                }
                $this->load->view('_output_html', $data);
            }

        }
    }

    function email($id)
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');
        else {
            if ($id != $this->session->userdata('logged_user')) {
                redirect(base_url());
            } else {
                $data['title'] = 'Ganti Email';
                $data['username'] = $this->session->userdata('logged_username');
                $data['userid'] = $this->session->userdata('logged_user');
                $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));
                $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
                $data['menu_top'] = $this->CI_menu->menu_top();

                $sub_data['useredit'] = $this->db->get_where('member_list', array('userid' => $id))->result();

                if ($this->input->post('submit')) {
                    $this->form_validation->set_rules('email_exist', 'Email Exist', 'callback_validate_email');
                    $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|max_length[30]|valid_email');

                    if ($this->form_validation->run() == FALSE) {
                        $data['body'] = $this->load->view('_user_email', $sub_data, true);
                    } else {

                        $userid = $this->input->post('userid');

                        $input_data = array(
                            'email' => $this->input->post('email'),

                        );
                        if ($this->db->update('user', $input_data, array('userid' => $userid))) {
                            $data['body'] = "Email berhasil diganti<br/>";
                        } else
                            $data['body'] = "error on query";
                    }

                } else {
                    $data['body'] = $this->load->view('_user_email', $sub_data, true);
                }
                $this->load->view('_output_html', $data);
            }

        }
    }

    public function validate_email()
    {
        $check_query = "SELECT * FROM `user` WHERE `email`='".$this->input->post('email')."'";
        $query = $this->db->query($check_query);
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('validate_email', "Email sudah digunakan!");
            return false;
        } else {
            return true;

        }
    }

}