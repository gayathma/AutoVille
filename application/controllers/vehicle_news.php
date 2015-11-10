<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle_news extends CI_Controller {

    function __construct() {
        parent::__construct();


        $this->load->model('vehicle_news/vehicle_news_model');
        $this->load->model('vehicle_news/vehicle_news_service');

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');
    }

    /**
     * this will display all vehicle news
     */
    function manage_vehicle_news() {
        $vehicle_news_service = new Vehicle_news_service();

        $data['heading'] = "Manage Vehicle News";
        $data['results'] = $vehicle_news_service->get_all_vehicle_news();

        $parials = array('content' => 'vehicle_news/manage_vehicle_news_view');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * list all news for a particular vehicle
     */
    function list_vehicle_news() {
        $vehicle_news_service          = new Vehicle_news_service();
        $vehicle_advertisments_service = new Vehicle_advertisments_service();

        $data['vehicle_news_list'] = $vehicle_news_service->get_vehicle_news_list();
        $data['latest_vehicles']   = $vehicle_advertisments_service->get_new_arrival(2);

        $parials = array('content' => 'vehicle_news/vehicle_news_list_view', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * this will add new vehicle news
     */
    function add_vehicle_news() {
        $vehicle_news_model   = new Vehicle_news_model();
        $vehicle_news_service = new Vehicle_news_service();

        $vehicle_news_model->set_title($this->input->post('name', TRUE));
        $vehicle_news_model->set_content($this->input->post('content_text', TRUE));
        $vehicle_news_model->set_added_by($this->session->userdata('USER_ID'));
        $vehicle_news_model->set_added_date(date("Y-m-d H:i:s"));
        $vehicle_news_model->set_is_published('1');
        $vehicle_news_model->set_is_deleted('0');
        $vehicle_news_model->set_is_latest('0');

        echo $vehicle_news_service->add_new_vehicle_news($vehicle_news_model);
    }

    /**
     * this will delete the vehicle news
     */
    function delete_vehicle_news() {
        $vehicle_news_service = new Vehicle_news_service();
        echo $vehicle_news_service->delete_vehicle_news($this->input->post('id', TRUE));
    }

    /**
     * to change the publish status of the vehicle news
     */
    function change_publish_status() {
        $vehicle_news_model   = new Vehicle_news_model();
        $vehicle_news_service = new Vehicle_news_service();

        $vehicle_news_model->set_id(trim($this->input->post('id', TRUE)));
        $vehicle_news_model->set_is_published(trim($this->input->post('value', TRUE)));

        echo $vehicle_news_service->publish_vehicle_news($vehicle_news_model);
    }

    /**
     * edit vehicle news pop up content set up and send
     */
    function load_edit_vehicle_news_content() {
        $vehicle_news_model   = new Vehicle_news_model();
        $vehicle_news_service = new Vehicle_news_service();

        $vehicle_news_model->set_id(trim($this->input->post('vehicle_news_id', TRUE)));
        $vehicle_news         = $vehicle_news_service->get_vehicle_news_by_id($vehicle_news_model);
        $data['vehicle_news'] = $vehicle_news;

        echo $this->load->view('vehicle_news/vehicle_news_edit_pop_up', $data, TRUE);
    }

    /**
     * update vehicle news details
     */
    function edit_vehicle_news() {
        $vehicle_news_model   = new Vehicle_news_model();
        $vehicle_news_service = new Vehicle_news_service();

        $vehicle_news_model->set_id(trim($this->input->post('vehicle_news_id', TRUE)));
        $vehicle_news_model->set_title($this->input->post('title', TRUE));
        $vehicle_news_model->set_content($this->input->post('content_text', TRUE));
        $vehicle_news_model->set_updated_by($this->session->userdata('USER_ID'));
        $vehicle_news_model->set_updated_date(date("Y-m-d H:i:s"));

        echo $vehicle_news_service->update_vehicle_news($vehicle_news_model);
    }

    /**
     * Front end news
     */
    public function load_latest_vehicle_news() {
        $vehicle_news_service = new Vehicle_news_service();
        $data['results']      = $vehicle_news_service->get_vehicle_news();
        echo $this->load->view('manufacturers/manufacture_list_view', $data);
    }

}
