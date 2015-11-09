<?php

class Newsletters_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('newsletters/newsletters_model');
    }

    /*
     * get all newsletters that registered for newsletters
     */
    public function get_all_newsletters() {

        $this->db->select('newsletters.*');
        $this->db->from('newsletters');
        $this->db->order_by("newsletters.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

}
