<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bookmarked_vehicles extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('bookmarked_vehicles/bookmarked_vehicles_model');
        $this->load->model('bookmarked_vehicles/bookmarked_vehicles_service');
    }

    /**
     * bookmark a vehicle
     */
    function bookmark_vehicle() {

        $bookmarked_vehicles_model   = new Bookmarked_vehicles_model();
        $bookmarked_vehicles_service = new Bookmarked_vehicles_service();

        $bookmarked_vehicles_model->set_user_id($this->session->userdata('USER_ID'));
        $bookmarked_vehicles_model->set_vehicle_id($this->input->post('vehicle_id', TRUE));
        $bookmarked_vehicles_model->set_is_deleted('0');
        $bookmarked_vehicles_model->set_added_by($this->session->userdata('USER_ID'));
        $bookmarked_vehicles_model->set_added_date(date("Y-m-d H:i:s"));

        echo $bookmarked_vehicles_service->insert_bookmarked_vehicle($bookmarked_vehicles_model);
    }

    /**
     * remove bookmark for a particular vehicle
     */
    function remove_bookmark() {

        $bookmarked_vehicles_service = new Bookmarked_vehicles_service();
        echo $bookmarked_vehicles_service->delete_bookmark($this->input->post('bookmark_id', TRUE));
    }

}
