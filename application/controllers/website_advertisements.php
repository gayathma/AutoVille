<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Website_advertisements extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('website_advertisements/website_advertisements_model');
        $this->load->model('website_advertisements/website_advertisements_service');

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');
    }

    /**
     * post a new commercial advertisement
     */
    function post_new_commercial_advertisement() {
        $vehicle_advertisement_service = new Vehicle_advertisments_service();

        $data['latest_vehicles'] = $vehicle_advertisement_service->get_new_arrival(2);
        $data['heading']         = "Promote your business";
        $parials                 = array('content' => 'website_advertisements/add_new_website_advertisement', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * This function is to upload commercial image
     */
    function upload_commercial_image() {

        $uploaddir  = './uploads/commercial_images/';
        $unique_tag = 'commercial_images_';

        $filename = $unique_tag . time() . '-' . basename($_FILES['uploadfile']['name']); //this is the file name
        $file     = $uploaddir . $filename; // this is the full path of the uploaded file

        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
            echo $filename;
        } else {
            echo "error";
        }
    }

    /**
     * This service function to insert a commercial
     */
    function add_commercial() {

        $website_advertisement_model   = new Website_advertisements_model();
        $website_advertisement_service = new Website_advertisements_service();

        $website_advertisement_model->set_topic($this->input->post('topic', TRUE));
        $website_advertisement_model->set_image($this->input->post('logo', TRUE));
        $website_advertisement_model->set_url($this->input->post('url', TRUE));
        $website_advertisement_model->set_description($this->input->post('description', TRUE));
        $website_advertisement_model->set_price($this->input->post('price', TRUE));
        $website_advertisement_model->set_added_by($this->session->userdata('USER_ID'));
        $website_advertisement_model->set_added_date(date("Y-m-d H:i:s"));
        $website_advertisement_model->set_updated_by(1);
        $website_advertisement_model->set_is_published('0');
        $website_advertisement_model->set_is_deleted('0');

        echo $website_advertisement_service->add_website_advertisement($website_advertisement_model);
    }

}
