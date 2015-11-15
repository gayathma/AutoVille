<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('spare_parts_cat/spare_parts_cat_model');
        $this->load->model('spare_parts_cat/spare_parts_cat_service');

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');

        $this->load->model('bookmarked_spare_parts/bookmarked_spare_parts_model');
        $this->load->model('bookmarked_spare_parts/bookmarked_spare_parts_service');

        $this->load->model('cart/cart_model');
        $this->load->model('cart/cart_service');

        $this->load->model('users/user_model');
        $this->load->model('users/user_service');
    }

    public function load_category_items($id) {
        $category_service              = new Spare_parts_cat_service();
        $vehicle_advertisement_service = new Vehicle_advertisments_service();

        $data['results']         = $category_service->get_all_items_by_category($id);
        $data['latest_vehicles'] = $vehicle_advertisement_service->get_new_arrival(2);

        $parials = array('content'      => 'spare_part/content_pages/category_list', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/spare_part_template', $parials, $data);
    }

}
