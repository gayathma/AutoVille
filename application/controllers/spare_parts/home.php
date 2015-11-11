<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('spare_parts_cat/spare_parts_cat_service');
        $this->load->model('spare_parts_advertisement/spare_parts_ad_service');
    }

    function index() {

        $spare_part_ad_service = new Spare_parts_ad_service();
        $spare_parts_cat_service = new Spare_parts_cat_service();

        $data['categories'] = $spare_parts_cat_service->get_all_active_categories();
        $data['featured_spare_parts'] = $spare_part_ad_service->get_featured_vehicles(4); //Ashani
        $data['manufactures'] = $spare_part_ad_service->get_manufactures();
        $data['new_arrivals'] = $spare_part_ad_service->get_new_arrival(4); //Ashani

        $parials = array('content' => 'spare_part/content_pages/home_content');
        $this->template->load('template/spare_part_template', $parials, $data);
    }

}
