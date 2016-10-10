<?php
class Konfirm_m extends CI_Model
{
    protected $_table_name = 'transaksi_pembayaran';
    protected $_table_view = 'vtransaksi_pembayaran';
    protected $_table_view_order = 'vtransaksi_paket';
    protected $_key = 'idpembayaran';
    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array('html','url','form'));

    }
    public $rules = array(
        'idorder' => array(
            'field' => 'idorder',
            'label' => 'Nomor Order',
            'rules' => 'trim|required'
        ),
        'jumlah_pembayaran' => array(
            'field' => 'jumlah_pembayaran',
            'label' => 'Jumlah Pembayaran',
            'rules' => 'trim|required'
        ),
        'tanggal_bayar' => array(
            'field' => 'tanggal_bayar',
            'label' => 'Tanggal Pembayaran',
            'rules' => 'trim|required'
        ),
        'nama_rek_bayar' => array(
            'field' => 'nama_rek_bayar',
            'label' => 'Nama rekening pembayar',
            'rules' => 'trim|required'
        ),
        'no_rek_bayar' => array(
            'field' => 'no_rek_bayar',
            'label' => 'Nomer rekening pembayar',
            'rules' => 'trim|required'
        ),
        'nama_bank' => array(
            'field' => 'nama_bank',
            'label' => 'Bank pembayar',
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

        $this->db->where($this->_key, $id);
        $this->db->from($this->_table_view);
        $query = $this->db->get();
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
        $data->idorder = $this->input->post('idorder');
        $data->jumlah_pembayaran = $this->input->post('jumlah_pembayaran');
        $data->nama_pembayaran = $this->input->post('nama_pembayaran');
        $data->tanggal_bayar = $this->input->post('tanggal_bayar');
        $data->no_rek_bayar = $this->input->post('no_rek_bayar');
        $data->nama_bank = $this->input->post('nama_bank');
        //$data->status_bayar = $this->input->post('status_bayar');
        $data->waktu_bayar = $this->input->post('waktu_bayar');
        $data->nama_rek_bayar = $this->input->post('nama_rek_bayar');

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