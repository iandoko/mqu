<?php
class home extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model(array('CI_auth', 'CI_menu'));
    }

    function index()

    {
        $data = array(
            'menu_top' => $this->CI_menu->menu_top(),
        );
        $this->load->view('home', $data);
    }

}

/* End of file home.php */

/* Location: ./system/application/controllers/home.php */
