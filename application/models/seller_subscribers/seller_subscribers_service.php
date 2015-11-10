<?php

class Seller_subscribers_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('seller_subscribers/seller_subscribers_model');
    }

    function insert_seller_subscriber($seller_subscribers_model) {
        return $this->db->insert('seller_subscribers', $seller_subscribers_model);
    }

}
