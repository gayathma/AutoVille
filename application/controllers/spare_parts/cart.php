<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->model('cart/cart_model');
        $this->load->model('cart/cart_service');
    }
    
    
    function add_items_to_cart() {

        $cart_model = new Cart_model();
        $cart_service = new Cart_service();

        $cart_model->set_user_id($this->session->userdata('USER_ID'));
        $cart_model->set_spare_part_id($this->input->post('id', TRUE));
        $cart_model->set_added_date(date("Y-m-d H:i:s"));

        echo $cart_service->add_to_cart($cart_model);

//        if ($msg == 1) {
//            $this->load_vehicle_popup();
//        } else {
//            echo 0;
//        }
    }
}