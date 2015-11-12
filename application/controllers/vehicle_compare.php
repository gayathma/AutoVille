<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle_compare extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('vehicle_compare/vehicle_compare_model');
        $this->load->model('vehicle_compare/vehicle_compare_service');

        $this->load->model('equipment/equipment_model');
        $this->load->model('equipment/equipment_service');

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');
    }

    /**
     * This is the controller function to add a vehicle to compare
     */
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
            echo 0;
        }
    }

    /**
     * this is the controller function to add vehicles to popup in
     */
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
                echo '<li> <span class="photo"><img src="' . base_url() . 'uploads/vehicle_images/vh_' . $result->id . '/thumbnail/' . $result->image_path . '" alt="Thumb Car" height="40" width="70" /></span>';
                echo '<span class="subject"><h4>' . $result->manufacture . " " . $result->model . '</h4></span> </li>';
            }

            if ($resCount >= 2) {
                echo '<li><a href="' . site_url() . '/vehicle_compare/load_compare_vehicles_dashboard" class="dealer-name"><button>Compare</button></a></li>';
            }
        } else {
            echo '<li>Add Vehicles</li>';
        }

        echo '</ul>';
    }

    /**
     * this is the controller function to load added vehicles to compare on dashboard
     */
    function load_compare_vehicles() {

        $vehicle_compare_service = new Vehicle_compare_service();
        $equipment_service = new Equipment_service();

        $data['vehicle_list'] = $vehicle_compare_service->get_vehicle_to_compare_for_user($this->session->userdata('USER_ID'));
        $data['equipments'] = $equipment_service->get_all_active_equipment();

        $data['vehicle_equipments'] = array();

        foreach ($data['vehicle_list'] as $vehicle) {
            $data['equipment_arr'] = $equipment_service->get_equiments_in_vehicle($vehicle->id);
            array_push($data['vehicle_equipments'], $data['equipment_arr']);
        }

        if (count($data['vehicle_list']) > 0) {
            echo $this->load->view('my_dashboard/compare_vehicles', $data);
        } else {
            echo '<h4>Add Vehicles to Compare</h4>';
        }
    }

    /**
     * this is the controller function to load compare vehicles section on dashboard directly
     * compare button click event
     */
    function load_compare_vehicles_dashboard() {

        $vehicle_compare_service = new Vehicle_compare_service();
        $equipment_service = new Equipment_service();

        $data['vehicle_list'] = $vehicle_compare_service->get_vehicle_to_compare_for_user($this->session->userdata('USER_ID'));
        $data['equipments'] = $equipment_service->get_all_active_equipment();

        $data['vehicle_equipments'] = array();

        foreach ($data['vehicle_list'] as $vehicle) {
            $data['equipment_arr'] = $equipment_service->get_equiments_in_vehicle($vehicle->id);
            array_push($data['vehicle_equipments'], $data['equipment_arr']);
        }

        $data['my_advertisements'] = 0;


        $vehicle_advertisments_service = new Vehicle_advertisments_service();
        $data['latest_vehicles'] = $vehicle_advertisments_service->get_new_arrival(2);  //author-Ishani

        $parials = array('content' => 'my_dashboard/my_dashboard', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * this is the controller function to delete a vehicle record form vehicle_compare table
     */
    function delete_compared_vehicles() {
        $vehicle_compare_service = new Vehicle_compare_service();

        echo $vehicle_compare_service->delete_compared_vehicle(trim($this->session->userdata('USER_ID')), trim($this->input->post('vehicle_id', TRUE)));
    }

    function load_li_tags() {
        $vehicle_compare_service = new Vehicle_compare_service();
        $compare_vehicles = $vehicle_compare_service->get_vehicles_to_compare_for_unregistered_user(trim($this->input->post('id', TRUE)));

        foreach ($compare_vehicles as $result) {
            echo '<li> <span class="photo"><img src="' . base_url() . 'uploads/vehicle_images/vh_' . $result->id . '/thumbnail/' . $result->image_path . '" alt="Thumb Car" height="40" width="70" /></span>';
            echo '<span class="subject"><h4>' . $result->manufacture . " " . $result->model . '</h4></span> </li>';
        }
    }

    /**
     * this is the controller function to load compare vehicles section on dashboard directly for unregistered user
     * compare button click event
     */
    function load_compare_vehicles_dashboard_unreg_user($key_array) {


        $saved_vehicle_list = array();
        $saved_vehicle_id_list = array();

        //split and extract vehicle list from jStorage key list (key list comes as one string)
        $saved_vehicle_list = explode(',', $key_array);

        //extract vehicle id from vehicle list
        for ($i = 0; $i < count($saved_vehicle_list); $i++) {

            $vehicle_id = explode('_', $saved_vehicle_list[$i]);
            $saved_vehicle_id_list[$i] = $vehicle_id[1];
        }

        $vehicle_compare_service = new Vehicle_compare_service();
        $equipment_service = new Equipment_service();

        $data['vehicle_list'] = $vehicle_compare_service->get_vehicle_to_compare_for_unregistered_user($saved_vehicle_id_list);
        $data['equipments'] = $equipment_service->get_all_active_equipment();

        $data['vehicle_equipments'] = array();

        foreach ($data['vehicle_list'] as $vehicle) {
            $data['equipment_arr'] = $equipment_service->get_equiments_in_vehicle($vehicle->id);
            array_push($data['vehicle_equipments'], $data['equipment_arr']);
        }
        
        $data['my_advertisements'] = 0;


        $vehicle_advertisments_service = new Vehicle_advertisments_service();
        $data['latest_vehicles'] = $vehicle_advertisments_service->get_new_arrival(2);  //author-Ishani

        $parials = array('content' => 'my_dashboard/my_dashboard', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

}
