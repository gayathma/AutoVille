<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subscribe_seller extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('seller_subscribers/seller_subscribers_model');
        $this->load->model('seller_subscribers/seller_subscribers_service');
    }

}
