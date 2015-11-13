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
        $this->db->select('cart.*,spare_parts_advertisements.name as spare_name,spare_parts_advertisements.price as spare_price');
        $this->db->from('cart');
        $this->db->join('spare_parts_advertisements','spare_parts_advertisements.added_by=cart.user_id','left');
        $this->db->where('cart.user_id',$uer_id);
        $query=  $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }
}

