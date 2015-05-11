<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle_compare extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('vehicle_compare/vehicle_compare_model');
        $this->load->model('vehicle_compare/vehicle_compare_service');
    }

    function add_vehicle_to_compare() {

        $vehicle_compare_model = new Vehicle_compare_model();
        $vehicle_compare_service = new Vehicle_compare_service();

        $vehicle_compare_model->set_user_id($this->session->userdata('USER_ID'));
        $vehicle_compare_model->set_vehicle_id($this->input->post('id', TRUE));
        $vehicle_compare_model->set_added_date(date("Y-m-d H:i:s"));

        $msg = $vehicle_compare_service->add_vehicle_to_compare($vehicle_compare_model);

        if ($msg == 1) {
            $this->load_vehicle_popup();
        } else {
            echo 3;
        }
    }

    function load_vehicle_popup() {
        $vehicle_compare_service = new Vehicle_compare_service();
        $compare_vehicles = $vehicle_compare_service->get_vehicles_to_compare($this->session->userdata('USER_ID'));

        $resCount = count($compare_vehicles);
        echo '<button style="border:0px solid black; background-color: transparent;" data-toggle="dropdown"><i class="fa fa-road"></i> Compare(' . $resCount . ')';
        echo '<span class="caret"></span>';
        echo '</button>';
        echo '<ul class="dropdown-menu" id="compare_vehicle_list">';

        if ($resCount != 0) {
            foreach ($compare_vehicles as $result) {
                echo '<li> <span class="photo"><img src="' . base_url() . 'uploads/vehicle_images/vh_' . $result->id . '/thumbnail/' . $result->image_path . '" alt="Thumb Car" height="30" width="50" /></span>';
                echo '<span class="subject">' . $result->manufacture . " " . $result->model . '</span> </li>';
            }
            echo '<li><button>Compare</button></li>';
        } else {
            echo '<li>Add Vehicles</li>';
        }

        echo '</ul>';
    }

}
