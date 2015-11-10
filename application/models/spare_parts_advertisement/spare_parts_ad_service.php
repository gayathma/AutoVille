<?php

class Spare_parts_ad_service extends CI_Model{
    
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
    
    function get_manufactures(){
        $this->db->select('manufacture.*');
        $this->db->from('manufacture');
        $this->db->where('manufacture.is_deleted', '0');
        $query=  $this->db->get();
        return $query->result();
    }
    
    /*
     * This service function to get all model
     */
    
    function get_model(){
        $this->db->select('model.*');
        $this->db->from('model');
        $this->db->where('model.is_deleted', '0');
        $query=  $this->db->get();
        return $query->result();
    }
    
    /*
     * This service function to get all fuel type
     */
    
    function get_fuel_type(){
        $this->db->select('fuel_type.*');
        $this->db->from('fuel_type');
        $this->db->where('fuel_type.is_deleted', '0');
        $query=  $this->db->get();
        return $query->result();
    }
}

