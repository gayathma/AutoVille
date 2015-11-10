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

    function search_spare_parts($name, $category_id, $maxprice, $minprice, $keyword,$limit,$start) {

        $this->db->select('spare_parts_advertisements.id,'
                . 'spare_parts_advertisements.name,'
                . 'spare_parts_advertisements.image,'
                . 'spare_parts_advertisements.description,'
                . 'spare_parts_advertisements.price,'
                . 'spare_parts_advertisements.category_id,'
                . 'spare_parts_advertisements.added_by,'
                . 'spare_parts_cat.name as category');
        $this->db->from('spare_parts_advertisements');
        $this->db->join('spare_parts_cat', 'spare_parts_cat.id = spare_parts_advertisements.category_id');
        $this->db->where('spare_parts_advertisements.is_deleted', '0');
        $this->db->where('spare_parts_advertisements.is_published', '1');

        if (!empty($name) && !is_null($name)) {
            $this->db->where('spare_parts_advertisements.name', $name);
        }
        if (!empty($category_id) && !is_null($category_id)) {
            $this->db->where('spare_parts_advertisements.category_id', $category_id);
        }
        if (!empty($maxprice) && !is_null($maxprice)) {
            $this->db->where('spare_parts_advertisements.price <=', $maxprice);
            $this->db->where('spare_parts_advertisements.price >=', $minprice);
        }
        if (!empty($keyword) && !is_null($keyword)) {
            $this->db->where('spare_parts_advertisements.description', $keyword);
        }

        $this->db->order_by("spare_parts_advertisements.added_date", "desc");

        if (($limit = "") && ($start != "")) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();

        return $query->result();
    }

}
