<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');
    }

    /**
     * load content of contact us page
     */
    function contact_us() {
        $data['']                      = '';
        $vehicle_advertisments_service = new Vehicle_advertisments_service();
        $data['latest_vehicles']       = $vehicle_advertisments_service->get_new_arrival(2);

        $parials = array('content' => 'content_pages/contact_us', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * load content of how to buy page
     */
    function how_to_buy() {
        $vehicle_advertisments_service = new Vehicle_advertisments_service();

        $data['']                = '';
        $data['latest_vehicles'] = $vehicle_advertisments_service->get_new_arrival(2);  //author-Ishani

        $parials = array('content' => 'content_pages/how_to_buy_view', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * load content of site map page
     */
    function site_map() {
        $vehicle_advertisments_service = new Vehicle_advertisments_service();

        $data['']                = '';
        $data['latest_vehicles'] = $vehicle_advertisments_service->get_new_arrival(2);  //author-Ishani

        $parials = array('content' => 'content_pages/site_map_view', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

}
