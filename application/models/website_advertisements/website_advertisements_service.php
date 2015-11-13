<?php

class Website_advertisements_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('website_advertisements/website_advertisements_model');
    }

    /**
     * This service function to add a website advertisement
     * @param object $website_advertisement Input model
     * @return boolean
     */
    function add_website_advertisement($website_advertisement) {
        return $this->db->insert('website_advertisements', $website_advertisement);
    }

    /**
     * this service function to get all advertisements
     */
    function get_advertisement_image() {
        $this->db->select('website_advertisements.*');
        $this->db->from('website_advertisements');
        $this->db->where('is_published', '1');
        $this->db->where('is_deleted', '0');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }
    
    /**
     * This service function to get the particular celebrity
     */
    
    function get_celebrity($manufacture_id,$model_id,$year){
        $this->db->select('celebrity.*');
        $this->db->from('celebrity');
        $this->db->where('manufacture_id',$manufacture_id);
        $this->db->where('model_id',$model_id);
        $this->db->where('year',$year);
        $this->db->where('is_published', '1');
        $this->db->where('is_deleted', '0');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

}
