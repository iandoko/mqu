<?php

class Kota extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('region_m'));
        $this->load->helper(array('html','url','form'));
    }

    function index(){
        $city_id = intval($this->input->post('kabupaten_kota',TRUE));
        $region_id = intval($this->input->post('propinsi',TRUE));
        $kota = $this->region_m->getCityByProp($region_id);
        $output = null;
     foreach ($kota as $row)
    {
        if($city_id == $row['city_id']) {
            $output .= '<option value="'.$row['city_id'].'" selected="selected">'.$row["default_name"].'</option>';
        } else {
            $output .= '<option value="'.$row['city_id'].'">'.$row["default_name"].'</option>';
        }

     }
    echo $output;
    }

}