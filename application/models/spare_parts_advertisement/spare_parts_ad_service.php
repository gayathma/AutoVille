<?php

class Spare_parts_ad_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('spare_parts_advertisement/spare_parts_ad_model');
    }

    /*
     * This service function to add a spare part advertisement
     */

    function add_spare_part_advertisement($spare_part_advertisement) {
        return $this->db->insert('spare_parts_advertisements', $spare_part_advertisement);
    }

    /*
     * This service function to get all manufactures
     */

    function get_manufactures() {
        $this->db->select('manufacture.*');
        $this->db->from('manufacture');
        $this->db->where('manufacture.is_deleted', '0');
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * This service function to get all model
     */

    function get_model() {
        $this->db->select('model.*');
        $this->db->from('model');
        $this->db->where('model.is_deleted', '0');
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * This service function to get all fuel type
     */

    function get_fuel_type() {
        $this->db->select('fuel_type.*');
        $this->db->from('fuel_type');
        $this->db->where('fuel_type.is_deleted', '0');
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * This is the service function to get price drop spare parts
     * Author Ashani
     */

    function get_featured_vehicles($limit) {

        $this->db->select('spare_parts_advertisements.id,'
                . 'spare_parts_advertisements.name,'
                . 'spare_parts_advertisements.year,'
                . 'spare_parts_advertisements.image,'
                . 'manufacture.name as manufacture,'
                . 'model.name as model,'
                . 'fuel_type.name as fuel_type,');
        $this->db->from('spare_parts_advertisements');
        $this->db->join('manufacture', 'manufacture.id = spare_parts_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = spare_parts_advertisements.model_id');
        $this->db->join('fuel_type', 'fuel_type.id = spare_parts_advertisements.fuel_type_id');
        $this->db->where('spare_parts_advertisements.is_deleted', '0');
        $this->db->where('spare_parts_advertisements.is_featured', '1');
        $this->db->group_by('spare_parts_advertisements.id');
        if ($limit != '') {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }

}
