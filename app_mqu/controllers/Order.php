<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model(array( 'member_data','jmember_m','user_m','pakettr_m','parameter_m','parameter_data','sistem_m','jbayar_m'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('CI_auth', 'CI_menu'));
        $this->load->helper(array('html','form', 'url'));
    }

    public function index ()
    {
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');

        else {

            $data['title'] = 'List Order';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));
            // Fetch all datas





            if ($data['jmember']->memberid == 1) {
                $count = $this->db->count_all_results('vtransaksi_paket');
                $sub_data['count'] = $count;

                $dataperpage = $this->parameter_m->get(20);
                $perpage = $dataperpage->value;
                $page_data = $this->sistem_m->pagination($count,$perpage,$this->uri->segment(1) . '/');
                $sub_data['pagination'] = $page_data['pagination'];

                $this->db->order_by('idtransaksi_paket','DESC');
                $this->db->limit($perpage, $page_data['offset']);
                $sub_data['datas'] = $this->pakettr_m->get();
            } else {
                $this->db->where('user_userid',$this->session->userdata('logged_user'));
                $count = $this->db->count_all_results('vtransaksi_paket');
                $sub_data['count'] = $count;

                $dataperpage = $this->parameter_m->get(20);
                $perpage = $dataperpage->value;
                $page_data = $this->sistem_m->pagination($count,$perpage,$this->uri->segment(1) . '/');
                $sub_data['pagination'] = $page_data['pagination'];

                $this->db->order_by('idtransaksi_paket','DESC');
                $this->db->limit($perpage, $page_data['offset']);
                $sub_data['datas'] = $this->pakettr_m->get_where_many('user_userid',$this->session->userdata('logged_user'));

            }
            // Load view
            $data['body'] = $this->load->view('_order_list', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }

    public function paket ()
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');

        else {
            $sub_data['sk'] = $this->parameter_m->get(11);
            $dd = $this->parameter_m->get(13);
            $dd = $dd->value;
            $mm = $this->parameter_m->get(14);
            $mm = $mm->value;
            $yyyy = $this->parameter_m->get(15);
            $yyyy = $yyyy->value;
            $rules = $this->pakettr_m->rules;
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_rules('agree', 'Syarat dan Ketentuan', 'required');
           // $this->form_validation->set_message('agree', 'Persetujuan Syarat dan Ketentuan harus dicek');
            $this->form_validation->set_rules('order_pending', 'Pending ', 'callback_validate_order_pending');


            // Process the form
            if ($this->form_validation->run() == TRUE) {
                $cicilan = $this->jbayar_m->get($this->input->post('jenis_pembayaran'));
                $order = $this->parameter_data->paket_list($this->input->post('paket_paketid'));
                $month = $cicilan->pembagi;

                $hdate = $yyyy.'-'.$mm.'-'.$dd;

                if ($month == 1) {
                    $bdate = strtotime(date('Y-m-d'));
                    $edate = strtotime($hdate);
                    //age - 1 months
                    $month = ((date('Y',$edate) - date('Y',$bdate)) * 12) + (date('m',$edate) - date('m',$bdate)) - 1;
                    $est_tgl_pelunasan_order = date('Y-m-d', strtotime("-30 days", strtotime($hdate)));
                } else {
                    $month = 1;
                    $est_tgl_pelunasan_order = date('Y-m-d', strtotime("+14 days", strtotime(date('Y-m-d'))));
                }

                $days_dp = $this->parameter_m->get(19);
                $days_dp = intval($days_dp->value);
                $est_tgl_pelunasan_um = date('Y-m-d', strtotime("+" . $days_dp." days", strtotime(date('Y-m-d'))));

                $delivery_date = date('Y-m-d', strtotime( $this->input->post('tgl_kirim')." days", strtotime($hdate)));

                $um = $this->input->post('uang_muka');

                $harga_sisa = $this->roundUpTo(($order->harga - ($um*$order->harga)) / $month,10);

                $data = array(
                    'jenis_pembayaran' => $this->input->post('jenis_pembayaran'),
                   'created_time' => date('Y-m-d H:i:s'),
                    'tgl_kirim' => $this->input->post('tgl_kirim'),
                    'paketid' => $this->input->post('paket_paketid'),
                    'user_userid' => $this->session->userdata('logged_user'),
                    'jumlah_cicilan'=> $month,
                    'uang_muka' => floatval($um),
                    'est_tgl_pengiriman' => $delivery_date,
                    'est_tgl_pelunasan_um' => $est_tgl_pelunasan_um,
                    'est_tgl_pelunasan_order' => $est_tgl_pelunasan_order,

                    'harga_cicilan' => floatval($harga_sisa),
                    'status' => '0',

                );


                $this->pakettr_m->save($data);
                $id = $this->db->insert_id();

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
                    'idtransaksi_paket' => $id,
                    'sitename' => $company,
                    'imgurl' => base_url().'images/logo-default.png'
                );

                $this->sistem_m->create_invoice_order_paket($jenis_member,$iduser,$email,$user['email'],$data_email);
                $notification = "Order Anda sudah terproses silahkan cek email anda untuk melakukan pembayaran";

                $this->session->set_flashdata('pesan', $notification);
                redirect(base_url() .'order');

            }

            // Load the view
            $data['title'] = 'Order Paket';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));

            $sub_data['hday'] = $dd.'-'.$mm.'-'.$yyyy;
            $this->db->where('idjenis_pembayaran != 5');
            $sub_data['jbayars'] = $this->jbayar_m->get();
            $this->db->where('memberid != 1');
            $sub_data['jmembers'] = $this->jmember_m->get();
            $sub_data['datas'] = $this->pakettr_m->get_new();
            // Load view
            $data['body'] = $this->load->view('_order_paket', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }

    public function paket_group ()
    {
        if ($this->CI_auth->check_logged() === FALSE)
            redirect(base_url() . 'login/');

        else {
            $dd = $this->parameter_m->get(13);
            $dd = $dd->value;
            $mm = $this->parameter_m->get(14);
            $mm = $mm->value;
            $yyyy = $this->parameter_m->get(15);
            $yyyy = $yyyy->value;
            $sub_data['hday'] = $dd.'-'.$mm.'-'.$yyyy;
            $rules = $this->pakettr_m->rules;
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_rules('leader', 'Leader', 'callback_validate_leader');
            $this->form_validation->set_rules('member', 'Member', 'callback_validate_group_member');



            // Process the form
            if ($this->form_validation->run() == TRUE) {
                $order = $this->parameter_data->paket_list($this->input->post('paket_paketid'));
                $cicilan = $this->jbayar_m->get($this->input->post('jenis_pembayaran'));
                $month = $cicilan->pembagi;

                $hdate = $yyyy.'-'.$mm.'-'.$dd;

                if ($month == 1) {
                    $bdate = strtotime(date('Y-m-d'));
                    $edate = strtotime($hdate);
                    //age - 1 months
                    $month = ((date('Y',$edate) - date('Y',$bdate)) * 12) + (date('m',$edate) - date('m',$bdate)) - 1;
                    $est_tgl_pelunasan_order = date('Y-m-d', strtotime("-30 days", strtotime($hdate)));
                } else {
                    $month = 1;
                    $est_tgl_pelunasan_order = date('Y-m-d', strtotime("+14 days", strtotime(date('Y-m-d'))));
                }

                $days_dp = $this->parameter_m->get(19);
                $days_dp = intval($days_dp->value);
                $est_tgl_pelunasan_um = date('Y-m-d', strtotime("+" . $days_dp." days", strtotime(date('Y-m-d'))));

                $delivery_date = date('Y-m-d', strtotime( $this->input->post('tgl_kirim')." days", strtotime($hdate)));

                $um = floatval($this->input->post('uang_muka'));

                $userid = $this->session->userdata('logged_user');
                $query_g= $this->db->get_where('group_cekuser',array('user_userid'=>$userid, 'status' => '1'));
                $group = $query_g->row();
                $groupid = $group->idgroup;

                $query_member = $this->db->get_where('group_cekuser',array('idgroup'=>$groupid, 'status' => '1'));
                $member_datas = $query_member->result_array();

                //loop member


                foreach ($member_datas as $data) {
                    $data = array(
                        'jenis_pembayaran' => $this->input->post('jenis_pembayaran'),
                        'created_time' => date('Y-m-d H:i:s'),
                        'tgl_kirim' => $this->input->post('tgl_kirim'),
                        'paketid' => $this->input->post('paket_paketid'),
                        'user_userid' => $data['user_userid'],
                        'jumlah_cicilan' => $month,
                        'uang_muka' => $um,
                        'est_tgl_pengiriman' => $delivery_date,
                        'est_tgl_pelunasan_um' => $est_tgl_pelunasan_um,
                        'est_tgl_pelunasan_order' => $est_tgl_pelunasan_order,
                        'harga_cicilan' => $this->roundUpTo(($order->harga_group - ($um * $order->harga_group)) / $month,10),
                        'status' => '0',
                        'idgroup' => $groupid,
                    );

                    $this->pakettr_m->save($data);
                    $id = $this->db->insert_id();

                    $user = $this->member_data->get_member($data['user_userid']);
                    $jenis_member = $user['memberid'];
                    $iduser = $user['userid'];
                    $email = $this->parameter_m->get(2);
                    $email = $email->value;
                    $company = $this->parameter_m->get(1);
                    $company = $company->value;
                    $data_email = array(
                        'nama_lengkap' => $user['nama_lengkap'],
                        'username' => $user['username'],
                        'member' => ucwords($user['nama_member']),
                        'idtransaksi_paket' => $id,
                        'sitename' => $company,
                        'imgurl' => base_url() . 'images/logo-default.png'
                    );

                    $this->sistem_m->create_invoice_order_paket($jenis_member, $iduser, $email, $user['email'], $data_email);

                }

                $notification = "Order GroupQ Anda sudah terproses silahkan cek email masing-masing anggota anda untuk melakukan pembayaran";
                $this->session->set_flashdata('pesan', $notification);
                redirect(base_url() .'order');

            }

            // Load the view
            $data['title'] = 'Order Paket Group';
            $data['username'] = $this->session->userdata('logged_username');
            $data['user'] = $this->member_data->get_member($this->session->userdata('logged_user'));
            $data['userid'] = $this->session->userdata('logged_user');
            $data['jmember'] = $this->user_m->get($this->session->userdata('logged_user'));
            $this->db->where('idjenis_pembayaran != 5');
            $sub_data['jbayars'] = $this->jbayar_m->get();
            $this->db->where('memberid != 1');
            $sub_data['jmembers'] = $this->jmember_m->get();
            $sub_data['datas'] = $this->pakettr_m->get_new();
            $sub_data['sk'] = $this->parameter_m->get(11);
            $sub_data['hday'] = $dd.'-'.$mm.'-'.$yyyy;
            // Load view
            $data['body'] = $this->load->view('_order_paket_group', $sub_data, true);
            $this->load->view('_output_html', $data);
        }
    }

    public function hapus ($id)
    {
        if($this->CI_auth->check_logged()===FALSE)
            redirect(base_url().'login/');

        else {
            $this->paketr_m->delete($id);
            redirect('order');
        }
    }

    public function validate_leader ()
    {
        $userid = $this->session->userdata('logged_user');
        $query = $this->db->get_where('group_list',array('leader'=>$userid, 'status' => '1'));

        if(!$query->num_rows()) {
            $this->form_validation->set_message('validate_leader', "Anda bukan leader atau group anda sudah tidak aktif!");
            return false;
        } else {
            return true;
        }
    }

    public function validate_group_member()
    {
        $userid = $this->session->userdata('logged_user');
        $query_g= $this->db->get_where('group_cekuser',array('user_userid'=>$userid, 'status' => '1'));
        $group = $query_g->row();
        if ($query_g->num_rows() > 0) {
            $groupid = $group->idgroup;
        } else {
            $groupid = 0;
        }
        $jumlah = 0;
       if ($groupid != 0) {

           $query = $this->db->get_where('group_count', array('idgroup' => $groupid));
           $data = $query->row();
           $jumlah = $data->jumlah;
       }

        $max_group = $this->parameter_m->get(7);

        if($jumlah != $max_group->value) {
            $this->form_validation->set_message('validate_group_member', "Jumlah anggota group minimum atau maksimum = ".$max_group->value);
            return false;
        } else {
            return true;
        }
    }

    public function roundUpTo($number, $increments) {
        $increments = 1 / $increments;
        return (ceil($number * $increments) / $increments);
    }

    public function validate_order_pending()
    {
        $query = $this->db->get_where('vtransaksi_paket',array('user_userid'=>$this->session->userdata('logged_user'), 'status' => '1'));

        if($query->num_rows()>0) {
            $this->form_validation->set_message('validate_order_pending', "Anda tidak dapat melakukan order karena ada transaksi yang belum selesai!");
            return false;

        } else {
            return true;

        }
    }
}