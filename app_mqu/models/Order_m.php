
<?php
class Order_m extends CI_Model
{
    protected $_table_name = 'order';
    protected $_table_view = 'vinvoice';
    protected $_key = 'idorder';
    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array('html','url','form'));

    }
    public $rules = array(
        'detail_order' => array(
            'field' => 'detail_order',
            'label' => 'Detail Order',
            'rules' => 'trim|required'
        ),
        'harga_order' => array(
            'field' => 'harga_order',
            'label' => 'Harga',
            'rules' => 'trim|required'
        ),
        'quantity' => array(
            'field' => 'quantity',
            'label' => 'Quantity',
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
        $data->detail_order = $this->input->post('detail_order');
        $data->harga_order = $this->input->post('harga_order');
        $data->quantity = $this->input->post('quantity');
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