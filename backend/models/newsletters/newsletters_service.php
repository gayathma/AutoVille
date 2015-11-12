<?php

class Newsletters_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('newsletters/newsletters_model');
    }

    /**
     * get all newsletters that registered for newsletters
     */
    public function get_all_newsletters() {

        $this->db->select('newsletters.*');
        $this->db->from('newsletters');
        $this->db->where('status in ("0","1")');
        $this->db->order_by("newsletters.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * save newsletter in database  
     * @param object $newsletters_model Input model
     * @return boolean
     */
    function add_newsletter($newsletters_model) {
        return $this->db->insert('newsletters', $newsletters_model);
    }

    /**
     * This service function is to delete a transmission
     * @param integer $transmission_id Input transmission id
     * @return boolean
     */
    function delete_newsletter($newsletter_id) {
        $data = array('status' => '2');
        $this->db->where('id', $newsletter_id);
        return $this->db->update('newsletters', $data);
    }

    /**
     * get newsletter by id
     * @param integer $newsletter_id
     * @return object
     */
    function get_newsletter_by_id($newsletter_id) {
        $query = $this->db->get_where('newsletters', array('id' => $newsletter_id));
        return $query->row();
    }

    /**
     * update the manufacure
     * @param object $newsletters_model Input model
     * @return boolen
     */
    function update_newsletter($newsletters_model) {
        $data = array('subject' => $newsletters_model->get_subject(),
            'content' => $newsletters_model->get_content(),
            'status'  => $newsletters_model->get_status()
        );

        $this->db->where('id', $newsletters_model->get_id());
        return $this->db->update('newsletters', $data);
    }

}
