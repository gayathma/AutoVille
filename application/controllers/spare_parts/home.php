<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('spare_parts_cat/spare_parts_cat_service');
        $this->load->model('spare_parts_advertisement/spare_parts_ad_service');
        
        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');
    }

    /**
     * spare part home page
     */
    function index() {

        $spare_part_ad_service = new Spare_parts_ad_service();
        $spare_parts_cat_service = new Spare_parts_cat_service();
        $vehicle_advertisments_service = new Vehicle_advertisments_service();

        $data['categories'] = $spare_parts_cat_service->get_all_active_categories();
        $data['featured_spare_parts'] = $spare_part_ad_service->get_featured_spare_parts(4); //Ashani
        $data['manufactures'] = $spare_part_ad_service->get_manufactures();
        $data['new_arrivals'] = $spare_part_ad_service->get_new_arrival(4); //Ashani
        $data['latest_vehicles']      = $vehicle_advertisments_service->get_new_arrival(2);  //author-Ishani

        $parials = array('content' => 'spare_part/content_pages/home_content', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/spare_part_template', $parials, $data);
    }

}
