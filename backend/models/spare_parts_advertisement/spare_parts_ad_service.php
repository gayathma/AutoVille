<?php

class Spare_parts_ad_service extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->model('spare_parts_advertisement/spare_parts_ad_model');
    }
    
    /*
     * This is the service function to get all spare part advertisements
     */
    
    public function get_all_spare_part_advertisements(){
        
        $this->db->select('spare_parts_advertisements.*,'
                . 'user.name as added_by_user,'
                . 'manufacture.name as manufacture,'
                . 'model.name as model,'
                . 'fuel_type.name as fuel,spare_parts_cat.name as category');
        $this->db->from('spare_parts_advertisements');
        $this->db->join('user', 'user.id = spare_parts_advertisements.added_by');
        $this->db->join('manufacture','manufacture.id=spare_parts_advertisements.manufacture_id');
        $this->db->join('model','model.id=spare_parts_advertisements.model_id');
        $this->db->join('fuel_type','fuel_type.id=spare_parts_advertisements.fuel_type_id');
        $this->db->join('spare_parts_cat','spare_parts_cat.id=spare_parts_advertisements.category_id');
        $this->db->where('spare_parts_advertisements.is_deleted', '0');
        $this->db->order_by("spare_parts_advertisements.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    
    /*
     * This service function to deleted spare parts advertisements
     */
    
    public function delete_spare_part_advertisements($advertisement_id){
        $date=array('is_deleted'=>'1');
        $this->db->where('id',$advertisement_id);
        return $this->db->update('spare_parts_advertisements',$date);
    }
    
     /*
     * This service function is to update publish status of a advertisement
     */
    public function publish_spare_part_advertisement($spare_parts_advertisments_model) {
        $data = array('is_published' => $spare_parts_advertisments_model->get_is_published());
        $this->db->update('spare_parts_advertisements', $data, array('id' => $spare_parts_advertisments_model->get_id()));
        return $this->db->affected_rows();
    }
    
    /*
     * Get approved advertisments to featured advertisement 
     * Author - Ashani
     * 
     */
    
    function get_approved_advertisements_for_featured() {

        $this->db->select('spare_parts_advertisements.*,user.name as added_by_user,'
                . 'manufacture.name as manufacture,model.name as model,'
                . 'fuel_type.name as fuel_type,spare_parts_cat.name as category');
        $this->db->from('spare_parts_advertisements');
        $this->db->join('manufacture', 'manufacture.id = spare_parts_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = spare_parts_advertisements.model_id');        
        $this->db->join('fuel_type', 'fuel_type.id = spare_parts_advertisements.fuel_type_id'); 
        $this->db->join('spare_parts_cat', 'spare_parts_cat.id = spare_parts_advertisements.category_id'); 
        $this->db->join('user', 'user.id = spare_parts_advertisements.added_by');
        $this->db->where('spare_parts_advertisements.is_deleted', '0');
        $this->db->where('spare_parts_advertisements.is_published', '1');
        $this->db->where('spare_parts_advertisements.is_featured in (2,1)');
        $this->db->order_by("spare_parts_advertisements.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    
    
    /**
     * This service function to make the advertisement fetured
     * @param type $spare_parts_advertisments_model
     * @return type object
     * Author Ashani
     */
    public function featured_spare_part_advertisement($spare_parts_advertisments_model) {
        $data = array('is_featured' => $spare_parts_advertisments_model->get_is_featured());
        $this->db->update('spare_parts_advertisements', $data, array('id' => $spare_parts_advertisments_model->get_id()));
        return $this->db->affected_rows();
    }
}

