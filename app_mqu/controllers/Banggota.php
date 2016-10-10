<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Banggota extends CI_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model(array('bmember_m','member_data','jmember_m','user_m'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('CI_auth', 'CI_menu'));
        $this->load->helper(array('html','form', 'url'));
    }

    public function index ()
    {
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');

        else {
            $data['title'] = 'Biaya Keanggotaan';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));
            // Fetch all datas
            $sub_data['datas'] = $this->bmember_m->get();

            // Load view
            $data['body'] = $this->load->view('_param_banggota', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }

    public function edit ($id=NULL)
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');

        else {
            // Fetch a article or set a new one
            if ($id) {
                $sub_data['datas'] = $this->bmember_m->get($id);
                count($sub_data['datas']) || $sub_data['errors'][] = 'data tidak ada';
            } else {
                $sub_data['datas'] = $this->bmember_m->get_new();
            }

            // Set up the form
            $rules = $this->bmember_m->rules;
            $this->form_validation->set_rules($rules);


            // Process the form
            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'nama_biaya' => $this->input->post('nama_biaya'),
                    'jumlah_biaya' => str_replace( '.', '', $this->input->post('jumlah_biaya')),
                    'jenis_memberid' => $this->input->post('jenis_memberid')
                );


                $this->bmember_m->save($data, $id);
                if ($id) {
                    redirect($this->uri->uri_string(), 'refresh');
                } else {
                    redirect('banggota');
                }

            }

            // Load the view
            $data['title'] = 'Edit Biaya Keanggotaan';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));
            $this->db->where('memberid != 1');
            $sub_data['jmembers'] = $this->jmember_m->get();

            // Load view
            $data['body'] = $this->load->view('_param_banggota_edit', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }

    public function hapus ($id)
    {
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');

        else {
            $this->bmember_m->delete($id);
            redirect('banggota');
        }
    }

}