<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Spare_parts_advertisements extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('pagination_custome');

        $this->load->model('spare_parts_advertisement/spare_parts_ad_model');
        $this->load->model('spare_parts_advertisement/spare_parts_ad_service');

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');
        
        $this->load->model('users/user_model');
        $this->load->model('users/user_service');
    }
    
    /**
     * This function to uplpad spare part image
     */

    function post_new_spare_part_advertisement() {
        $vehicle_advertisement_service = new Vehicle_advertisments_service();
        $spare_part_ad_service = new Spare_parts_ad_service();

        $data['latest_vehicles'] = $vehicle_advertisement_service->get_new_arrival(2);
        $data['manufactures'] = $spare_part_ad_service->get_manufactures();
        $data['models'] = $spare_part_ad_service->get_model();
        $data['fuel_types'] = $spare_part_ad_service->get_fuel_type();
        $data['heading'] = "Promote your business";
        $parials = array('content' => 'spare_part/content_pages/add_new_spare_part_advertisement', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/spare_part_template', $parials, $data);
    }
    

    /**
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

    /**
     * This service function to insert a spare parts
     */

    function add_spare_parts() {

        $spare_part_ad_model = new Spare_parts_ad_model();
        $spare_part_ad_service = new Spare_parts_ad_service();

        $spare_part_ad_model->set_name($this->input->post('name', TRUE));
        $spare_part_ad_model->set_image($this->input->post('logo', TRUE));
        $spare_part_ad_model->set_category_id($this->input->post('category', TRUE));
        $spare_part_ad_model->set_manufacture_id($this->input->post('manufacturer', TRUE));
        $spare_part_ad_model->set_model_id($this->input->post('model', TRUE));
        $spare_part_ad_model->set_year($this->input->post('fabrication', TRUE));
        $spare_part_ad_model->set_fuel_type_id($this->input->post('fuel_type', TRUE));
        $spare_part_ad_model->set_description($this->input->post('description', TRUE));
        $spare_part_ad_model->set_price($this->input->post('price', TRUE));
        $spare_part_ad_model->set_added_by($this->session->userdata('USER_ID'));
        $spare_part_ad_model->set_added_date(date("Y-m-d H:i:s"));
        $spare_part_ad_model->set_updated_by(1);
        $spare_part_ad_model->set_is_published('0');
        $spare_part_ad_model->set_is_deleted('0');

        echo $spare_part_ad_service->add_spare_part_advertisement($spare_part_ad_model);
    }

    /**
     * search spare parts from spare part name,category,manufacture,max price, min price and description
     * @param type $start
     */
    function search_spare_part($start = "0") {

        $spare_part_ad_service = new Spare_parts_ad_service();

        $config = array();

        $config["base_url"] = site_url() . "/spare_parts/spare_parts_advertisements/search_spare_part";
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;
        $config["num_links"] = 4;

        $name = trim($this->input->post('name', TRUE));
        $manufacture_id = trim($this->input->post('manufacturer', TRUE));
        $category_id = trim($this->input->post('category_id', TRUE));
        $keyword = trim($this->input->post('keyword', TRUE));
        $maxprice = trim($this->input->post('maxprice', TRUE));
        $minprice = trim($this->input->post('minprice', TRUE));

        $data['results'] = $spare_part_ad_service->search_spare_parts($name, $manufacture_id, $category_id, $maxprice, $minprice, $keyword, $config["per_page"], $start);

        $config["total_rows"] = count($spare_part_ad_service->search_spare_parts($name, $manufacture_id, $category_id, $maxprice, $minprice, $keyword, $config["per_page"], ''));

        $this->pagination_custome->initialize($config);
        $data["links"] = $this->pagination_custome->create_links();

        echo $this->load->view('spare_part/spare_part_adds/spare_part_search_result', $data);
    }

    /**
     * load spare part advertisement detail view
     * @param integer $id Input spare part id
     * Author Ashani
     */

    public function spare_part_advertisement_detail_view($id) {
        $spare_parts_ad_service = new Spare_parts_ad_service();
        $user_service = new User_service();

        $data['spare_part_detail'] = $spare_parts_ad_service->get_spare_part_advertisement_by_id($id);
        $data['seller_add'] = $user_service->get_user($data['spare_part_detail']->added_by);

        $parials = array('content' => 'spare_part/content_pages/spare_part_detail_view');
        $this->template->load('template/spare_part_template', $parials, $data);
    }

}
