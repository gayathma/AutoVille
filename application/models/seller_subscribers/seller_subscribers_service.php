<?php

class Seller_subscribers_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('seller_subscribers/seller_subscribers_model');
    }

}
