<?php

class Subscribers_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('subscribers/subscribers_model');
    }

    /**
     * get all subscribers that registered for newsletters
     */
    public function get_all_subscribers() {

        $this->db->select('subscribers.*');
        $this->db->from('subscribers');
        $this->db->order_by("subscribers.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * get all active subscriber
     */
    public function get_active_subscribers() {

        $this->db->select('subscribers.*');
        $this->db->from('subscribers');
        $this->db->where('status', '1');
        $this->db->order_by("subscribers.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

}
