<?php

class Celebrity_service extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->model('celebrity/celebrity_model');
    }
    
    /*
     * get all celebrities service function
     */
    
    public function get_all_celebrities() {

        $this->db->select('*');
        $this->db->from('celebrity');
        $this->db->where('celebrity.is_deleted', '0');
        $this->db->order_by("celebrity.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    
    /*
     * delete celebrity service function
     */
    
    public function delete_celebrity($celebrity_id) {
        $data = array('is_deleted' => '1');
        $this->db->where('id', $celebrity_id);
        return $this->db->update('celebrity', $data);
    }
    
    
    
}

