<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Daftar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('profile_m', 'user_m', 'member_data','jmember_m','sistem_m','parameter_m','region_m'));
        $this->load->library(array('session', 'form_validation','encrypt'));
        $this->load->model(array('CI_auth', 'CI_menu', 'CI_encrypts'));
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->helper('security');
    }

    public function index($refid ='')
    {
        $data['title'] = 'Form Pendaftaran Keanggotaan';

        $sub_data['datas_usr'] = $this->user_m->get_new();
        $sub_data['datas'] = $this->profile_m->get_new();

        $propinsi = $this->region_m->getProp();

        $output = null;
        $outputCity = null;
        foreach ($propinsi as $row) {
            //$output .= "<option value='".$row['region_id']."'>".$row['default_name']."</option>";
            if(intval($this->input->post('propinsi')) == $row['region_id']) {
                $output .= '<option value="'.$row['region_id'].'" selected="selected">'.$row["default_name"].'</option>';
                $kota = $this->region_m->getCityByProp(intval($this->input->post('propinsi')));

                foreach ($kota as $row)
                {
                    if(intval($this->input->post('kabupaten_kota')) == $row['city_id']) {
                        $outputCity .= '<option value="'.$row['city_id'].'" selected="selected">'.$row["default_name"].'</option>';
                    } else {
                        $outputCity .= '<option value="'.$row['city_id'].'">'.$row["default_name"].'</option>';
                    }

                }
            } else {
                $output .= '<option value="'.$row['region_id'].'">'.$row["default_name"].'</option>';
            }
        }
        $sub_data['prop'] = $output;
        $sub_data['kota'] = $outputCity;


        $rules = $this->profile_m->rules;
        $this->form_validation->set_rules($rules);

        $rules_usr = $this->user_m->rules;
        $this->form_validation->set_rules($rules_usr);


        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $this->form_validation->set_rules('email', 'Email ', 'callback_validate_email');
            $this->form_validation->set_rules('pas_foto', 'Foto ', 'callback_validate_image');
            if ($this->form_validation->run() == TRUE) {
                $count = $this->db->count_all_results('user');
                $username = 'MQA1'.str_pad(($count + 1), 5, '0', STR_PAD_LEFT);

                $rand_salt = $this->CI_encrypts->genRndSalt();
                $encrypt_pass = $this->CI_encrypts->encryptUserPwd($this->input->post('password'), $rand_salt);
                $key = 'mQuappskey';
                $user_data = array(
                    'username' => $username,
                    'email' => $this->input->post('email'),
                    'password' => $encrypt_pass,
                    'status' => '0',
                    'jenis_member_memberid' => $this->input->post('jenis_member_memberid'),
                    'salt' => $rand_salt,
                    'ref_uid' => intval($this->encrypt->decode(base64_decode($refid), $key))
                );
                $this->user_m->save($user_data);
                $iduser = $this->db->insert_id();


                $config['upload_path'] = './images/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '100';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';
                $config['file_name'] = base64_encode(time() . $iduser);
                $config['overwrite'] = TRUE; //overwrite user avatar
                $config['encrypt_name'] = TRUE;


                $this->load->library('upload');
                $this->upload->initialize($config);
                $nm_file = '';
                if ($_FILES['pas_foto']['error'] !== 4) {
                    if ($this->upload->do_upload('pas_foto')) {
                        $photo_upload = $this->upload->data();
                        $nm_file = $photo_upload['file_name'];

                    }
                }
                $data = array(
                    'nama_lengkap' => $this->input->post('nama_lengkap'),
                    'nomor_ktp' => $this->input->post('nomor_ktp'),
                    //'tempat_lahir' => $this->input->post('tempat_lahir'),
                    //'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir'))),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'alamat' => $this->input->post('alamat'),

                   // 'desa_kelurahan' => $this->input->post('desa_kelurahan'),
                   // 'kecamatan' => $this->input->post('kecamatan'),
                    'kabupaten_kota' => $this->input->post('kabupaten_kota'),
                    'propinsi' => $this->input->post('propinsi'),
                    'kodepos' => $this->input->post('kodepos'),
                    'no_handphone' => $this->input->post('no_handphone'),
                    'nama_perusahaan' => $this->input->post('nama_perusahaan'),
                    'pekerjaan' => $this->input->post('pekerjaan'),
                    'user_profile_uid' => $iduser,
                    'pas_foto' => $nm_file

                );
                $this->profile_m->save($data);
                $profileid = $this->db->insert_id();
                $data_up = array(
                    'user_profile_profileid' => $profileid
                );
                $this->user_m->save($data_up, $iduser);


                $notification = "Registrasi anda sudah berhasil, silahkan tunggu konfirmasi melalui email untuk aktifasi</br>";
                $this->session->set_flashdata('notification', $notification);

                $jenis_member = $this->jmember_m->get($this->input->post('jenis_member_memberid'));
                $email = $this->parameter_m->get(2);
                $email = $email->value;
                $company = $this->parameter_m->get(1);
                $company = $company->value;


                $data_email = array (
                    'nama_lengkap' => $this->input->post('nama_lengkap'),
                    'username' => $username,
                    'password' => $this->input->post('password'),
                    'member' => ucwords($jenis_member->nama_member),
                    'sitename' => $company,
                    'imgurl' => base_url().'images/logo-default.png',
                    'aktivasi' => base_url().'daftar/activate/'.$iduser.'/'.sha1(trim($this->input->post('email')))
                );
                $this->sistem_m->send_mail($data_email,$email,$this->input->post('email'),'email_pendaftaran_html','Detail Keanggotaan '.$company);
                //$this->sistem_m->create_invoice_pendaftaran($this->input->post('jenis_member_memberid'),$iduser,$email,$this->input->post('email'),$data_email);

                redirect($this->uri->uri_string(), 'refresh');
            }
        }

        // Load view
        $data['body'] = $this->load->view('_member_register', $sub_data, true);
        $this->load->view('_output_reg_html', $data);
    }


    public function validate_image()
    {
        if (isset($_FILES['pas_foto']) && !empty($_FILES['pas_foto']['name'])) {
            $config['upload_path'] = './images/profile/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $config['overwrite'] = TRUE; //overwrite user avatar
            $config['encrypt_name'] = TRUE;
            // set a $_POST value for 'image' that we can use later
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('pas_foto')) {

                return true;

            } else {
                // possibly do some clean up ... then throw an error
                $this->form_validation->set_message('validate_image', $this->upload->display_errors());
                return false;
            }
        } else {
            // throw an error because nothing was uploaded
           // $this->form_validation->set_message('validate_image', "Photo harus anda upload!");
            //return false;
            return true;
        }
    }
    public function validate_email()
    {
        if($this->user_m->get_email($this->input->post('email')) > 0) {
            $this->form_validation->set_message('validate_email', "Email sudah terdaftar!");
            return false;
        } else {
            return true;
        }
    }

    function activate($id=null,$hash=null){

            $data['title'] = 'Aktifasi Member';
            if (!$hash || !$id ) {
                $data['body']  = 'User dan Kode salah';
            } else {
                $data['body']  = $this->user_m->self_activate($id,$hash);
            }
            // Load view
           // $data['body'] = $this->load->view('_member_register', $sub_data, true);
            $this->load->view('_output_reg_html', $data);
    }
}