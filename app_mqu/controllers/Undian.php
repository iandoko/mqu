<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Undian extends CI_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model(array('undian_m','member_data','jmember_m','user_m','undiantr_m','parameter_m','sistem_m'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('CI_auth', 'CI_menu'));
        $this->load->helper(array('html','form', 'url'));
    }

    public function index ()
    {
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');

        else {

            $data['title'] = 'Parameter Undian';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));
            // Fetch all datas
            $sub_data['datas'] = $this->undian_m->get();

            if ($data['jmember']->memberid > 1) {
                redirect(base_url().'login/');
            }
            // Load view
            $data['body'] = $this->load->view('_param_undian', $sub_data, true);
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
                $sub_data['datas'] = $this->undian_m->get($id);
                count($sub_data['datas']) || $sub_data['errors'][] = 'data tidak ada';
            } else {
                $sub_data['datas'] = $this->undian_m->get_new();
            }

            // Set up the form
            $rules = $this->undian_m->rules;
            $this->form_validation->set_rules($rules);


            // Process the form
            if ($this->form_validation->run() == TRUE) {
//jenis member tidak dipakai
                $data = array(
                    'nama_undian' => $this->input->post('nama_undian'),
                    'masa_keanggotaan' => $this->input->post('masa_keanggotaan'),
                    'paket_paketid' => $this->input->post('paket_paketid'),
                    'jenis_member_memberid' => 1,
                    'limit_perbulan' => $this->input->post('limit_perbulan'),
                     'min_user' => $this->input->post('min_user'),
                    'status' => $this->input->post('status')
                );


                $this->undian_m->save($data, $id);
                if ($id) {
                    redirect($this->uri->uri_string(), 'refresh');
                } else {
                    redirect('undian');
                }

            }

            // Load the view
            $data['title'] = 'Edit Parameter Undian';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));
            $this->db->where('memberid != 1');
            $sub_data['jmembers'] = $this->jmember_m->get();

            // Load view
            $data['body'] = $this->load->view('_param_undian_edit', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }

    public function hapus ($id)
    {
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');

        else {
            $this->undian_m->delete($id);
            redirect('undian');
        }
    }
    public function hasil ()
    {
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');

        else {
            $data['title'] = 'Hasil Undian';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));
            // Fetch all datas
            $sub_data['datas'] = $this->undiantr_m->get();

            if ($data['jmember']->memberid > 1) {
                redirect(base_url().'login/');
            }
            // Load view
            $data['body'] = $this->load->view('_undian_hasil', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }
    public function hasil_hapus ($id)
    {
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');

        else {
            $this->undiantr_m->delete($id);
            redirect('undian/hasil');
        }
    }
    public function mengundi ()
    {
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');

        else {
            $undi = $this->undiantr_m->undi();
            if ($undi->id > 0) {
               $pesan = 'Undian sudah dilakukan publish hasil dibawah untuk memberitahukan kepada anggota.';
            } else {
                $pesan = 'Undian tidak dilakukan karena sudah maksimum atau tidak ada anggota yang memenuhi kriteria';
            }
            $this->session->set_flashdata('pesan', $pesan);
            redirect('undian/hasil');
        }
    }
    public function hasil_publish($id = null) {
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');

        else {
            $data = array (
                'status' => '1'
            );
            $this->undiantr_m->save($data,$id);
            $data_undian = $this->undiantr_m->get($id);
            $user = $this->member_data->get_member($data_undian->user_userid);
            $email = $this->parameter_m->get(2);
            $email = $email->value;
            $company = $this->parameter_m->get(1);
            $company = $company->value;
            $pesan = 'Hasil undian sudah dipublikasikan.';

            $data_email = array (
                'nama_lengkap' => $user['nama_lengkap'],
                'username' => $user['username'],
                'member' => ucwords($user['nama_member']),
                'idtransaksi_undian' => $id,
                'nama_paket' => $data_undian->nama_paket,
                'sitename' => $company,
                'imgurl' => base_url().'images/logo-default.png'
            );
            $this->sistem_m->send_mail($data_email,$email,$user['email'],'email_infoundian_html','Anda Mendapatkan Undian '.$data_undian->nama_paket);

            $this->session->set_flashdata('pesan', $pesan);
            redirect('undian/hasil');
        }
    }
    public function klaim($id = null)
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');

        else {
            $proses = $this->undiantr_m->get($id);
            if ($proses->klaim <> 1) {

                $data = array(
                    'klaim' => '1'
                );
                $this->undiantr_m->save($data, $id);
                $pesan = 'Hasil undian berhasil diklaim.';

                //kirim email
                $paket = $this->undiantr_m->get($id);
                $user = $this->member_data->get_member($this->session->userdata('logged_user'));
                $jenis_member = $user['memberid'];
                $iduser = $user['userid'];
                $email = $this->parameter_m->get(2);
                $email = $email->value;
                $company = $this->parameter_m->get(1);
                $company = $company->value;
                $data_email = array (
                    'nama_lengkap' => $user['nama_lengkap'],
                    'username' => $user['username'],
                    'member' => ucwords($user['nama_member']),
                    'idtransaksi_undian' => $id,
                    'sitename' => $company,
                    'imgurl' => base_url().'images/logo-default.png'
                );
                $this->sistem_m->send_mail($data_email,$email,$user['email'],'email_klaimundian_html','Klaim Undian '.$paket->nama_paket);
                $this->sistem_m->create_invoice_klaim_undian($jenis_member,$iduser,$email,$user['email'],$data_email);

                redirect($this->uri->uri_string(), 'refresh');


                $this->session->set_flashdata('pesan', $pesan);
                redirect('undian/member');
            } else {
                $pesan = 'Hasil undian sudah diklaim. Cek email anda!';
                $this->session->set_flashdata('pesan', $pesan);
                redirect('undian/member');
            }
        }
    }
    public function member() {
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');

        else {

            $data['title'] = 'Hasil Undian Bulan Ini';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));
            // Fetch all datas
            $firstdate = date('Y-m-01');
                $lastdate = date('Y-m-01',strtotime('next month'));
            $this->db->where('status','1');
            $this->db->where("created_time BETWEEN '".$firstdate."' AND '".$lastdate."'");
            $sub_data['datas'] = $this->undiantr_m->get();
            $sub_data['userid'] = $this->session->userdata('logged_user');


            // Load view
            $data['body'] = $this->load->view('_undian_member', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }
}