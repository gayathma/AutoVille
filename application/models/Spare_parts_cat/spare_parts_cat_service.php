<?php

class Spare_parts_cat_service extends CI_Model {
    
    function __construct() {
        parent::__construct();
        $this->load->model("spare_parts_cat/spare_parts_cat_model");
        
    }
    
    /*
     Function to get all active Categories 
     */
    
    public function get_all_active_categories(){
        $this->db->select('spare_parts_cat.name,
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
        //       echo $this->db->last_query();
        //       die;
        return $query->result();
    }

}
