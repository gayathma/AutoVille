<?php

class Faq_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('faq/faq_model');
    }

    /**
     * get recent questions that are published
     */
    public function get_all_questions() {
        $this->db->select('faq.question,faq.answer');
        $this->db->from('faq');
        $this->db->where('faq.is_deleted', '0');
        $this->db->where('faq.is_published', '1');
        $this->db->order_by("faq.added_date", "desc");
        $this->db->limit(2);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * get all questions that are published
     */
    public function get_all_questions_list() {
        $this->db->select('faq.*,user.name as added_by_user,user.profile_pic');
        $this->db->from('faq');
        $this->db->join('user', 'user.id=faq.added_by', 'left');
        $this->db->where('faq.is_deleted', '0');
        $this->db->where('faq.is_published', '1');
        $this->db->order_by("faq.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * save question in database
     * @param object $faq_model Input model
     * @return boolean
     */
    public function add_questions($faq_model) {
        return $this->db->insert('faq', $faq_model);
    }

}
