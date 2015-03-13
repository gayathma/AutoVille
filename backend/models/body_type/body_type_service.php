<?php

class Body_type_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('body_type/body_type_model');
    }

    public function get_all_body_types() {

        $this->db->select('body_type.*,user.name as added_by_user');
        $this->db->from('body_type');
        $this->db->join('user', 'user.id =body_type.added_by');
        $this->db->where('body_type.is_deleted', '0');
        $this->db->order_by("body_type.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    function add_new_body_type($body_type_model) {
        return $this->db->insert('body_type', $body_type_model);
    }

    function delete_body_type($body_type_id) {
        $data = array('is_deleted' => '1');
        $this->db->where('id', $body_type_id);
        return $this->db->update('body_type', $data);
    }

    public function publish_body_types($body_type_model) {
        $data = array('is_published' => $body_type_model->get_is_published());
        $this->db->update('body_type', $data, array('id' => $body_type_model->get_id()));
        return $this->db->affected_rows();
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

