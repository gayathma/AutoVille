<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Advanced_search extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->library('pagination_custome');

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

        $this->load->model('advanced_search_content/advanced_search_content_model');
        $this->load->model('advanced_search_content/advanced_search_content_service');

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');

        $this->load->model('bookmarked_vehicles/bookmarked_vehicles_model');
        $this->load->model('bookmarked_vehicles/bookmarked_vehicles_service');

        $this->load->model('vehicle_likes/vehicle_likes_service');
        $this->load->model('vehicle_dislikes/vehicle_dislikes_service');
    }

    function advanced_search_view() {
        $manufacture_service = new Manufacture_service();
        $vehicle_model_service = new Vehicle_model_service();
        $body_type_service = new Body_type_service();
        $fuel_type_service = new Fuel_Type_service();
        $transmission_service = new Transmission_service();
        $district_service = new District_service();
        $vehicle_advertisments_service = new Vehicle_advertisments_service();
        $advanced_search_content_service = new Advanced_search_content_service();

        $data['manufactures'] = $manufacture_service->get_all_active_manufactures_for_home();
        $data['models'] = $vehicle_model_service->get_all_active_vehicle_models();
        $data['body_types'] = $body_type_service->get_all_active_body_types();
        $data['fuel_types'] = $fuel_type_service->get_all_active_fuel_types();
        $data['transmissions'] = $transmission_service->get_all_active_transmissions();
        $data['locations'] = $district_service->get_all_districts();
        $data['latest_vehicles'] = $vehicle_advertisments_service->get_new_arrival(2);
        $fields = $advanced_search_content_service->get_user_advanced_search_field($this->session->userdata('USER_ID'));
        $data['fields'] = $fields;

        $fields_arr = array();
        $i = 0;
        foreach ($fields as $field) {
            $fields_arr[$i] = $field->field_name;
            $i++;
        }

        $data['fields_arr'] = $fields_arr;

        $parials = array('content' => 'vehicle_adds/advanced_search', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

    function add_advanced_search_fields() {

        $advanced_search_content_service = new Advanced_search_content_service();
        $features_list = $this->input->post('features', TRUE);

        $success_count = 0;
        $result_count = 0;

        if ((!empty($features_list)) && ($this->session->userdata('USER_ID') != '')) {

            for ($i = 0; $i < count($features_list); $i++) {
                if ($features_list[$i] != "") {
                    ++$result_count;

                    $advanced_search_content_model = new Advanced_search_content_model();
                    $advanced_search_content_model->set_field_name($features_list[$i]);
                    $advanced_search_content_model->set_user_id($this->session->userdata('USER_ID'));
                    $advanced_search_content_model->set_is_deleted('0');
                    $advanced_search_content_model->set_added_by($this->session->userdata('USER_ID'));
                    $advanced_search_content_model->set_added_date(date("Y-m-d H:i:s"));

                    $msg = $advanced_search_content_service->add_advanced_search_fields($advanced_search_content_model);

                    if ($msg == '1') {
                        ++$success_count;
                    }
                }
            }

            if ($result_count == $success_count) {
                echo '1';
            } else {
                echo '0';
            }
        } else {
            echo '2';
        }
    }

    public function get_advanced_search_results($start = 0) {

        $advanced_search_content_service = new Advanced_search_content_service();
        $fields = $advanced_search_content_service->get_user_advanced_search_field($this->session->userdata('USER_ID'));

        $config = array();

        $config["base_url"] = site_url() . "/advanced_search/get_advanced_search_results/";
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

        $data['results'] = $advanced_search_content_service->advanced_search_vehicle($manufacture, $model, $body_type, $maxyear, $minyear, $fuel_type, $sale_type, $color, $maxprice, $minprice, $transmission, $kilometers, $location, $keyword, $config["per_page"], $start, 'half', $fields);

        $config["total_rows"] = count($advanced_search_content_service->advanced_search_vehicle($manufacture, $model, $body_type, $maxyear, $minyear, $fuel_type, $sale_type, $color, $maxprice, $minprice, $transmission, $kilometers, $location, $keyword, $config["per_page"], 0, 'all', $fields));

        $this->pagination_custome->initialize($config);
        $data["links"] = $this->pagination_custome->create_links();

        $data['is_advance_search'] = '1';

        echo $this->load->view('vehicle_adds/search_result', $data);
    }

    function delete_user_field() {
        $advanced_search_content_service = new Advanced_search_content_service();
        echo $advanced_search_content_service->delete_field($this->input->post('field_id', TRUE));
    }

}
