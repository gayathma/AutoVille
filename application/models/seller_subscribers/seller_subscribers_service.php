<?php

class Seller_subscribers_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('seller_subscribers/seller_subscribers_model');
    }

    function insert_seller_subscriber($seller_subscribers_model) {
        return $this->db->insert('seller_subscribers', $seller_subscribers_model);
    }

     function update_vehicle_advertisement($vehicle_advertisement_model) {

        $data = array(
            'model_id'        => $vehicle_advertisement_model->get_model_id(),
            'manufacture_id'  => $vehicle_advertisement_model->get_manufacture_id(),
            'description'     => $vehicle_advertisement_model->get_description(),
            'fuel_type_id'    => $vehicle_advertisement_model->get_fuel_type_id(),
            'year'            => $vehicle_advertisement_model->get_year(),
            'transmission_id' => $vehicle_advertisement_model->get_transmission_id(),
            'body_type_id'    => $vehicle_advertisement_model->get_body_type_id(),
            'doors'           => $vehicle_advertisement_model->get_doors(),
            'location_id'     => $vehicle_advertisement_model->get_location_id(),
            'colour'          => $vehicle_advertisement_model->get_colour(),
            'sale_type'       => $vehicle_advertisement_model->get_sale_type(),
            'chassis_no'      => $vehicle_advertisement_model->get_chassis_no(),
            'kilometers'      => $vehicle_advertisement_model->get_kilometers(),
            'price'           => $vehicle_advertisement_model->get_price(),
            'is_price_drop'   => $vehicle_advertisement_model->get_is_price_drop(),
            'latitude'        => $vehicle_advertisement_model->get_latitude(),
            'longitude'       => $vehicle_advertisement_model->get_longitude(),
            'updated_by'      => $vehicle_advertisement_model->get_updated_by(),
            'updated_date'    => $vehicle_advertisement_model->get_updated_date()
        );
        $this->db->where('id', $vehicle_advertisement_model->get_id());
        return $this->db->update('vehicle_advertisements', $data);
    }
}
