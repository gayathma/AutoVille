<?php

class Celebrity_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('celebrity/celebrity_model');
    }

    /*
     * get all celebrities service function
     */

    public function get_all_celebrities() {

        $this->db->select('celebrity.*,manufacture.name as manufacture,model.name as model');
        $this->db->from('celebrity');
        $this->db->join('manufacture', 'manufacture.id=celebrity.manufacture_id', 'left');
        $this->db->join('model', 'model.id=celebrity.model_id', 'left');
        $this->db->where('celebrity.is_deleted', '0');
        $this->db->order_by("celebrity.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * get all manufactures
     */

    public function get_all_manufactures() {
        $this->db->select('*');
        $this->db->from('manufacture');
        $this->db->where('manufacture.is_deleted', '0');
        $this->db->order_by("manufacture.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * get all models
     */

    public function get_all_models() {
        $this->db->select('*');
        $this->db->from('model');
        $this->db->where('model.is_deleted', '0');
        $this->db->order_by("model.added_date", "desc");
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

    /*
     * Service function to add a new celebrity
     */

    function add_new_celebrity($celebrity_model) {
        return $this->db->insert('celebrity', $celebrity_model);
    }

    /*
     * service function to update publish status of a celebrity
     */

    public function publish_celebrity($celebrity_model) {
        $data = array('is_published' => $celebrity_model->get_is_published());
        $this->db->update('celebrity', $data, array('id' => $celebrity_model->get_id()));
        return $this->db->affected_rows();
    }

    /*
     * update the celebrity
     */

    function update_celebrity($celebrity_model) {
        $data = array('name' => $celebrity_model->get_name(),
            'updated_date' => $celebrity_model->get_updated_date(),
            'updated_by' => $celebrity_model->get_updated_by()
        );

        $this->db->where('id', $celebrity_model->get_id());
        return $this->db->update('celebrity', $data);
    }

    /*
     * get the celebrity details by pasing the celebrity id as a parameter
     */

    function get_celebrity_by_id($celebrity_model) {
        $query = $this->db->get_where('celebrity', array('id' => $celebrity_model->get_id(), 'is_deleted' => '0'));
        return $query->row();
    }

}
