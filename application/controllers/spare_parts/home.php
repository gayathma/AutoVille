<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();

    }
    
    function index() {

        $parials = array('content' => 'spare_part/content_pages/home_content');
        $this->template->load('template/spare_part_template', $parials);
    }

}
