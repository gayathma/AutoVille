<?php

class Cart_service extends CI_Model{
    
    function __construct() {
        parent::__construct();
        
        $this->load->model('cart/cart_model');
    }
    
    function add_to_cart($cart_model) {
        return $this->db->insert('cart', $cart_model);
    }
    
    /**
     * get the cart details by pasing the item id as a parameter
     * @param object $cart_model Input model
     * @return object
     */
//    function get_cart_items_by_id($cart_model) {
//        $query = $this->db->get_where('cart', array('user_id' => $cart_model->get_user_id()));
//        return $query->row();
//    }
    function get_cart_items_by_id($uer_id) {
        $this->db->select('cart.*');
        $this->db->from('cart');
        $this->db->where('cart.user_id',$uer_id);
        $query=  $this->db->get();
        return $query->result();
    }
}

