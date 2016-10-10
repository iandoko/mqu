<?php
class Member_data extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library(array('session'));
    }

    public function get_member($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->query('SELECT * FROM member_list');
            return $query->result_array();
        }

        $query = $this->db->get_where('member_list', array('userid' => $id));
        return $query->row_array();
    }
    public function get_group($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->query('SELECT * FROM group_cekuser');
            return $query->result_array();
        }

        $query = $this->db->get_where('group_cekuser', array('user_userid' => $id));
        return $query->row_array();
    }
    public function activate($id)
    {
        if ($id) {
            $nilai_poin = $this->get_poin_amount(1);
            $ref_uid = $this->get_ref_uid($id);
            $data = array(
                'status' => '1'
            );
            $this->db->where('userid', $id);


            if ($this->db->update('user', $data)) {
                if ($ref_uid > 0) {
                $input_data = array(
                    'jumlah' => intval($nilai_poin),
                    'user_userid' => intval($ref_uid),
                    'poin_idpoin' => '1'
                );
                $this->db->insert('transaksi_poin', $input_data);
            }
        }

            $result = "Aktifasi berhasil";


        } else {
            $result = "ID user tidak ditemukan";
        }

        return $result;
    }

    public function get_poin_amount($id) {
        $query = $this->db->query('SELECT * FROM poin WHERE idpoin ='.$id);
        $amount = $query->row();
        return $amount->jumlah_poin;
    }
    public function get_poin() {
        $query = $this->db->query('SELECT * FROM poin_list WHERE userid =' .$this->session->userdata('logged_user'));
        return $query->result_array();
    }
    public function get_profile($id) {
        $query = $this->db->query('SELECT COUNT(profileid) as jumlah FROM user_profile WHERE user_profile_uid ='.$id);
        $profile = $query->row();
        return $profile->jumlah;

    }
    public function get_ref_uid($id) {
        $query = $this->db->query('SELECT ref_uid FROM user WHERE userid ='.$id);
        $ref = $query->row();
        return $ref->ref_uid;
    }
    public function get_jenis_member() {
        $id = 1;
        $this->db->where('memberid >', $id);
        return $this->db->get('jenis_member')->result();
    }


    public function get_cek_user($id) {
        $this->db->where('user_userid', $id);
        return $this->db->get('group_cekuser')->result();
    }
    public function get_memberQ($id = 0)
    {
        if ($id === 0)
        {

            $this->db->from('group_list');

            $query = $this->db->get();
            return $query->result_array();
        }

        $query = $this->db->get_where('group_list', array('idgroup' => $id));
        return $query->row();
    }

    function count_memberQ($id = 0) {
        $query = $this->db->query('SELECT count(1) as jumlah FROM group_member WHERE idgroup ='.$id);
        $count = $query->row();
        return $count->jumlah;
    }

}