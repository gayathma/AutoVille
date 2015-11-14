<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class category extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('USER_LOGGED_IN')) {
            redirect(site_url() . '/login/load_login');
        } else {
            $this->load->model('spare_parts_cat/spare_parts_cat_model');
            $this->load->model('spare_parts_cat/spare_parts_cat_service');

            $this->load->model('cart/cart_model');
            $this->load->model('cart/cart_service');
        }
    }

    public function load_categories() {
        $category_service = new category_service();
        $data['names']    = $category_service->get_category_name();
        echo $this->load->view('manufacturers/manufacture_list_view', $data);
    }

}
