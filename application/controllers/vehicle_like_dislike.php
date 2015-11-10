<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle_like_dislike extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('vehicle_likes/vehicle_likes_model');
        $this->load->model('vehicle_likes/vehicle_likes_service');

        $this->load->model('vehicle_dislikes/vehicle_dislikes_model');
        $this->load->model('vehicle_dislikes/vehicle_dislikes_service');
    }

    /**
     * add vehile like and 
     */
    function add_vehicle_likes() {

        $vehicle_likes_model = new Vehicle_likes_model();
        $vehicle_likes_service = new Vehicle_likes_service();

        $vehicle_likes_model->set_user_id($this->session->userdata('USER_ID'));
        $vehicle_likes_model->set_vehicle_id($this->input->post('vehicle_id', TRUE));
        $vehicle_likes_model->set_is_deleted('0');
        $vehicle_likes_model->set_added_by($this->session->userdata('USER_ID'));
        $vehicle_likes_model->set_added_date(date("Y-m-d H:i:s"));

        $result = $vehicle_likes_service->insert_vehicle_like($vehicle_likes_model);

        if ($result == '1') {
            $likes = $vehicle_likes_service->get_like_count($this->input->post('vehicle_id', TRUE));
            echo $likes->like_count;
        } else {
            echo 0;
        }
    }

    function add_vehicle_dislikes() {

        $vehicle_dislikes_model = new Vehicle_dislikes_model();
        $vehicle_dislikes_service = new Vehicle_dislikes_service();

        $vehicle_dislikes_model->set_user_id($this->session->userdata('USER_ID'));
        $vehicle_dislikes_model->set_vehicle_id($this->input->post('vehicle_id', TRUE));
        $vehicle_dislikes_model->set_is_deleted('0');
        $vehicle_dislikes_model->set_added_by($this->session->userdata('USER_ID'));
        $vehicle_dislikes_model->set_added_date(date("Y-m-d H:i:s"));

        $result= $vehicle_dislikes_service->insert_vehicle_dislike($vehicle_dislikes_model);
        
         if ($result == '1') {
            $dislikes = $vehicle_dislikes_service->get_dislike_count($this->input->post('vehicle_id', TRUE));
            echo $dislikes->dislike_count;
        } else {
            echo 0;
        }
    }

}
