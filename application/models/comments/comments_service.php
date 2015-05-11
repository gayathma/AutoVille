<?php

class Comments_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('comments/comments_model');
    }

    public function get_all_comments() {

        $this->db->select('*');
        $this->db->from('comment');
        $this->db->where('comment.is_deleted', '0');
        $this->db->where('comment.is_published', '1');
        $this->db->order_by("comment.added_date", "asc");
        $this->db->limit(2);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_comments_list() {

        $this->db->select('comment.*,user.name as added_by_user,user.profile_pic');
        $this->db->from('comment');
        $this->db->join('user', 'user.id = comment.added_by','left');
        $this->db->where('comment.is_deleted', '0');
        $this->db->where('comment.is_published', '1');
        $this->db->order_by("comment.added_date", "asc");
        $query = $this->db->get();
        return $query->result();
    }
    
    function add_website_comments($website_comments_model) {
        return $this->db->insert('comment', $website_comments_model);
    }

}
