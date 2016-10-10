<?php
class User_m extends CI_Model
{
    protected $_table_name = 'user';
    protected $_table_view = 'member_list';
    protected $_key = 'userid';
    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array('html','url','form'));

    }
    public $rules = array(
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|min_length[3]|max_length[60]|valid_email'
        ),

        'password' => array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[3]|max_length[20]|matches[passconf]|xss_clean'
        ),
        'passconf' => array(
            'field' => 'passconf',
            'label' => 'Konfirmasi Password',
            'rules' => 'trim|required|min_length[3]|max_length[20]|xss_clean'
        ),
        'jenis_member_memberid' => array(
            'field' => 'jenis_member_memberid',
            'label' => 'Jenis Keanggotaan',
            'rules' => 'required'
        ),

    );
    public function get($id = 0)
    {
        if ($id === 0)
        {

            $this->db->from($this->_table_view);

            $query = $this->db->get();
            return $query->result_array();
        }

        $query = $this->db->get_where($this->_table_view, array($this->_key => $id));
        return $query->row();
    }

    public function get_email($string)
    {
        $query = $this->db->get_where($this->_table_name, array('email' => $string));

        return $query->num_rows();
    }
    public function get_user($id)
    {
        $query = $this->db->get_where($this->_table_name, array('userid' => $id));
        return $query->row();
    }

    public function get_new ()
    {
        $data = new stdClass();
        $data->email = $this->input->post('email');
        $data->password = $this->input->post('password');
        $data->passconf = $this->input->post('passconf');
        $data->jenis_member_memberid = 2;
        return $data;
    }

    public function save($data,$id = NULL){

        // Insert
        if ($id === NULL) {
            !isset($this->_key) || $this->_key = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
        }
        // Update
        else {
            $this->db->set($data);
            $this->db->where('userid', $id);
            $this->db->update($this->_table_name);
        }

    }
    public function self_activate($id,$hash)
    {
        if ($id) {
            if($hash) {
                $user = $this->get($id);
                $salt = sha1(trim($user->email));
               // $salt = substr_replace($salt,'=',20,1); //local

                if ($hash == $salt) {
                    $data = array(
                        'status' => '1'
                    );
                    $this->db->update('user', $data);
                    $result = "Aktifasi berhasil.";
                    $result .=' Klik link berikut untuk <a href="'.base_url().'">Login</a>';
                } else {
                   // $result = "Kode Aktifasi salah ".$salt;  //local
                    $result = "Kode Aktifasi salah";
                }

            } else {
                $result = "Kode Aktifasi salah";
            }
        } else {
            $result = "ID user tidak ditemukan";
        }

        return $result;
    }

    public function approval($id,$group,$hash)
    {
        if ($id && $group) {

            $user = $this->get($id);
            $salt = sha1(trim($user->email));
            $salt = substr_replace($salt,'=',20,1); //local
            //echo $salt;
            if ($hash == $salt) {
                $data = array(
                    'status' => 1
                );
                $this->db->where('user_userid',$id);
                $this->db->where('idgroup',$group);
                $this->db->update('group_member', $data);

                $result = "Approval berhasil.";
                $result .=' Klik link berikut untuk <a href="'.base_url().'">Login</a>';
            } else {
                $result = "Kode Approval salah";
            }

        } else {
            $result = "Kode Approval tidak sesuai";
        }

        return $result;
    }
}