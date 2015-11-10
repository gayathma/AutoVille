<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle_search extends CI_Controller {

    private $is_first_time;

    function __construct() {
        parent::__construct();

        $this->is_first_time = TRUE;

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');

        $this->load->model('manufacture/manufacture_model');
        $this->load->model('manufacture/manufacture_service');

        $this->load->model('vehicle_model/vehicle_model_model');
        $this->load->model('vehicle_model/vehicle_model_service');

        $this->load->model('body_type/body_type_model');
        $this->load->model('body_type/body_type_service');

        $this->load->model('fuel_type/fuel_type_model');
        $this->load->model('fuel_type/fuel_type_service');

        $this->load->model('transmission/transmission_model');
        $this->load->model('transmission/transmission_service');

        $this->load->model('district/district_model');
        $this->load->model('district/district_service');

        $this->load->model('contents/content_model');
        $this->load->model('contents/content_service');

        $this->load->model('bookmarked_vehicles/bookmarked_vehicles_model');
        $this->load->model('bookmarked_vehicles/bookmarked_vehicles_service');

        $this->load->library('pagination');
        $this->load->library('pagination_custome');

        $this->load->model('vehicle_likes/vehicle_likes_service');
        $this->load->model('vehicle_dislikes/vehicle_dislikes_service');
    }

    function load_data() {

        $manufacture_service = new Manufacture_service();
        $vehicle_model_service = new Vehicle_model_service();
        $body_type_service = new Body_type_service();
        $fuel_type_service = new Fuel_Type_service();
        $transmission_service = new Transmission_service();
        $district_service = new District_service();
        $content_service = new Content_service();

        $data['manufactures'] = $manufacture_service->get_all_active_manufactures();
        $data['models'] = $vehicle_model_service->get_all_active_vehicle_models();
        $data['body_types'] = $body_type_service->get_all_active_body_types();
        $data['fuel_types'] = $fuel_type_service->get_all_active_fuel_types();
        $data['transmissions'] = $transmission_service->get_all_active_transmissions();
        $data['locations'] = $district_service->get_all_districts();

        return $data;
    }

    public function search_advertisements($start = 0) {

        if ($this->is_first_time) {
            $data = $this->load_data();
            $this->is_first_time = FALSE;
        }

        $vehicle_advertisments_model = new Vehicle_advertisments_model();
        $vehicle_advertisments_service = new Vehicle_advertisments_service();
        $data['latest_vehicles'] = $vehicle_advertisments_service->get_new_arrival(2);

        $config = array();

        $config["base_url"] = site_url() . "/vehicle_search/search_advertisements/";
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;
        $config["num_links"] = 4;


        $manufacture = trim($this->input->post('manufacturer', TRUE));
        $model = trim($this->input->post('model', TRUE));
        $body_type = trim($this->input->post('body_type', TRUE));
        $maxyear = trim($this->input->post('maxyear', TRUE));
        $minyear = trim($this->input->post('minyear', TRUE));
        $fuel_type = trim($this->input->post('fuel_type', TRUE));
        $sale_type = trim($this->input->post('sale_type', TRUE));
        $color = trim($this->input->post('color', TRUE));
        $maxprice = trim($this->input->post('maxprice', TRUE));
        $minprice = trim($this->input->post('minprice', TRUE));
        $transmission = trim($this->input->post('transmission', TRUE));
        $kilometers = trim($this->input->post('kilometers', TRUE));
        $location = trim($this->input->post('location', TRUE));
        $keyword = trim($this->input->post('keyword', TRUE));

        $view_no = trim($this->input->post('view_no', TRUE));

        $data['results'] = $vehicle_advertisments_service->search_vehicle_limit($manufacture, $model, $body_type, $maxyear, $minyear, $fuel_type, $sale_type, $color, $maxprice, $minprice, $transmission, $kilometers, $location, $keyword, $config["per_page"], $start, 'half');

        $config["total_rows"] = count($vehicle_advertisments_service->search_vehicle_limit($manufacture, $model, $body_type, $maxyear, $minyear, $fuel_type, $sale_type, $color, $maxprice, $minprice, $transmission, $kilometers, $location, $keyword, $config["per_page"], 0, 'all'));

        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();

        $data['is_advance_search'] = '0';

        if ($view_no == 1) {
            echo $this->load->view('vehicle_adds/search_result', $data);
        } else {
            $parials = array('content' => 'vehicle_adds/search_advertisement', 'new_arrivals' => 'vehicle_adds/new_arrivals');
            $this->template->load('template/main_template', $parials, $data);
        }
    }

    /*
     * ar application search function
     */

    public function search($start = 0) {

        if ($this->is_first_time) {
            $data = $this->load_data();
            $this->is_first_time = FALSE;
        }

        $vehicle_advertisments_service = new Vehicle_advertisments_service();
        $data['latest_vehicles'] = $vehicle_advertisments_service->get_new_arrival(2);

        $config = array();

        $config["base_url"] = site_url() . "/vehicle_search/search_advertisements/";
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;
        $config["num_links"] = 4;


        $manufacture = trim($this->input->get('type', TRUE));

        $view_no = trim($this->input->post('view_no', TRUE));

        $data['results'] = $vehicle_advertisments_service->search($manufacture, $config["per_page"], $start, 'half');

        $config["total_rows"] = count($vehicle_advertisments_service->search($manufacture, $config["per_page"], 0, 'all'));

        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();

        $data['is_advance_search'] = '0';

        if ($view_no == 1) {
            echo $this->load->view('vehicle_adds/search_result', $data);
        } else {
            $parials = array('content' => 'vehicle_adds/search_advertisement', 'new_arrivals' => 'vehicle_adds/new_arrivals');
            $this->template->load('template/main_template', $parials, $data);
        }
    }

}
