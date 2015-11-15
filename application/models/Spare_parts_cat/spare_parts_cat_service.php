<?php

class Spare_parts_cat_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model("spare_parts_cat/spare_parts_cat_model");
    }

    /*
      Function to get all active Categories
     */

    public function get_all_active_categories() {
        $this->db->select('spare_parts_cat.name,
            spare_parts_cat.image,
            spare_parts_cat.id');
        $this->db->from('spare_parts_cat');
        $this->db->where('spare_parts_cat.is_deleted', '0');
        $this->db->where('spare_parts_cat.is_published', '1');
        $this->db->order_by("spare_parts_cat.name", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    function get_category_name() {
        $this->db->select('spare_parts_cat.name');
        $this->db->from('spare_parts_cat');
        $this->db->where('spare_parts_cat.is_deleted', '0');
        $this->db->where('spare_parts_cat.is_published', '1');
        $this->db->order_by("spare_parts_cat.name", "asc");
        $this->db->group_by('spare_parts_cat.name');
        $this->db->limit(12);
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_items_by_category($cat_id) {
        $this->db->select('spare_parts_advertisements.id,'
                . 'spare_parts_advertisements.name,'
                . 'spare_parts_advertisements.image,'
                . 'spare_parts_advertisements.description,'
                . 'spare_parts_advertisements.price,'
                . 'spare_parts_advertisements.is_featured,'
                . 'spare_parts_cat.name as category,'
                . 'spare_parts_advertisements.year');
        $this->db->from('spare_parts_advertisements');
        $this->db->join('spare_parts_cat', 'spare_parts_cat.id = spare_parts_advertisements.category_id', 'left');
        $this->db->where('spare_parts_advertisements.category_id', $cat_id);
        $this->db->where('spare_parts_advertisements.is_deleted', '0');
        $this->db->where('spare_parts_advertisements.is_published', '1');
        $this->db->order_by("spare_parts_advertisements.added_date", "desc");

        $query = $this->db->get();
        return $query->result();
    }

}
