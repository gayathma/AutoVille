<?php

class Vehicle_advertisments_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
    }

    /*
     * This is the service function to get all advertisements
     */

    public function get_all_advertisements() {

        $this->db->select('vehicle_advertisements.*,user.name as added_by_user,'
                . 'manufacture.name as manufacture,model.name as model,'
                . 'transmission.name as transmission,fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id');
        $this->db->join('transmission', 'transmission.id = vehicle_advertisements.transmission_id');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('user', 'user.id = vehicle_advertisements.added_by');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->order_by("vehicle_advertisements.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    
    /*
     * This is the service function to search all advertisements
     */

    public function search_advertisements() {

        $this->db->select('vehicle_advertisements.*,user.name as added_by_user,'
                . 'manufacture.name as manufacture,model.name as model,'
                . 'transmission.name as transmission,fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id');
        $this->db->join('transmission', 'transmission.id = vehicle_advertisements.transmission_id');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('user', 'user.id = vehicle_advertisements.added_by');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->order_by("vehicle_advertisements.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * This service function is to delete a advertisements
     */
    function delete_advertisement($advertisement_id) {
        $data = array('is_deleted' => '1');
        $this->db->where('id', $advertisement_id);
        return $this->db->update('vehicle_advertisements', $data);
    }
    
    
    /*
     * This is the service function to get all pending advertisements
     */

    public function get_pending_advertisements() {

        $this->db->select('vehicle_advertisements.*,user.name as added_by_user,'
                . 'manufacture.name as manufacture,model.name as model,'
                . 'transmission.name as transmission,fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id');
        $this->db->join('transmission', 'transmission.id = vehicle_advertisements.transmission_id');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('user', 'user.id = vehicle_advertisements.added_by');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->where('vehicle_advertisements.is_published', '0');
        $this->db->order_by("vehicle_advertisements.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    
    
    /*
     * This is the service function to get all approved advertisements
     */

    public function get_approved_advertisements() {

        $this->db->select('vehicle_advertisements.*,user.name as added_by_user,'
                . 'manufacture.name as manufacture,model.name as model,'
                . 'transmission.name as transmission,fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id');
        $this->db->join('transmission', 'transmission.id = vehicle_advertisements.transmission_id');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('user', 'user.id = vehicle_advertisements.added_by');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->where('vehicle_advertisements.is_published', '1');
        $this->db->order_by("vehicle_advertisements.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    
     /*
     * This service function is to update publish status of a advertisement
     */
    public function publish_advertisement($vehicle_advertisments_model) {
        $data = array('is_published' => $vehicle_advertisments_model->get_is_published());
        $this->db->update('vehicle_advertisements', $data, array('id' => $vehicle_advertisments_model->get_id()));
        return $this->db->affected_rows();
    }
    
    function get_advertisement_by_id($id) {

        $query = $this->db->get_where('vehicle_advertisements', array('id' => $id));
        return $query->row();
    }
    
    
     /*
     * Get approved advertisments to featured advertisement 
     * Author - Nadeesha
     * 
     */
    
    function get_approved_advertisements_for_featured($limit) {

        $this->db->select('vehicle_advertisements.*,user.name as added_by_user,'
                . 'manufacture.name as manufacture,model.name as model,'
                . 'transmission.name as transmission,fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id');
        $this->db->join('transmission', 'transmission.id = vehicle_advertisements.transmission_id');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('user', 'user.id = vehicle_advertisements.added_by');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->where('vehicle_advertisements.is_published', '1');
        $this->db->order_by("vehicle_advertisements.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

}
