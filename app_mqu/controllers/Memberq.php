<?php
class Memberq extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation', 'session'));
        $this->load->model(array('CI_captcha', 'CI_menu', 'CI_encrypts', 'Member_data', 'User_m', 'Parameter_m','sistem_m'));
        $this->load->helper(array('form', 'url'));
        $this->load->helper('security');
        $this->load->database();
    }

    function index()
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');
        else {

            $data['title'] = 'Group Mqu';
            $data['username'] = $this->session->userdata('logged_username');
            $data['userid'] = $this->session->userdata('logged_user');
            $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));
            $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
            $data['menu_top'] = $this->CI_menu->menu_top();


            $sub_data['proses'] = $this->Member_data->get_cek_user($this->session->userdata('logged_user'));

            //search_params
            if($this->input->post('submit') == 'cari') {
                $this->session->set_userdata('kategori_s', $this->input->get_post('kategori_s', TRUE));
                $this->session->set_userdata('keywords', $this->input->get_post('keywords', TRUE));
                $cat = $this->session->userdata('kategori_s');
                $keywords = $this->session->userdata('keywords');
            } else {

                if ($this->session->userdata('kategori_s')) {
                    $cat = $this->session->userdata('kategori_s');
                    $keywords = $this->session->userdata('keywords');
                } else {
                    $cat = '';
                    $keywords = '';
                }
            }

            $sub_data['cat'] = $cat;
            $sub_data['keywords'] = $keywords;

            //pagination
            if ($cat !='') {
                if ($cat == 'area') {
                    if ($keywords != '') {
                        $this->db->like('nama_prop', $keywords);
                        $this->db->or_like('nama_kota', $keywords);
                    }
                } else {
                    if ($keywords != '') {
                        $this->db->like($cat, $keywords);
                    }
                }
            }
            //echo $cat. ' '.$keywords;
            //print_r($this->session->userdata());
            $count = $this->db->count_all_results('group_list');
            $sub_data['count'] = $count;

            $dataperpage = $this->parameter_m->get(20);
            $perpage = $dataperpage->value;

            $page_data = $this->sistem_m->pagination($count,$perpage,$this->uri->segment(1) . '/');
            $sub_data['pagination'] = $page_data['pagination'];

           //display search
            if ($cat !='') {
               if ($cat == 'area') {
                   if ($keywords != '') {
                       $this->db->like('nama_prop', $keywords);
                       $this->db->or_like('nama_kota', $keywords);
                   }
               } else {
                   if ($keywords != '') {
                       $this->db->like($cat, $keywords);
                   }
               }
            }
            //echo $cat. ' '.$keywords;
            $this->db->order_by('nama_group','DESC');
            $this->db->limit($perpage, $page_data['offset']);
            $sub_data['members'] = $this->Member_data->get_memberQ();

            //var_dump( $this->db );
            $data['body'] = $this->load->view('_group_list', $sub_data, true);

            $this->load->view('_output_html', $data);

        }
    }

    function group_new()
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');
        else {

            $data['title'] = 'GroupQ';
            $data['username'] = $this->session->userdata('logged_username');
            $data['userid'] = $this->session->userdata('logged_user');
            $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));
            $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
            $data['menu_top'] = $this->CI_menu->menu_top();

            $sub_data['sk'] = $this->Parameter_m->get(5);
            if ($this->input->post('submit')) {
                $this->form_validation->set_message('required', 'Persetujuan Syarat dan Ketentuan harus dicek');
                $this->form_validation->set_rules('agree', 'Syarat dan Ketentuan', 'required');
                $this->form_validation->set_rules('group', 'Group ', 'callback_validate_group');

                if ($this->form_validation->run() == FALSE) {
                    $data['body'] = $this->load->view('_group_insert', $sub_data, true);
                } else {
                    $count = $this->db->count_all_results('groupq');
                    $groupname = 'GQ-A2'.str_pad(($count + 1), 5, '0', STR_PAD_LEFT);
                    $input_data = array(
                        'nama_group' => $groupname,
                        'leader' => $this->session->userdata('logged_user'),
                        'tgl_create' => date('Y-m-d'),
                        'status' => '1'
                    );
                    if ($this->db->insert('groupq',$input_data)) {
                        $groupid = $this->db->insert_id();
                        $input_data = array(
                            'idgroup' => $groupid,
                            'user_userid' => $this->session->userdata('logged_user'),
                            'status' => '1',
                        );
                        $this->db->insert('group_member',$input_data);
                        $query = $this->db->get_where('groupq',array('idgroup'=>$groupid));
                        $group_data = $query->row_array();

                        $notification = "GroupQ anda dengan nama <strong>".$group_data['nama_group']." </strong>sudah berhasil dibuat, silahkan undang anggota lain untuk bergabung</br>";
                    } else {
                        $notification = "GroupQ tidak berhasil dibuat, silahkan ulangi kembali</br>";
                    }

                    $this->session->set_flashdata('notification', $notification);
                    redirect($this->uri->uri_string(), 'refresh');
                }

            } else {
                $data['body'] = $this->load->view('_group_insert', $sub_data, true);
            }
            $this->load->view('_output_html', $data);

        }
    }

    function group_reg($id)
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');
        else {
            if(!$id) redirect(base_url() . 'memberq/');

            $data['title'] = 'GroupQ';
            $data['username'] = $this->session->userdata('logged_username');
            $data['userid'] = $this->session->userdata('logged_user');
            $data['user'] = $this->Member_data->get_member($this->session->userdata('logged_user'));
            $data['jmember'] = $this->User_m->get($this->session->userdata('logged_user'));
            $data['menu_top'] = $this->CI_menu->menu_top();
            $sub_data['groupid'] = $id;
            $query = $this->db->get_where('group_list', array('idgroup'=>$id));
            if(!$query->num_rows()) redirect(base_url() . 'memberq/');
            $sub_data['detail'] = $this->Member_data->get_memberQ();
            $sub_data['sk'] = $this->Parameter_m->get(6);
            if ($this->input->post('submit')) {
                $this->form_validation->set_message('required', 'Persetujuan Syarat dan Ketentuan harus dicek');
                $this->form_validation->set_rules('agree', 'Syarat dan Ketentuan', 'required');
                $this->form_validation->set_rules('group_exist', 'Exist ', 'callback_validate_group_exist');
                $this->form_validation->set_rules('group_available', 'Available ', 'callback_validate_group_available');
                $this->form_validation->set_rules('group', 'Group ', 'callback_validate_group');

                if ($this->form_validation->run() == FALSE) {
                    $data['body'] = $this->load->view('_group_join', $sub_data, true);
                } else {
                        $groupid = $id;
                      //  $input_data = array(
                     //       'idgroup' => $groupid,
                      //      'user_userid' => $this->session->userdata('logged_user'),
                     //   );
                    //  if ($this->db->insert('group_member',$input_data)) {
                       $query = $this->db->get_where('groupq',array('idgroup'=>$groupid));
                        $group_data = $query->row_array();

                    $user = $this->Member_data->get_member($this->session->userdata('logged_user'));
                    $email = $this->Parameter_m->get(2);
                    $email = $email->value;
                    $company = $this->Parameter_m->get(1);
                    $company = $company->value;
                    $to_mail = $this->Member_data->get_member($group_data['leader']);

                    $data_email = array (
                        'memberID' => $user['username'],
                        'nama_lengkap' => $user['nama_lengkap'],
                        'alamat' => $user['alamat'].' '.$user['kabupaten_kota']. ' '.$user['propinsi'],
                        'email' => $user['email'],
                        'no_handphone' => $user['no_handphone'],
                        'group' => $group_data['nama_group'],
                        'sitename' => $company,
                        'imgurl' => base_url().'images/logo-default.png',
                        'approval' => base_url().'memberq/approval/'.$user['userid'].'/'.$groupid.'/'.sha1(trim($user['email']))
                    );
                  // if(
                    $this->sistem_m->send_mail($data_email,$email,$to_mail['email'],'email_approval_html','Request Gabung Group '.$group_data['nama_group']);
                    $data = array(
                        'status' => 0,
                        'idgroup' => $groupid,
                        'user_userid' => $user['userid']
                    );
                    $this->db->insert('group_member', $data);
                //) {
                       $notification = "Request gabung anda sudah diteruskan untuk approval GroupQ <strong>".$group_data['nama_group']." </strong>, silahkan tunggu email selanjutnya</br>";
                  // }
                   // else {
                    //   $notification = "Registrasi anda ke GroupQ tidak berhasil, silahkan ulangi kembali</br>";
                   // }

                    $this->session->set_flashdata('notification', $notification);
                    redirect($this->uri->uri_string(), 'refresh');
                }

            } else {
                $data['body'] = $this->load->view('_group_join', $sub_data, true);
            }
            $this->load->view('_output_html', $data);
        }
    }

    public function approval($id,$group,$hash)
    {
        $data['title'] = 'Aktifasi Member';
        if (!$hash || !$id ) {
            $data['body']  = 'Kode tidak dikenal';
        } else {
            $data['body']  = $this->User_m->approval($id,$group,$hash);
        }

        $this->load->view('_output_reg_html', $data);

    }

    public function validate_group()
    {
            $query = $this->db->get_where('group_cekuser',array('user_userid'=>$this->session->userdata('logged_user'), 'status' => '1'));

        if($query->num_rows()) {
            $this->form_validation->set_message('validate_group', "Anda sudah terdaftar dalam group aktif!");
            return false;
        } else {
            $query = $this->db->get_where('group_cekuser',array('user_userid'=>$this->session->userdata('logged_user'), 'status' => '0'));
            if($query->num_rows()) {
                $this->form_validation->set_message('validate_group', "Anda dalam proses request approval join");
                return false;
            } else {
                return true;
            }
        }
    }

    public function validate_group_exist()
    {
        $query = $this->db->get_where('group_cekuser',array('idgroup'=>$this->input->post('groupid'), 'status' => '1'));

        if(!$query->num_rows()) {
            $this->form_validation->set_message('validate_group_exist', "Group tidak terdaftar!");
            return false;

        } else {
          return true;

        }
    }
    public function validate_group_available()
    {
        $query = $this->db->get_where('group_count',array('idgroup'=>$this->input->post('groupid')));
        $data = $query->row();

        if($data->jumlah == 7) {
            $this->form_validation->set_message('validate_group_available', "Group sudah penuh!");
            return false;
        } else {
            return true;
        }
    }


}