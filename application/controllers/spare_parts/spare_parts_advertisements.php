<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Spare_parts_advertisements extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->model('spare_parts_advertisement/spare_parts_ad_model');
        $this->load->model('spare_parts_advertisement/spare_parts_ad_service');
        
        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');
    }
    
    function post_new_spare_part_advertisement(){
        $vehicle_advertisement_service = new Vehicle_advertisments_service();
        $spare_part_ad_service= new Spare_parts_ad_service();
        
        $data['latest_vehicles'] = $vehicle_advertisement_service->get_new_arrival(2);
        $data['manufactures']=$spare_part_ad_service->get_manufactures();
        $data['models']=$spare_part_ad_service->get_model();
        $data['fuel_types']=$spare_part_ad_service->get_fuel_type();
        $data['heading']       = "Promote your business";
        $parials = array('content'      => 'spare_part/content_pages/add_new_spare_part_advertisement', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/spare_part_template', $parials, $data);
    }



    /*
     * This function is to upload spare part image
     */

    function upload_spare_part_image() {

        $uploaddir = './uploads/spare_part_images/';
        $unique_tag = 'spare_part_images_';

        $filename = $unique_tag . time() . '-' . basename($_FILES['uploadfile']['name']); //this is the file name
        $file = $uploaddir . $filename; // this is the full path of the uploaded file

        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
            echo $filename;
        } else {
            echo "error";
        }
    }
    
    /*
     * This service function to insert a spare parts
     */
    
    function add_spare_parts(){
        
        $spare_part_ad_model=new Spare_parts_ad_model();
        $spare_part_ad_service= new Spare_parts_ad_service();
        
        $spare_part_ad_model->set_name($this->input->post('name', TRUE));
        $spare_part_ad_model->set_image($this->input->post('logo', TRUE));
        $spare_part_ad_model->set_category_id($this->input->post('category',TRUE));
        $spare_part_ad_model->set_manufacture_id($this->input->post('manufacturer', TRUE));
        $spare_part_ad_model->set_model_id($this->input->post('model', TRUE));
        $spare_part_ad_model->set_year($this->input->post('fabrication',TRUE));
        $spare_part_ad_model->set_fuel_type_id($this->input->post('fuel_type',TRUE));
        $spare_part_ad_model->set_description($this->input->post('description', TRUE));
        $spare_part_ad_model->set_price($this->input->post('price',TRUE));
        $spare_part_ad_model->set_added_by($this->session->userdata('USER_ID'));
        $spare_part_ad_model->set_added_date(date("Y-m-d H:i:s"));
        $spare_part_ad_model->set_updated_by(1);
        $spare_part_ad_model->set_is_published('0');
        $spare_part_ad_model->set_is_deleted('0');       

        echo $spare_part_ad_service->add_spare_part_advertisement($spare_part_ad_model);
    }
    
}


