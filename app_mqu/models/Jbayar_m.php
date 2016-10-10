<?php
class Jbayar_m extends CI_Model
{
    protected $_table_name = 'jenis_pembayaran';
    protected $_table_view = 'jenis_pembayaran';
    protected $_key = 'idjenis_pembayaran';
    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array('html','url','form'));

    }
    public $rules = array(
        'nama_pembayaran' => array(
            'field' => 'nama_pembayaran',
            'label' => 'Nama Pembayaran',
            'rules' => 'trim|required'
        ),
        'pembagi' => array(
            'field' => 'pembagi',
            'label' => 'Bulan Cicilan',
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
        $data->nama_pembayaran = $this->input->post('nama_pembayaran');
        $data->pembagi = $this->input->post('pembagi');

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
    public function delete ($id) {

        if (!$id) {
            return FALSE;
        }
        $this->db->where($this->_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);
    }
}