<?php

class Cart_service extends CI_Model {

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
    function get_cart_items_by_id($uer_id) {
        $this->db->select('cart.*,spare_parts_advertisements.name as spare_name,spare_parts_advertisements.price as spare_price,count(cart.id) as qty');
        $this->db->from('cart');
        $this->db->join('spare_parts_advertisements', 'spare_parts_advertisements.id=cart.spare_part_id', 'left');
        $this->db->where('cart.user_id', $uer_id);
        $this->db->group_by('cart.spare_part_id');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * get the cart item count by pasing the item id as a parameter
     * @param object $cart_model Input model
     * @return object
     */
    function get_cart_items_count_by_id($uer_id) {
        $this->db->select('cart.id');
        $this->db->from('cart');
        $this->db->where('cart.user_id', $uer_id);

        return $this->db->count_all_results();
    }

    function delete_item($id) {
        return $this->db->delete('cart', array('id' => $id));
    }

}

