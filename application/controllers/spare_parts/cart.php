<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('cart/cart_model');
        $this->load->model('cart/cart_service');

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');
    }

    /**
     *Add new spare part to the cart
     */
    function add_items_to_cart() {

        $cart_model   = new Cart_model();
        $cart_service = new Cart_service();

        $cart_model->set_user_id($this->session->userdata('USER_ID'));
        $cart_model->set_spare_part_id($this->input->post('id', TRUE));
        $cart_model->set_added_date(date("Y-m-d H:i:s"));

        echo $cart_service->add_to_cart($cart_model);
    }

    /**
     * Load cart view
     */
    function load_cart_view() {
        $cart_service                  = new Cart_service();
        $vehicle_advertisement_service = new Vehicle_advertisments_service();

        $user_id = $this->session->userdata('USER_ID');

        $data['latest_vehicles'] = $vehicle_advertisement_service->get_new_arrival(2);
        $items                   = $cart_service->get_cart_items_by_id($user_id);
        $data['items']           = $items;

        $parials = array('content'      => 'spare_part/content_pages/cart_view', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/spare_part_template', $parials, $data);
    }

    /**
     * Remove spare part from cart
     */
    function delete_cart_items() {
        $cart_service = new Cart_service();

        $cart_service->delete_item($this->input->post('id', TRUE));
        $items         = $cart_service->get_cart_items_by_id($this->session->userdata('USER_ID'));
        $data['items'] = $items;

        echo $this->load->view('spare_part/content_pages/cart_result_view', $data);
    }

}