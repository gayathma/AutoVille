<?php

class Subscribers_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('subscribers/subscribers_model');
    }

    

}
