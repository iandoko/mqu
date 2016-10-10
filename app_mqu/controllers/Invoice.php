<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('member_data', 'jmember_m', 'user_m', 'pakettr_m', 'parameter_m', 'parameter_data', 'invoice_m', 'konfirm_m', 'sistem_m'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('CI_auth', 'CI_menu'));
        $this->load->helper(array('html', 'form', 'url'));
    }

    public function index()
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');

        else {

            $data['title'] = 'List Invoice';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));
            // Fetch all datas


            if ($data['jmember']->memberid == 1) {
                $count = $this->db->count_all_results('vinvoice');
                $sub_data['count'] = $count;

                $dataperpage = $this->parameter_m->get(20);
                $perpage = $dataperpage->value;
                $page_data = $this->sistem_m->pagination($count, $perpage, $this->uri->segment(1) . '/');
                $sub_data['pagination'] = $page_data['pagination'];

                $this->db->order_by('idinvoice', 'DESC');
                $this->db->limit($perpage, $page_data['offset']);

                $sub_data['datas'] = $this->invoice_m->get();

            } else {
                $this->db->where('user_userid', $this->session->userdata('logged_user'));
                $count = $this->db->count_all_results('vinvoice');
                //$count = $query->num_rows();
                $sub_data['count'] = $count;

                $dataperpage = $this->parameter_m->get(20);
                $perpage = $dataperpage->value;
                $page_data = $this->sistem_m->pagination($count, $perpage, $this->uri->segment(1) . '/');
                $sub_data['pagination'] = $page_data['pagination'];

                $this->db->order_by('idinvoice', 'DESC');
                $this->db->limit($perpage, $page_data['offset']);
                $sub_data['datas'] = $this->invoice_m->get_where_many('user_userid', $this->session->userdata('logged_user'));

            }
            // Load view
            $sub_data['memberid'] = $data['jmember']->memberid;
            $data['body'] = $this->load->view('_invoice_list', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }

    public function detail($id)
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');

        else {

            $sub_data['datas'] = $this->invoice_m->get_where_many('idinvoice', $id);

            // Load the view
            $data['title'] = 'Invoice ' . $sub_data['datas'][0]['no_invoice'];
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));

            $this->db->where('memberid != 1');
            $sub_data['jmembers'] = $this->jmember_m->get();


            $idtr_paket = $sub_data['datas'][0]['idtransaksi_paket'];
            $sub_data['order'] = $this->pakettr_m->get($idtr_paket);

            $bank = $this->parameter_m->get(8);
            $sub_data['bank'] = $bank->value;

            $bank_acc_name = $this->parameter_m->get(10);
            $sub_data['bank_acc_name'] = $bank_acc_name->value;

            $bank_acc_no = $this->parameter_m->get(9);
            $sub_data['bank_acc_no'] = $bank_acc_no->value;

            $groupid = $sub_data['order']->idgroup;
            if ($groupid) {
                $sub_data['group'] = $this->member_data->get_memberQ($groupid);
            } else {
                $sub_data['group'] = '';
            }
            $sub_data['member'] = $this->member_data->get_member($this->session->userdata('logged_user'));

            // Load view
            $data['body'] = $this->load->view('_invoice_detail', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }

    function konfirm()
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');

        else {
            $data['title'] = 'Konfirmasi Pembayaran';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));

            $sub_data['datas'] = $this->konfirm_m->get_new();

            $this->db->where('status', '0');
            $this->db->where('user_userid', $this->session->userdata('logged_user'));
            $sub_data['orders'] = $this->pakettr_m->get();


            $rules = $this->konfirm_m->rules;
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_rules('waktu_bayar', 'Waktu Pembayaran', 'required|trim|min_length[8]|max_length[8]|callback_validate_time');
            $this->form_validation->set_rules('idorder', 'Order ', 'callback_validate_konfirm');

            // Process the form
            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'idorder' => $this->input->post('idorder'),
                    'nama_pembayaran' => $this->input->post('nama_pembayaran'),
                    'jumlah_pembayaran' => $this->input->post('jumlah_pembayaran'),
                    'nama_pembayaran' => $this->input->post('nama_pembayaran'),
                    'tanggal_bayar' => date('Y-m-d', strtotime($this->input->post('tanggal_bayar'))),
                    'waktu_bayar' => $this->input->post('waktu_bayar'),
                    'nama_bank' => $this->input->post('nama_bank'),
                    'nama_rek_bayar' => $this->input->post('nama_rek_bayar'),
                    'no_rek_bayar' => $this->input->post('no_rek_bayar'),
                    'status_bayar' => '0'
                );
                $this->konfirm_m->save($data);


                $notification = "Konfirmasi pembayaran sudah diterima, kami akan memproses lebih lanjut</br>";
                $this->session->set_flashdata('notification', $notification);

                //send mail to admin
                $email = $this->parameter_m->get(2);
                $email = $email->value;
                $company = $this->parameter_m->get(1);
                $company = $company->value;

                $user = $this->member_data->get_member($this->session->userdata('logged_user'));


                $data_email = array(
                    'nama_lengkap' => $this->input->post('nama_lengkap'),
                    'username' => $user['username'],
                    'sitename' => $company,
                    'imgurl' => base_url() . 'images/logo-default.png',
                    'idorder' =>  $this->input->post('idorder'),
                    'nama_pembayaran' => $this->input->post('nama_pembayaran'),
                    'jumlah_pembayaran' => number_format($this->input->post('jumlah_pembayaran'), 0, ',', '.'),
                    'nama_pembayaran' => $this->input->post('nama_pembayaran'),
                    'tanggal_bayar' => date('d-m-Y', strtotime($this->input->post('tanggal_bayar'))),
                    'waktu_bayar' => $this->input->post('waktu_bayar'),
                    'nama_bank' => $this->input->post('nama_bank'),
                    'nama_rek_bayar' => $this->input->post('nama_rek_bayar'),
                    'no_rek_bayar' => $this->input->post('no_rek_bayar'),
                );
                $this->sistem_m->send_mail($data_email, $email, $email, 'email_konfirmasi_html', 'Konfirmasi Pembayaran Order No : #' . $this->input->post('idorder'));


                redirect($this->uri->uri_string(), 'refresh');
            }

            // Load view
            $data['body'] = $this->load->view('_konfirm_bayar', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }

    public function validate_time()
    {
        $str = $this->input->post('waktu_bayar');
        if (strrchr($str, ":")) {
            list($hh, $mm, $ss) = explode(':', $str);
            if (!is_numeric($hh) || !is_numeric($mm) || !is_numeric($ss)) {
                $this->form_validation->set_message('validate_time', "Format waktu 24:59:59 (HH:mm:ss)");
                return FALSE;
            } elseif ((int)$hh > 24 || (int)$mm > 59 || (int)$ss > 59) {
                $this->form_validation->set_message('validate_time', "Format waktu 24:59:59 (HH:mm:ss)");
                return FALSE;
            } elseif (mktime((int)$hh, (int)$mm, (int)$ss) === FALSE) {
                $this->form_validation->set_message('validate_time', "Format waktu 24:59:59 (HH:mm:ss)");
                return FALSE;
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('validate_time', "Format waktu 24:59:59 (HH:mm:ss)");
            return FALSE;
        }
    }
    public function validate_konfirm()
    {
        $query = $this->db->get_where('vtransaksi_pembayaran',array('idorder'=>$this->input->post('idorder'), 'status_bayar' => '0', ));

        if($query->num_rows()>0) {
            $this->form_validation->set_message('validate_konfirm', "Konfirmasi sudah diajukan sebelumnya tunggu validasi dari kami via email");
            return false;

        } else {
            return true;

        }
    }
}