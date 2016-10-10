<?php
class Jmember_m extends CI_Model
{
    protected $_table_name = 'jenis_member';
    protected $_table_view = 'jenis_member';
    protected $_key = 'memberid';
    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array('html','url','form'));

    }
    public $rules = array(
        'nama_member' => array(
            'field' => 'nama_member',
            'label' => 'Nama member',
            'rules' => 'trim|required'
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


    public function get_new ()
    {
        $data = new stdClass();
        $data->nama_member = $this->input->post('nama_member');

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
            $this->db->where($this->_key, $id);
            $this->db->update($this->_table_name);
        }

    }

}