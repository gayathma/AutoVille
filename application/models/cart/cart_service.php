<?php

class Cart_service extends CI_Model{
    
    function __construct() {
        parent::__construct();
        
        $this->load->model('cart/cart_model');
    }
    
    function add_to_cart($cart_model) {
        return $this->db->insert('cart', $cart_model);
    }
}

