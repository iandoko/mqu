<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pilih extends CI_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model(array('parameter_data','parameter_m','sistem_m'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('CI_auth', 'CI_menu'));
        $this->load->helper(array('html','form', 'url'));
    }

    public function index ()
    {
        redirect(base_url().'login/');
    }

    public function paket()
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');

        else {
           // echo $this->session->userdata('jenis_s');

            //search_params
            if($this->input->post('submit') == 'cari') {
                $this->session->set_userdata('jenis_s', $this->input->get_post('jenis_s', TRUE));
                $jenis = $this->session->userdata('jenis_s');

            } else {

                if ($this->session->userdata('jenis_s')) {
                    $jenis = $this->session->userdata('jenis_s');
                } else {
                    $jenis = '';
                }
            }

            $sub_data['jenis'] = $jenis;

            //pagination
            if ($jenis !='All') {
                $this->db->like('jenis_sapi', $jenis);
            }

            //echo $cat. ' '.$keywords;
            //print_r($this->session->userdata());
            $count = $this->db->count_all_results('paket');
            $sub_data['count'] = $count;

            $dataperpage = $this->parameter_m->get(20);
            $perpage = $dataperpage->value;

            $page_data = $this->sistem_m->pagination($count,$perpage,$this->uri->segment(1) . '/'.$this->uri->segment(2),3);
            $sub_data['pagination'] = $page_data['pagination'];

            //display search
            if ($jenis !='All') {
                $this->db->like('jenis_sapi', $jenis);
            }
            //echo $cat. ' '.$keywords;
            $this->db->order_by('nama_paket');
            $this->db->limit($perpage, $page_data['offset']);


            $content = $this->parameter_data->paket_list();
            $sub_data['datas'] = $content;
            $sub_data['jenis_ops'] = $this->parameter_data->hewan_list();

            // Fetch a article or set a new one
            $data['title'] = 'Pilih Paket';
            $data['userid'] = $this->session->userdata('logged_user');

            // Load view

            $data['body'] = $this->load->view('_pilih_paket', $sub_data, true);

            $this->load->view('_output_pop', $data);
        }
    }



}