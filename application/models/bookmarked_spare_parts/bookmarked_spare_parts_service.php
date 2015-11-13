<?php

class Bookmarked_spare_parts_service extends CI_Model {

    function __construct() {
        parent::__construct();
        
         $this->load->model('bookmarked_spare_parts/bookmarked_spare_parts_model');
    }

    function insert_bookmarked_spare_part($bookmarked_spare_parts_model) {
        $this->db->insert('bookmarked_spare_parts', $bookmarked_spare_parts_model);
        return $this->db->insert_id();
    }

    function delete_bookmark($bookmark_id) {

        $this->db->where('id', $bookmark_id);
        return $this->db->delete('bookmarked_spare_parts');
    }

    function get_bookmarked_spare_parts($limit, $start, $user_id) {
        
        $this->db->select('bookmarked_spare_parts.id as bookmark_id,'
                . 'spare_parts_advertisements.id,'
                . 'spare_parts_advertisements.description,'
                . 'spare_parts_advertisements.year,'
                . 'spare_parts_advertisements.price,'
                . 'spare_parts_advertisements.image,'
                . 'manufacture.name as manufacture,'
                . 'model.name as model,' 
                . 'fuel_type.name as fuel_type');
        $this->db->from('bookmarked_spare_parts');
        $this->db->join('spare_parts_advertisements', 'spare_parts_advertisements.id = bookmarked_spare_parts.spare_part_id');
        $this->db->join('manufacture', 'manufacture.id = spare_parts_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = spare_parts_advertisements.model_id');        
        $this->db->join('fuel_type', 'fuel_type.id = spare_parts_advertisements.fuel_type_id');
        $this->db->where('bookmarked_spare_parts.is_deleted', '0');
        $this->db->where('spare_parts_advertisements.is_deleted', '0');
        $this->db->where('bookmarked_spare_parts.added_by', $user_id);
        $this->db->group_by('spare_parts_advertisements.id');
        if ($limit != '' && $start != '') {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();
//        echo $this->db->last_query();
//        die();
        return $query->result();
    }

    function get_bookmarkd_spare_part($user_id, $spare_part_id) {

        $this->db->select('bookmarked_spare_parts.id as bookmarked_id,bookmarked_spare_parts.user_id as bookmarked_user');
        $this->db->from('bookmarked_spare_parts');
        $this->db->where('bookmarked_spare_parts.user_id', $user_id);
        $this->db->where('bookmarked_spare_parts.spare_part_id', $spare_part_id);
        $query = $this->db->get();
        return $query->row();
    }

}
