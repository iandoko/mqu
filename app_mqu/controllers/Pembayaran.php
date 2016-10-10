<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('member_data', 'jmember_m', 'user_m', 'pakettr_m', 'parameter_m', 'parameter_data', 'konfirm_m', 'sistem_m'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('CI_auth', 'CI_menu'));
        $this->load->helper(array('html', 'form', 'url'));
    }

    public function index()
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');

        else {

            $data['title'] = 'Data Pembayaran';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));
            // Fetch all datas


            if ($data['jmember']->memberid == 1) {
                $count = $this->db->count_all_results('vdata_pembayaran');
                $sub_data['count'] = $count;

                $dataperpage = $this->parameter_m->get(20);
                $perpage = $dataperpage->value;
                $page_data = $this->sistem_m->pagination($count, $perpage, $this->uri->segment(1) . '/');
                $sub_data['pagination'] = $page_data['pagination'];

                $this->db->order_by('idpembayaran', 'DESC');
                $this->db->order_by('idorder', 'DESC');
                $this->db->limit($perpage, $page_data['offset']);

                $this->db->from('vdata_pembayaran');
                $query = $this->db->get();

                $sub_data['datas'] = $query->result_array();
                $sub_data['memberid'] = $data['jmember']->memberid;
                $data['body'] = $this->load->view('_pembayaran_list', $sub_data, true);

            } else {
                $this->db->where('user_userid',$this->session->userdata('logged_user'));
                $count = $this->db->count_all_results('vdata_pembayaran');
                $sub_data['count'] = $count;

                $dataperpage = $this->parameter_m->get(20);
                $perpage = $dataperpage->value;
                $page_data = $this->sistem_m->pagination($count, $perpage, $this->uri->segment(1) . '/');
                $sub_data['pagination'] = $page_data['pagination'];

                $this->db->where('user_userid',$this->session->userdata('logged_user'));
                $this->db->order_by('idpembayaran', 'DESC');
                $this->db->order_by('idorder', 'DESC');
                $this->db->limit($perpage, $page_data['offset']);

                $this->db->from('vdata_pembayaran');
                $query = $this->db->get();

                $sub_data['datas'] = $query->result_array();
                $sub_data['memberid'] = $data['jmember']->memberid;
                $data['body'] = $this->load->view('_pembayaran_list', $sub_data, true);

            }
            // Load view

            $this->load->view('_output_html', $data);
        }
    }

    public function group($id)
    {
        if ($this->CI_auth->check_logged() === FALSE || $id == '')
            redirect(base_url() . 'login/');
        else {
            $data['title'] = 'Detail Pembayaran';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));
            // Fetch all datas

            if ($data['jmember']->memberid == 1) {
                $this->db->where('idorder',$id);
                $this->db->from('vdata_pembayaran');
                $query = $this->db->get();

                $sub_data['datas'] = $query->result_array();

                $this->db->where('idorder',$id);
                $sub_data['details'] =$this->konfirm_m->get();
            } else {
                $this->db->where('user_userid',$this->session->userdata('logged_user'));
                $this->db->where('idorder',$id);
                $this->db->from('vdata_pembayaran');
                $query = $this->db->get();
                $sub_data['datas'] = $query->result_array();

                $this->db->where('user_userid',$this->session->userdata('logged_user'));
                $this->db->where('status','1');
                $this->db->from('group_cekuser');
                $query = $this->db->get();
                $sub_data['group'] = $query->result_array();
                //print_r($sub_data['group']);

                $members = array();
                if (count($sub_data['group']) > 0) {
                    $this->db->where('idgroup', $sub_data['group'][0]['idgroup']);
                    $this->db->from('group_member');
                    $query = $this->db->get();
                    $members = $query->result_array();
                }


                $sub_data['details'] = array();
                $max = count($members);
                for ($i=0;$i<$max;$i++) {
                    $this->db->where('user_userid', $members[$i]['user_userid']);
                    $this->db->where('idorder', $id);
                    $this->db->from('vdata_group_pembayaran');
                    $query = $this->db->get();
                    $datax = $query->result_array();
                    $count = count($datax);
                    if ($count > 0) {
                        $jumlah_pembayaran = $datax[0]['jumlah_pembayaran'];
                        $username = $datax[0]['username'];
                        $nama = $datax[0]['user_userid'];
                    } else {
                        $username = $members[$i]['user_userid'];
                        $jumlah_pembayaran = 0;
                        $nama = $members[$i]['user_userid'];
                    }

                    $sub_data['details'][$i] = array(
                        'user_userid' => $members[$i]['user_userid'],
                        'username' => $username,
                        'jumlah_pembayaran' => $jumlah_pembayaran,
                        'nama_lengkap' => $nama

                    );
                }

            }
            $data['body'] = $this->load->view('_pembayaran_group_detail', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }

    public function detail($id)
    {
        if ($this->CI_auth->check_logged() === FALSE || $id == '')
            redirect(base_url() . 'login/');
        else {
            $data['title'] = 'Detail Pembayaran';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));
            // Fetch all datas

            if ($data['jmember']->memberid == 1) {
                $this->db->where('idorder',$id);
                $this->db->from('vdata_pembayaran');
                $query = $this->db->get();

                $sub_data['datas'] = $query->result_array();

                $this->db->where('idorder',$id);
                $sub_data['details'] =$this->konfirm_m->get();
            } else {
                $this->db->where('user_userid',$this->session->userdata('logged_user'));
                $this->db->where('idorder',$id);
                $this->db->from('vdata_pembayaran');
                $query = $this->db->get();
                $sub_data['datas'] = $query->result_array();

                $this->db->where('idorder',$id);
                $this->db->where('user_userid',$this->session->userdata('logged_user'));
                $this->db->order_by('idpembayaran');
                $this->db->where('status_bayar','1');
                $sub_data['details'] =$this->konfirm_m->get();

                $this->db->where('user_userid',$this->session->userdata('logged_user'));
                $this->db->where('status','1');
                $this->db->from('group_cekuser');
                $query = $this->db->get();
                $sub_data['group'] = $query->result_array();

            }
            $data['body'] = $this->load->view('_pembayaran_detail', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }
}