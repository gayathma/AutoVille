<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');

        $this->load->model('searched_vehicles/searched_vehicles_model');
        $this->load->model('searched_vehicles/searched_vehicles_service');

        $this->load->model('vehicle_images/vehicle_images_model');
        $this->load->model('vehicle_images/vehicle_images_service');

        $this->load->model('bookmarked_vehicles/bookmarked_vehicles_service');

        $this->load->library('pagination');
        $this->load->library('pagination_custome');
    }

    /**
     * load all dashboard content
     * @param string $start Input starting value
     */
    function index($start = "0") {

        $vehicle_advertisements_service = new Vehicle_advertisments_service();

        $config = array();

        $config["base_url"]    = site_url() . "/dashboard/load_my_advertisements/";
        $config["per_page"]    = 8;
        $config["uri_segment"] = 3;
        $config["num_links"]   = 4;
        $config["total_rows"]  = count($vehicle_advertisements_service->get_advertisements_for_user('', '', $this->session->userdata('USER_ID')));

        $this->pagination_custome->initialize($config);

        $data['my_advertisements'] = $vehicle_advertisements_service->get_advertisements_for_user($config["per_page"], $start, $this->session->userdata('USER_ID'));
        $data["links"]             = $this->pagination_custome->create_links();
        $data['latest_vehicles']   = $vehicle_advertisements_service->get_new_arrival(2);


        $parials = array('content' => 'my_dashboard/my_dashboard', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * 
     * load all advertisements for a user
     * @param string $start Input starting value
     */
    function load_my_advertisements($start = "0") {
        $vehicle_advertisements_service = new Vehicle_advertisments_service();

        $config = array();

        $config["base_url"]    = site_url() . "/dashboard/load_my_advertisements/";
        $config["per_page"]    = 8;
        $config["uri_segment"] = 3;
        $config["num_links"]   = 4;
        $config["total_rows"]  = count($vehicle_advertisements_service->get_advertisements_for_user('', '', $this->session->userdata('USER_ID')));

        $this->pagination_custome->initialize($config);

        $data['my_advertisements'] = $vehicle_advertisements_service->get_advertisements_for_user($config["per_page"], $start, $this->session->userdata('USER_ID'));
        $data["links"]             = $this->pagination_custome->create_links();

        echo $this->load->view('my_dashboard/my_advertisements', $data);
    }

    /**
     * 
     * load all saved searches for a user
     * @param string $start Input starting value
     */
    function load_saved_searches($start = "0") {


        $searched_vehicles_service = new Searched_vehicles_service();


        $config = array();

        $config["base_url"]    = site_url() . "/dashboard/load_saved_searches/";
        $config["per_page"]    = 8;
        $config["uri_segment"] = 3;
        $config["num_links"]   = 4;
        $config["total_rows"]  = count($searched_vehicles_service->get_searched_vehicles_for_user('', '', $this->session->userdata('USER_ID')));

        $this->pagination_custome->initialize($config);

        $data['my_advertisements'] = $searched_vehicles_service->get_searched_vehicles_for_user($config["per_page"], $start, $this->session->userdata('USER_ID'));
        $data["links"]             = $this->pagination_custome->create_links();

        echo $this->load->view('my_dashboard/saved_searches', $data);
    }

    /**
     * delete saved searches
     */
    function delete_saved_search() {

        $searched_vehicles_service = new Searched_vehicles_service();

        echo $searched_vehicles_service->delete_serached_record(trim($this->input->post('id', TRUE)));
    }

    /**
     * 
     * load all bookmarked vehicles for a user
     * @param string $start Input starting value
     */
    function load_bookmarked_vehicles($start = "0") {

        $bookmarked_vehicles_service = new Bookmarked_vehicles_service();

        $config = array();

        $config["base_url"]    = site_url() . "/dashboard/load_bookmarked_vehicles/";
        $config["per_page"]    = 8;
        $config["uri_segment"] = 3;
        $config["num_links"]   = 4;
        $config["total_rows"]  = count($bookmarked_vehicles_service->get_bookmarked_vehicles('', '', $this->session->userdata('USER_ID')));

        $this->pagination_custome->initialize($config);

        $data['bookmarked_vehicles'] = $bookmarked_vehicles_service->get_bookmarked_vehicles($config["per_page"], $start, $this->session->userdata('USER_ID'));
        $data["links"]               = $this->pagination_custome->create_links();

        echo $this->load->view('my_dashboard/bookmarked_vehicles', $data);
    }

}
