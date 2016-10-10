<?php

class Parameter extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation','session'));
        $this->load->model(array('CI_auth', 'CI_menu','Parameter_data','Member_data','User_m','Jbayar_m','parameter_m'));
        $this->load->helper(array('html','url','form'));
        $this->load->helper('security');
    }

    public function index ()
    {
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');

        else {
            //access data


            //access data end
            $data['title'] = 'Konfigurasi Aplikasi';
            $data['username'] = $this->session->userdata('logged_username');
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
            $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));

            // Fetch all datas
            $sub_data['datas'] = $this->parameter_m->get();

            // Load view
            $data['body'] = $this->load->view('_param_parameter', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }

    public function edit ($id=NULL)
    {
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url() . 'login/');

        else {
            //access data


            //access data end
            // Fetch a article or set a new one
            if ($id) {
                $sub_data['datas'] = $this->parameter_m->get($id);
                count($sub_data['datas']) || $sub_data['errors'][] = 'data tidak ada';
            } else {
                redirect(base_url() . 'parameter/');
            }

            // Set up the form
            $rules = $this->parameter_m->rules;
            $this->form_validation->set_rules($rules);


            // Process the form
            if ($this->form_validation->run() == TRUE) {


                $data = array(
                    'value' => $this->input->post('value'),
                    'create_time' => date('Y-m-d h:i:s'),
                );


                $this->parameter_m->save($data, $id);
                if ($id) {
                    redirect($this->uri->uri_string(), 'refresh');
                } else {
                    redirect('parameter');
                }

            }

            // Load the view
            $data['title'] = 'Edit Parameter';
            $data['username'] = $this->session->userdata('logged_username');
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
            $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));


            // Load view
            $data['body'] = $this->load->view('_param_parameter_edit', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }



    function paket($id = null)
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');
        else {
            $data['title'] = 'Parameter Hewan Qurban';
            $data['menu_top'] = $this->CI_menu->menu_top();

            if ($id) {
                $sub_data['jenis_hewans'] = $this->Parameter_data->hewan_list();
                $sub_data['ranges'] = $this->Parameter_data->range_list();
                $sub_data['members'] = $this->Parameter_data->paket_list($id);
                $data['body'] = $this->load->view('_param_paket_edit', $sub_data, true);
            } else {
                $sub_data['members'] = $this->Parameter_data->paket_list();
                $data['body'] = $this->load->view('_param_paket', $sub_data, true);
            }
            $data['username'] = $this->session->userdata('logged_username');
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
            $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));
            $this->load->view('_output_html', $data);

        }
    }

    function paket_update($id)
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');
        else {
            if ($this->input->post('submit')) {
                $this->form_validation->set_rules('nama_paket', 'Nama Hewan Qurban', 'trim|required|min_length[3]|max_length[40]|xss_clean');
                $this->form_validation->set_rules('harga', 'Harga', 'trim|required|min_length[3]|max_length[20]|xss_clean');
                $this->form_validation->set_rules('harga_group', 'Harga Group', 'trim|required|min_length[3]|max_length[20]|xss_clean');
                if ($this->form_validation->run() == TRUE) {
                    $this->Parameter_data->paket_update($id);
                    redirect(base_url() . 'parameter/paket/', 'refresh');
                }
            }
        }
    }
    function paket_insert()
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');
        else {
            if ($this->input->post('submit')) {
                $this->form_validation->set_rules('nama_paket', 'Nama Hewan Qurban', 'trim|required|min_length[3]|max_length[40]|xss_clean');
                $this->form_validation->set_rules('harga', 'Harga', 'trim|required|min_length[3]|max_length[20]|xss_clean');
                $this->form_validation->set_rules('harga_group', 'Harga Group', 'trim|required|min_length[3]|max_length[20]|xss_clean');


                if ($this->form_validation->run() == TRUE) {
                    $this->Parameter_data->paket_insert();
                    redirect(base_url() . 'parameter/paket/');
                } else {
                    $data['title'] = 'Tambah Hewan Qurban';
                    $data['menu_top'] = $this->CI_menu->menu_top();
                    $sub_data['jenis_hewans'] = $this->Parameter_data->hewan_list();
                    $sub_data['ranges'] = $this->Parameter_data->range_list();

                    $data['body'] = $this->load->view('_param_paket_insert', $sub_data, true);

                    $data['username'] = $this->session->userdata('logged_username');
                    $data['userid'] = $this->session->userdata('logged_user');
                    $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
                    $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));
                    $this->load->view('_output_html', $data);
                }
            } else {
                $data['title'] = 'Tambah Hewan Qurban';
                $data['menu_top'] = $this->CI_menu->menu_top();

                $sub_data['jenis_hewans'] = $this->Parameter_data->hewan_list();
                $sub_data['ranges'] = $this->Parameter_data->range_list();
                $data['body'] = $this->load->view('_param_paket_insert', $sub_data, true);

                $data['username'] = $this->session->userdata('logged_username');
                $data['userid'] = $this->session->userdata('logged_user');
                $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
                $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));
                $this->load->view('_output_html', $data);
            }
        }
    }
    function paket_hapus($id)
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');
        else {
                $this->Parameter_data->paket_delete($id);
                redirect(base_url() . 'parameter/paket/');
        }
    }

    function jbayar()
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');
        else {
            $data['title'] = 'Jenis Pembayaran';
            $data['menu_top'] = $this->CI_menu->menu_top();


                $sub_data['datas'] = $this->Jbayar_m->get();
                $data['body'] = $this->load->view('_param_jbayar', $sub_data, true);

            $data['username'] = $this->session->userdata('logged_username');
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
            $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));
            $this->load->view('_output_html', $data);

        }
    }

    function jbayar_edit($id=NULL)
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');
        else {

            if ($id) {
                $sub_data['datas'] = $this->Jbayar_m->get($id);
                count($sub_data['datas']) || $sub_data['errors'][] = 'data tidak ada';
            } else {
                $sub_data['datas'] = $this->Jbayar_m->get_new();
            }
            // Set up the form
            $rules = $this->Jbayar_m->rules;
            $this->form_validation->set_rules($rules);


            // Process the form
            if ($this->form_validation->run() == TRUE) {


                $data = array(
                    'nama_pembayaran' => $this->input->post('nama_pembayaran'),
                    'pembagi' => $this->input->post('pembagi'),
                );


                $this->Jbayar_m->save($data, $id);
                if ($id) {
                    redirect($this->uri->uri_string(), 'refresh');
                } else {
                    redirect('parameter/jbayar');
                }
            }
            if ($id) {
                $data['title'] = 'Edit Pembayaran';
            } else {
                $data['title'] = 'Tambah Pembayaran';
            }
                $data['menu_top'] = $this->CI_menu->menu_top();




                $data['username'] = $this->session->userdata('logged_username');
                $data['userid'] = $this->session->userdata('logged_user');
                $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
                $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));

                $data['body'] = $this->load->view('_param_jbayar_edit', $sub_data, true);
                $this->load->view('_output_html', $data);

        }
    }

    public function jbayar_hapus ($id)
    {
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');

        else {
           // $this->Jbayar_m->delete($id);
            redirect('parameter/jbayar');
        }
    }
}