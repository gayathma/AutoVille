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
                . 'spare_parts_advertisements.image,'
                . 'spare_parts_advertisements.description,'
                . 'spare_parts_advertisements.manufacture_id,'
                . 'spare_parts_advertisements.price,'
                . 'spare_parts_advertisements.category_id,'
                . 'spare_parts_advertisements.added_by,'
                . 'spare_parts_advertisements.is_featured,'
                . 'spare_parts_advertisements.year,'
                . 'manufacture.name as manufacture,'
                . 'model.name as model,'
                . 'fuel_type.name as fuel_type,'
                . 'spare_parts_cat.name as category');
        $this->db->from('spare_parts_advertisements');
        $this->db->join('spare_parts_cat', 'spare_parts_cat.id = spare_parts_advertisements.category_id', 'left');
        $this->db->join('manufacture', 'manufacture.id = spare_parts_advertisements.manufacture_id', 'left');
        $this->db->join('model', 'model.id = spare_parts_advertisements.model_id', 'left');
        $this->db->join('fuel_type', 'fuel_type.id = spare_parts_advertisements.fuel_type_id', 'left');
        $this->db->where('spare_parts_advertisements.is_deleted', '0');
        $this->db->where('spare_parts_advertisements.is_published', '1');
        $this->db->where('spare_parts_advertisements.is_featured', '1');
        $this->db->group_by('spare_parts_advertisements.id');
        if ($limit != '') {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
//        echo $this->db->last_query();
//        die;

        return $query->result();
    }

    /*
     * This is the service function to get newly arrived spare parts
     * Author Ashani
     */

    public function get_new_arrival($limit) {

        $this->db->select('spare_parts_advertisements.id,'
                . 'spare_parts_advertisements.name,'
                . 'spare_parts_advertisements.image,'
                . 'spare_parts_advertisements.description,'
                . 'spare_parts_advertisements.manufacture_id,'
                . 'spare_parts_advertisements.price,'
                . 'spare_parts_advertisements.category_id,'
                . 'spare_parts_advertisements.added_by,'
                . 'spare_parts_advertisements.is_featured,'
                . 'spare_parts_cat.name as category,'
                . 'spare_parts_advertisements.year,'
                . 'manufacture.name as manufacture,'
                . 'model.name as model,'
                . 'fuel_type.name as fuel_type');
        $this->db->from('spare_parts_advertisements');
        $this->db->join('manufacture', 'manufacture.id = spare_parts_advertisements.manufacture_id', 'left');
        $this->db->join('spare_parts_cat', 'spare_parts_cat.id = spare_parts_advertisements.category_id', 'left');
        $this->db->join('model', 'model.id = spare_parts_advertisements.model_id', 'left');
        $this->db->join('fuel_type', 'fuel_type.id = spare_parts_advertisements.fuel_type_id', 'left');
        $this->db->where('spare_parts_advertisements.is_deleted', '0');
        $this->db->where('spare_parts_advertisements.is_published', '1');
        $this->db->order_by("spare_parts_advertisements.added_date", "desc");

        if ($limit != '') {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * search spare part according to input values
     * @param type $name : name of the spare part
     * @param type $manufacture_id : manufacture of the spare part
     * @param type $category_id : category of the spare part
     * @param type $maxprice : maxprice of the spare part
     * @param type $minprice : minprice of the spare part
     * @param type $keyword : description of the spare part
     * @param string $limit
     * @param type $start
     * @return type
     */
    function search_spare_parts($name, $manufacture_id, $category_id, $maxprice, $minprice, $keyword, $limit, $start) {

        $this->db->select('spare_parts_advertisements.id,'
                . 'spare_parts_advertisements.name,'
                . 'spare_parts_advertisements.image,'
                . 'spare_parts_advertisements.description,'
                . 'spare_parts_advertisements.manufacture_id,'
                . 'spare_parts_advertisements.price,'
                . 'spare_parts_advertisements.category_id,'
                . 'spare_parts_advertisements.added_by,'
                . 'spare_parts_advertisements.is_featured,'
                . 'spare_parts_cat.name as category');
        $this->db->from('spare_parts_advertisements');
        $this->db->join('spare_parts_cat', 'spare_parts_cat.id = spare_parts_advertisements.category_id', 'left');
        $this->db->where('spare_parts_advertisements.is_deleted', '0');
        $this->db->where('spare_parts_advertisements.is_published', '1');

        if (!empty($name) && !is_null($name)) {
            $this->db->like('spare_parts_advertisements.name', $name);
        }
        if (!empty($manufacture_id) && !is_null($manufacture_id)) {
            $this->db->where('spare_parts_advertisements.manufacture_id', $manufacture_id);
        }
        if (!empty($category_id) && !is_null($category_id)) {
            $this->db->where('spare_parts_advertisements.category_id', $category_id);
        }
        if (!empty($maxprice) && !is_null($maxprice)) {
            $this->db->where('spare_parts_advertisements.price <', $maxprice);
            $this->db->or_where('spare_parts_advertisements.price >=', $minprice);
        }
        if (!empty($keyword) && !is_null($keyword)) {
            $this->db->or_like('spare_parts_advertisements.description', $keyword);
        }

        $this->db->order_by("spare_parts_advertisements.added_date", "desc");

        if (($limit = "") && ($start != "")) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();

//        echo $this->db->last_query();
//        die;

        return $query->result();
    }

}
