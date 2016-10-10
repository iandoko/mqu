<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi extends CI_Controller
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

            $data['title'] = 'List Konfirmasi';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));
            // Fetch all datas


            if ($data['jmember']->memberid == 1) {
                $count = $this->db->count_all_results('vtransaksi_pembayaran');
                $sub_data['count'] = $count;

                $dataperpage = $this->parameter_m->get(20);
                $perpage = $dataperpage->value;
                $page_data = $this->sistem_m->pagination($count, $perpage, $this->uri->segment(1) . '/');
                $sub_data['pagination'] = $page_data['pagination'];

                $this->db->order_by('idpembayaran', 'DESC');
                $this->db->order_by('idorder', 'DESC');
                $this->db->limit($perpage, $page_data['offset']);

                $sub_data['datas'] = $this->konfirm_m->get();

            } else {
                redirect(base_url() . 'login/');

            }
            // Load view
            $sub_data['memberid'] = $data['jmember']->memberid;
            $data['body'] = $this->load->view('_konfirmasi_list', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }

    public function proses($id)
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');
        else {
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));
            if ($data['jmember']->memberid == 1) {
                $data = array(
                    'status_bayar' => '1',
                );
                $this->konfirm_m->save($data, $id);

                //send mail to customer
                $email = $this->parameter_m->get(2);
                $email = $email->value;
                $company = $this->parameter_m->get(1);
                $company = $company->value;


                $data = $this->konfirm_m->get($id);
                $user = $this->member_data->get_member($data->user_userid);
                $data_email = array(
                    'username' => $user['username'],
                    'sitename' => $company,
                    'imgurl' => base_url() . 'images/logo-default.png',
                    'idorder' => $data->idorder,
                    'nama_pembayaran' => $data->nama_pembayaran,
                    'jumlah_pembayaran' => number_format($data->jumlah_pembayaran, 0, ',', '.'),
                    'tanggal_bayar' => date('d-m-Y', strtotime($data->tanggal_bayar)),
                    'waktu_bayar' => $data->waktu_bayar,
                    'nama_bank' => $data->nama_bank,
                    'nama_rek_bayar' => $data->nama_rek_bayar,
                    'no_rek_bayar' => $data->no_rek_bayar,
                );
                $this->sistem_m->send_mail($data_email, $email, $user['email'], 'email_konfirmasi_terima_html', 'Penerimaan Konfirmasi Pembayaran Order No : #' . $data->idorder);

                // print_r($data);
                //echo $user['email'];

                redirect(base_url() . 'konfirmasi/');

            } else {
                redirect(base_url() . 'login/');
            }
        }
    }

    function tolak($id)
    {
        if ($this->CI_auth->check_logged() === FALSE || $id == '')
            redirect(base_url() . 'login/');

        else {

            $data['title'] = 'Penolakan / Pembatalan Konfirmasi Pembayaran';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));


            $datao = $this->konfirm_m->get($id);

            $user = $this->member_data->get_member($datao->user_userid);
            $data_user =  array(
                'idpembayaran' => $id,
                'username' => $user['username'],
                'idorder' => $datao->idorder,
                'nama_pembayaran' => $datao->nama_pembayaran,
                'jumlah_pembayaran' => number_format($datao->jumlah_pembayaran, 0, ',', '.'),
                'tanggal_bayar' => date('d-m-Y', strtotime($datao->tanggal_bayar)),
                'waktu_bayar' => $datao->waktu_bayar,
                'nama_bank' => $datao->nama_bank,
                'nama_rek_bayar' => $datao->nama_rek_bayar,
                'no_rek_bayar' => $datao->no_rek_bayar,
                'status_bayar' => $datao->status_bayar,
                'keterangan' => $datao->keterangan,
            );

             $sub_data['users'] =  $data_user;


            $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim|min_length[8]');


            // Process the form
            if ($this->form_validation->run() == TRUE) {
                $datax = array(
                    'status_bayar' => '2',
                    'keterangan' => $this->input->post('keterangan'),
                );
                $this->konfirm_m->save($datax, $id);

                //send mail to customer
                $email = $this->parameter_m->get(2);
                $email = $email->value;
                $company = $this->parameter_m->get(1);
                $company = $company->value;
                $data_email = array(
                    'username' => $user['username'],
                    'sitename' => $company,
                    'imgurl' => base_url() . 'images/logo-default.png',
                    'idorder' => $datao->idorder,
                    'nama_pembayaran' => $datao->nama_pembayaran,
                    'jumlah_pembayaran' => number_format($datao->jumlah_pembayaran, 0, ',', '.'),
                    'tanggal_bayar' => date('d-m-Y', strtotime($datao->tanggal_bayar)),
                    'waktu_bayar' => $datao->waktu_bayar,
                    'nama_bank' => $datao->nama_bank,
                    'nama_rek_bayar' => $datao->nama_rek_bayar,
                    'no_rek_bayar' => $datao->no_rek_bayar,
                    'keterangan' => $this->input->post('keterangan'),
                );
                $this->sistem_m->send_mail($data_email, $email, $user['email'], 'email_konfirmasi_tolak_html', 'Penolakan Konfirmasi Pembayaran Order No : #' . $datao->idorder);


                $notification = "Penolakan sudah terkirim</br>";
                $this->session->set_flashdata('notification', $notification);


                redirect($this->uri->uri_string(), 'refresh');
            }

            // Load view
            $sub_data['memberid'] = $data['jmember']->memberid;
            $data['body'] = $this->load->view('_konfirm_tolak', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }
    function batal($id)
    {
        if ($this->CI_auth->check_logged() === FALSE || $id == '')
            redirect(base_url() . 'login/');

        else {

            $data['title'] = 'Penolakan / Pembatalan Konfirmasi Pembayaran';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));


            $datao = $this->konfirm_m->get($id);

            $user = $this->member_data->get_member($datao->user_userid);
            $data_user =  array(
                'idpembayaran' => $id,
                'username' => $user['username'],
                'idorder' => $datao->idorder,
                'nama_pembayaran' => $datao->nama_pembayaran,
                'jumlah_pembayaran' => number_format($datao->jumlah_pembayaran, 0, ',', '.'),
                'tanggal_bayar' => date('d-m-Y', strtotime($datao->tanggal_bayar)),
                'waktu_bayar' => $datao->waktu_bayar,
                'nama_bank' => $datao->nama_bank,
                'nama_rek_bayar' => $datao->nama_rek_bayar,
                'no_rek_bayar' => $datao->no_rek_bayar,
                'status_bayar' => $datao->status_bayar,
                'keterangan' => $datao->keterangan,
            );

            $sub_data['users'] =  $data_user;


            $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim|min_length[8]');


            // Process the form
            if ($this->form_validation->run() == TRUE) {
                $datax = array(
                    'status_bayar' => '3',
                    'keterangan' => $this->input->post('keterangan'),
                );
                $this->konfirm_m->save($datax, $id);

                //send mail to customer
                $email = $this->parameter_m->get(2);
                $email = $email->value;
                $company = $this->parameter_m->get(1);
                $company = $company->value;
                $data_email = array(
                    'username' => $user['username'],
                    'sitename' => $company,
                    'imgurl' => base_url() . 'images/logo-default.png',
                    'idorder' => $datao->idorder,
                    'nama_pembayaran' => $datao->nama_pembayaran,
                    'jumlah_pembayaran' => number_format($datao->jumlah_pembayaran, 0, ',', '.'),
                    'tanggal_bayar' => date('d-m-Y', strtotime($datao->tanggal_bayar)),
                    'waktu_bayar' => $datao->waktu_bayar,
                    'nama_bank' => $datao->nama_bank,
                    'nama_rek_bayar' => $datao->nama_rek_bayar,
                    'no_rek_bayar' => $datao->no_rek_bayar,
                    'keterangan' => $this->input->post('keterangan'),
                );
                $this->sistem_m->send_mail($data_email, $email, $user['email'], 'email_konfirmasi_tolak_html', 'Penolakan / Pembatalan Konfirmasi Pembayaran Order No : #' . $datao->idorder);


                $notification = "Penolakan / Pembatalan sudah terkirim</br>";
                $this->session->set_flashdata('notification', $notification);


                redirect($this->uri->uri_string(), 'refresh');
            }

            // Load view
            $sub_data['memberid'] = $data['jmember']->memberid;
            $data['body'] = $this->load->view('_konfirm_tolak', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }
}