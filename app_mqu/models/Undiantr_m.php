<?php
class Undiantr_m extends CI_Model
{
    protected $_table_name = 'transaksi_undian';
    protected $_table_view = 'vtransaksi_undian';
    protected $_key = 'idtransaksi_undian';
    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array('html','url','form'));

    }
    public $rules = array(
       /* 'nama_undian' => array(
            'field' => 'nama_undian',
            'label' => 'Nama Undian',
            'rules' => 'trim|required'
        ),*/



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
    public function get_where($column, $search)
    {
        $query = $this->db->get_where($this->_table_view, array($column => $search));
        return $query->row();
    }

    public function get_new ()
    {
      /*  $data = new stdClass();
        $data->nama_undian = $this->input->post('nama_undian');
        $data->masa_keanggotaan = $this->input->post('masa_keanggotaan');
        $data->paket_paketid = $this->input->post('paket_paketid');
        $data->limit_perbulan = $this->input->post('limit_perbulan');
        $data->min_user = $this->input->post('min_user');
        $data->status = 1;
        return $data;*/
    }

    public function save($data,$id = NULL)
    {

        // Insert
        if ($id === NULL) {
            !isset($this->_key) || $this->_key = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
        } // Update
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
    public function undi ()
    {
        $this->db->query('CALL alter_tmpundian()');
        $query = $this->db->query('CALL create_undian()');
        return $query->row();
    }

}