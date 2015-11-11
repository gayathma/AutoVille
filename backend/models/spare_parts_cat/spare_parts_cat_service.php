<?php

class Spare_parts_cat_service extends CI_Model {
    
    function __construct() {
        parent::__construct();
        $this->load->model("spare_parts_cat/spare_parts_cat_model");
        
    }
           
    /**
     * Load All spare parts category Details from database
     * @return type
     */

    public function get_all_categories() {

        $this->db->select('name.*,user.name as added_by_user');
        $this->db->from('spare_parts_cat');
        $this->db->join('user', 'user.id =spare_parts_cat.added_by');
        $this->db->where('spare_parts_cat.is_deleted', '0');
        $this->db->order_by("spare_parts_cat.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

        
    /**
     * Add new category to database
     * @param type $spare_parts_cat_model
     * @return type
     */

    function add_new_category($spare_parts_cat_model) {
        return $this->db->insert('spare_parts_cat', $spare_parts_cat_model);
    }

    /**
     * Delete category from database 
     * @param type $category_id
     * @return type
     */

    function delete_category($category_id) {
        $data = array('is_deleted' => '1');
        $this->db->where('id', $category_id);
        return $this->db->update('spare_parts_cat', $data);
    }
 
    /**
     * Change publish status of a Category
     * @param type $spare_parts_cat_model
     * @return type
     */

    public function publish_category($spare_parts_cat_model) {
        $data = array('is_published' => $spare_parts_cat_model->get_is_published());
        $this->db->update('spare_parts_cat', $data, array('id' => $spare_parts_cat_model->get_id()));
        return $this->db->affected_rows();
    }
    
    /**
     * Update categories
     * @param type $spare_parts_cat_model
     * @return type
     */

    function update_category($spare_parts_cat_model) {
        $data = array('name' => $spare_parts_cat_model->get_name(),
            'updated_date' => $spare_parts_cat_model->get_updated_date(),
            'updated_by' => $spare_parts_cat_model->get_updated_by());


        $this->db->where('id', $spare_parts_cat_model->get_id());
        return $this->db->update('spare_parts_cat', $data);
    }

    /**
     * get categories details by passing category id as a parameter
     * @param type $spare_parts_cat_model
     * @return type
     */
    function get_category_by_id($spare_parts_cat_model) {

        $data = array('id' => $spare_parts_cat_model->get_id(), 'is_deleted' => '0');
        $query = $this->db->get_where('spare_parts_cat', $data);
        return $query->row();
    }
}
