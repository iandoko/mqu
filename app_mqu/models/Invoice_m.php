<?php
class Invoice_m extends CI_Model
{
    protected $_table_name = 'invoice';
    protected $_table_view = 'vinvoice';
    protected $_key = 'idinvoice';
    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array('html','url','form'));

    }
    public $rules = array(
        'no_invoice' => array(
            'field' => 'no_invoice',
            'label' => 'Nomor Invoice',
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
    public function get_where_many($column, $search)
    {
        $query = $this->db->get_where($this->_table_view, array($column => $search));
        return $query->result_array();
    }

    public function get_new ()
    {
        $data = new stdClass();
        $data->no_invoice = $this->input->post('no_invoice');
        $data->status = $this->input->post('status');
        $data->userid = $this->input->post('userid');
        $data->no_invoice = $this->input->post('no_invoice');
        $data->jenis_pembayaran = $this->input->post('jenis_pembayaran');
        $data->bulan_tabungan = $this->input->post('tahun_tabungan');

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