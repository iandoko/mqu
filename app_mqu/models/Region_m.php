<?php
class Region_m extends CI_Model
{
    protected $_table_prop = 'directory_propinsi';
    protected $_table_city = 'directory_kota';
    protected $_key_prop = 'region_id';
    protected $_key_city = 'city_id';
    public function __construct()
    {
        $this->load->database();
        //$this->load->helper(array('html','url','form'));
    }
    public $rules = array();

    public function getProp()
    {
        $query = $this->db->get_where($this->_table_prop, array('country_id' => 'ID'));
        return $query->result_array();
    }

    public function getCityByProp($prop = 0)
    {
            if ($prop == 0) {
                $this->db->from($this->_table_city);
                $query = $this->db->get();
                return $query->result_array();
            }
            $this->db->order_by('default_name');
            $query = $this->db->get_where($this->_table_city, array($this->_key_prop => $prop ));
            return $query->result_array();
    }
}