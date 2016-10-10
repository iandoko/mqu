<?php
class Pakettr_m extends CI_Model
{
    protected $_table_name = 'transaksi_paket';
    protected $_table_view = 'vtransaksi_paket';
    protected $_key = 'idtransaksi_paket';
    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array('html','url','form'));

    }
    public $rules = array(
        'paketid' => array(
            'field' => 'paket_paketid',
            'label' => 'Paket',
            'rules' => 'trim|required'
        ),
        'jenis_pembayaran' => array(
            'field' => 'jenis_pembayaran',
            'label' => 'Pembayaran',
            'rules' => 'trim|required'
        ),
        'tgl_kirim' => array(
            'field' => 'tgl_kirim',
            'label' => 'Tanggal Pengiriman',
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

        $query = $this->db->get_where($this->_table_view, array('idtransaksi_paket' => $id));
        return $query->row();
    }
    public function get_where($column, $search)
    {
        $query = $this->db->get_where($this->_table_view, array($column => $search));
        $this->db->order_by('idtransaksi_paket','desc');
        return $query->row();
    }
    public function get_where_many($column, $search)
    {
        $query = $this->db->get_where($this->_table_view, array($column => $search));
        $this->db->order_by('idtransaksi_paket','desc');
        return $query->result_array();
    }

  public function get_new ()
    {
       $data = new stdClass();
        $data->jenis_pembayaran = $this->input->post('jenis_pembayaran');
        $data->paketid = $this->input->post('paket_paketid');
        $data->nama_paket = $this->input->post('nama_paket');
        $data->uang_muka = $this->input->post('uang_muka');
        $data->tgl_kirim = $this->input->post('tgl_kirim');
        return $data;
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

}