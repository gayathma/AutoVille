<?php

class Seller_subscribers_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('seller_subscribers/seller_subscribers_model');
    }

    /**
     * insert a new subscriber for seller
     * @param type $seller_subscribers_model
     * @return type
     */
    function insert_seller_subscriber($seller_subscribers_model) {
        return $this->db->insert('seller_subscribers', $seller_subscribers_model);
    }

    /**
     * delete subscribed seller details
     * @param type $id
     * @return type
     */
    function unsubscribe_seller($id) {

        $data = array(
            'is_deleted' => '1'
        );
        $this->db->where('id', $id);
        return $this->db->update('seller_subscribers', $data);
    }

    /**
     * get logged in user's subscribers to check whether user have subscribed the seller
     * @param type $user_id : logged user id
     * @param type $seller_id : seller id
     * @return type
     */
    function get_subscribed_seller($user_id, $seller_id) {

        $this->db->select('seller_subscribers.id,seller_subscribers.seller_id');
        $this->db->from('seller_subscribers');
        $this->db->where('seller_subscribers.added_by', $user_id);
        $this->db->where('seller_subscribers.seller_id', $seller_id);
        $this->db->where('seller_subscribers.is_deleted', '0');
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * get sellers all subscribers
     * @param type $seller_id : seller's id
     * @return type
     */
    function get_all_subscribers($seller_id) {

        $this->db->select('seller_subscribers.id,seller_subscribers.added_by,seller_subscribers.email,user.name as seller_name,user.title');
        $this->db->from('seller_subscribers');
        $this->db->where('seller_subscribers.seller_id', $seller_id);
        $this->db->join('user', 'user.id=seller_subscribers.seller_id');
        $this->db->where('seller_subscribers.is_deleted', '0');
        $query = $this->db->get();
        return $query->result();
    }

}
