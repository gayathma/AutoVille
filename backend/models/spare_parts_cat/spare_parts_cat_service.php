<?php

class Spare_parts_cat_service extends CI_Model {
    
    function __construct() {
        parent::__construct();
        $this->load->model("spare_parts_cat/category_model");
        
    }
    
   
    /*
     * Load All spare parts category Details from database     
     */

    public function get_all_body_types() {

        $this->db->select('body_type.*,user.name as added_by_user');
        $this->db->from('body_type');
        $this->db->join('user', 'user.id =body_type.added_by');
        $this->db->where('body_type.is_deleted', '0');
        $this->db->order_by("body_type.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Add new body type to database     
     */

    function add_new_body_type($body_type_model) {
        return $this->db->insert('body_type', $body_type_model);
    }

    /*
     * Delete body type from database     
     */

    function delete_body_type($body_type_id) {
        $data = array('is_deleted' => '1');
        $this->db->where('id', $body_type_id);
        return $this->db->update('body_type', $data);
    }

    /*
     * Change publish status of a body type    
     */

    public function publish_body_types($body_type_model) {
        $data = array('is_published' => $body_type_model->get_is_published());
        $this->db->update('body_type', $data, array('id' => $body_type_model->get_id()));
        return $this->db->affected_rows();
    }

    /*
     * Update body types   
     */

    function update_body_type($body_type_model) {
        $data = array('name' => $body_type_model->get_name(),
            'updated_date' => $body_type_model->get_updated_date(),
            'updated_by' => $body_type_model->get_updated_by());


        $this->db->where('id', $body_type_model->get_id());
        return $this->db->update('body_type', $data);
    }

    /*
     * get body types details by passing body_type id as a parameter
     */

    function get_body_type_by_id($body_type_model) {

        $data = array('id' => $body_type_model->get_id(), 'is_deleted' => '0');
        $query = $this->db->get_where('body_type', $data);
        return $query->row();
    }
}
