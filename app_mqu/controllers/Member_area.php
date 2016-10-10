<?php

class Member_area extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model(array('CI_auth', 'CI_menu', 'Member_data','User_m'));
        $this->load->helper(array('html','url'));
        $this->load->library('encrypt');
    }

    function index(){
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');
        else{
            $key = 'mQuappskey';
            $data['title'] = 'Selamat Datang';
            $data['menu_top'] = $this->CI_menu->menu_top();
            $refidencode = base64_encode($this->encrypt->encode($this->session->userdata('logged_user'),$key));

            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));
            $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));


            $data['userid'] = $this->session->userdata('logged_user');
            $this->db->where('status','1');
           // $data_klaim = $this->undiantr_m->get_where('user_userid', $this->session->userdata('logged_user'));

           $text_klaim = '';
           // if ($data_klaim) {
          //  if ($data_klaim->klaim <> 1) {
           //     $text_klaim = 'Selamat Anda mendapatkan Undian Paket <strong>'.$data_klaim->nama_paket. '</strong> GRATIS!. Klik link berikut untuk klaim <a href="'.base_url().'undian/klaim/'.$data_klaim->idtransaksi_undian.'">Buka Link </a>';

          //  }}
            $sub_data['text'] = 'Anda login dalam halaman MEMBER <br/> <br/> <a href="'.base_url().'login/logout/"> Klik Disini </a> untuk logout';
            $data['body'] = $this->load->view('_member_home',$sub_data, true);
           // $data['body'] = 'Anda login dalam halaman MEMBER <br/> <br/> <a href="'.base_url().'login/logout/"> Klik Disini </a> untuk logout';
            //    '<br><br> Link Rekomendasi Pendaftaran Anggota Untuk Mendapatkan Poin Atas Nama Anda : <a href="'.base_url().'daftar/'.$refidencode.'">Buka Link </a>'.
          // '<br><br>'.$text_klaim ;
            $this->load->view('_output_html', $data);

        }
    }
}