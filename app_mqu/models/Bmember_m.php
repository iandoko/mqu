<?php
class Bmember_m extends CI_Model
{
    protected $_table_name = 'biaya_keanggotaan';
    protected $_table_view = 'vbiaya_anggota';
    protected $_key = 'idbiaya';
    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array('html','url','form'));

    }
    public $rules = array(
        'nama_biaya' => array(
            'field' => 'nama_biaya',
            'label' => 'Nama Biaya',
            'rules' => 'trim|required'
        ),
        'jumlah_biaya' => array(
            'field' => 'jumlah_biaya',
            'label' => 'Jumlah Biaya',
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
        $data->nama_biaya = $this->input->post('nama_biaya');
        $data->jumlah_biaya = $this->input->post('jumlah_biaya');
        $data->jenis_memberid = $this->input->post('jenis_memberid');
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