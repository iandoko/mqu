<?php

class Member extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation','session'));
        $this->load->model(array('CI_auth', 'CI_menu','Member_data','User_m','region_m'));
        $this->load->helper(array('html','url','form'));
        $this->load->helper('security');
    }

    function index(){
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');
        else{
            $data['title'] = 'Daftar Member';
            $data['menu_top'] = $this->CI_menu->menu_top();
            $sub_data['members'] = $this->Member_data->get_member();
            $data['body']  = $this->load->view('_member_list', $sub_data, true);
            $data['username'] = $this->session->userdata('logged_username');
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
            $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));
            $this->load->view('_output_html', $data);

        }
    }
    function aktifasi($id){
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');
        else{
            $data['title'] = 'Aktifasi Member';
            $data['menu_top'] = $this->CI_menu->menu_top();
            $data['body']  = $this->Member_data->activate($id);
            $data['username'] = $this->session->userdata('logged_username');
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
            $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));
            $this->load->view('_output_html', $data);

        }
    }
    function poin(){
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');
        else{
            $data['title'] = 'Poin Member';
            $data['menu_top'] = $this->CI_menu->menu_top();
            $sub_data['members'] = $this->Member_data->get_poin();
            $data['body']  = $this->load->view('_member_poin', $sub_data, true);
            $data['username'] = $this->session->userdata('logged_username');
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
            $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));
            $this->load->view('_output_html', $data);

        }
    }
    function detail($id){
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');
        else{

            $data['title'] = 'Profile Member';
            $data['menu_top'] = $this->CI_menu->menu_top();
            if ($this->Member_data->get_profile($id) == '0') {
                $data['body'] = $this->load->view('_member_insert', $id, true);
            }
            else {
                $sub_data['group'] = $this->Member_data->get_group($id);
               $sub_data['members'] = $this->Member_data->get_member($id);
               $data['body'] = $this->load->view('_member_detail', $sub_data, true);
            }
            $data['username'] = $this->session->userdata('logged_username');
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
            $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));

            $this->load->view('_output_html', $data);

        }
    }
    function edit_profile($id){
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');
        else{
            $config['upload_path'] = './images/profile/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $config['file_name'] = base64_encode('mquuserfoto'.$id);
            $config['overwrite'] = TRUE; //overwrite user avatar
            $config['encrypt_name'] = TRUE;


            $this->load->library('upload', $config);

            $sub_data['id'] = $id;
            $member = $this->Member_data->get_member($id);
            $propinsi = $this->region_m->getProp();

            $output = null;
            $outputCity = null;

            if ($this->input->post('propinsi')) {
                $dataprop = intval($this->input->post('propinsi'));
            } else {
                $dataprop = $member['propinsi'];
            }
            if ($this->input->post('kabupaten_kota')) {
                $datakota = intval($this->input->post('kabupaten_kota'));
            } else {
                $datakota = $member['kabupaten_kota'];
            }




            foreach ($propinsi as $row) {
                //$output .= "<option value='".$row['region_id']."'>".$row['default_name']."</option>";
                if($dataprop == $row['region_id']) {
                    $output .= '<option value="'.$row['region_id'].'" selected="selected">'.$row["default_name"].'</option>';
                    $kota = $this->region_m->getCityByProp($dataprop);

                    foreach ($kota as $row)
                    {
                        if($datakota == $row['city_id']) {
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
            if($this->input->post('update')) {
                $this->form_validation->set_rules('nama_lengkap', 'Nama lengkap', 'trim|required|min_length[3]|max_length[100]|xss_clean');


                if ($this->form_validation->run() == FALSE){
                                      //update form on err
                    $sub_data['nama_lengkap'] = $this->input->post('nama_lengkap');
                    $sub_data['nomor_ktp'] = $this->input->post('nomor_ktp');

                   // $sub_data['tempat_lahir'] = $this->input->post('tempat_lahir');
                   // $sub_data['tanggal_lahir'] = $this->input->post('tanggal_lahir');

                    $sub_data['alamat'] = $this->input->post('alamat');
                   // $sub_data['no'] = $this->input->post('no');
                    //$sub_data['rt'] = $this->input->post('rt');
                   // $sub_data['rw'] = $this->input->post('rw');
                    $sub_data['pekerjaan'] = $this->input->post('pekerjaan');
                    $sub_data['nama_perusahaan'] = $this->input->post('nama_perusahaan');
                    $sub_data['kabupaten_kota'] = $this->input->post('kabupaten_kota');
                    $sub_data['propinsi'] = $this->input->post('propinsi');
                    $sub_data['kodepos'] = $this->input->post('kodepos');
                    $sub_data['no_handphone'] = $this->input->post('no_handphone');

                    $sub_data['pas_foto'] = $this->input->post('pas_foto');
                    $sub_data['user_profile_uid'] = $this->input->post('user_profile_uid');
                    $sub_data['members'] = $this->Member_data->get_member($this->input->post('user_profile_uid'));
                    $data['body'] = $this->load->view('_member_detail_update_err', $sub_data, true);

                } else {
                    if ($_FILES['pas_foto']['error'] !== 4) {
                        if ($this->upload->do_upload('pas_foto')) {
                            $photo_upload = $this->upload->data();
                            $nm_file = $photo_upload['file_name'];
                            $notification_upload = '';

                            //update query
                            $data = array(
                                'nama_lengkap' => $this->input->post('nama_lengkap'),
                                'nomor_ktp' => $this->input->post('nomor_ktp'),

                                //'tempat_lahir' => $this->input->post('tempat_lahir'),
                                //'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir'))),

                                'alamat' => $this->input->post('alamat'),
                                'pekerjaan' => $this->input->post('pekerjaan'),
                                'nama_perusahaan' => $this->input->post('nama_perusahaan'),


                                'kabupaten_kota' => $this->input->post('kabupaten_kota'),
                                'propinsi' => $this->input->post('propinsi'),
                                'kodepos' => $this->input->post('kodepos'),
                                'no_handphone' => $this->input->post('no_handphone'),

                                'pas_foto' => $nm_file
                            );

                            $this->db->where('user_profile_uid', $this->input->post('user_profile_uid'));
                            if ($this->db->update('user_profile', $data)) {
                                $notification_upload = "Data berhasil diupdate </br>" . $notification_upload;
                                $this->session->set_flashdata('notification', $notification_upload);
                                redirect($this->uri->uri_string(), 'refresh');
                            } else {
                                $notification_upload = "Error data update";
                                $this->session->set_flashdata('notification', $notification_upload);
                                redirect($this->uri->uri_string(), 'refresh');
                            }

                        } else {
                            $notification_upload = "Data tidak diupdate </br>" . $this->upload->display_errors();
                            $this->session->set_flashdata('notification', $notification_upload);
                            redirect($this->uri->uri_string(), 'refresh');
                        }

                    } else  {
                        $notification_upload = '';
                        //update query
                        $data = array(
                            'nama_lengkap' => $this->input->post('nama_lengkap'),
                            'nomor_ktp' => $this->input->post('nomor_ktp'),

                            //'tempat_lahir' => $this->input->post('tempat_lahir'),
                            //'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir'))),

                            'alamat' => $this->input->post('alamat'),
                            'pekerjaan' => $this->input->post('pekerjaan'),
                            'nama_perusahaan' => $this->input->post('nama_perusahaan'),


                            'kabupaten_kota' => $this->input->post('kabupaten_kota'),
                            'propinsi' => $this->input->post('propinsi'),
                            'kodepos' => $this->input->post('kodepos'),
                            'no_handphone' => $this->input->post('no_handphone'),

                        );

                        $this->db->where('user_profile_uid', $this->input->post('user_profile_uid'));
                        if ($this->db->update('user_profile', $data)) {
                            $notification_upload = "Data berhasil diupdate </br>" . $notification_upload;
                            $this->session->set_flashdata('notification', $notification_upload);
                            redirect($this->uri->uri_string(), 'refresh');
                        } else {
                            $notification_upload = "Error data update";
                            $this->session->set_flashdata('notification', $notification_upload);
                            redirect($this->uri->uri_string(), 'refresh');
                        }
                    }

                    $sub_data['members'] = $this->Member_data->get_member($id);
                    $data['body'] = $this->load->view('_member_detail_update', $sub_data, true);

                }

            } else {

                if ($this->Member_data->get_profile($id) == '0') {
                    //insert form
                    $data['body'] = $this->load->view('_member_insert', $id, true);
                } else {
                    //update form
                    $sub_data['members'] = $this->Member_data->get_member($id);
                    $data['body'] = $this->load->view('_member_detail_update', $sub_data, true);
                }

            }

            $data['title'] = 'Profile Member';
            $data['menu_top'] = $this->CI_menu->menu_top();

            $data['username'] = $this->session->userdata('logged_username');
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
            $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));


            $this->load->view('_output_html', $data);
        }
    }


}