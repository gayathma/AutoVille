<?php

class Manufacture_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('manufacture/manufacture_model');
    }

    /*
     * service function to get all manufacure
     */
    public function get_all_active_manufactures_for_home() {

        $this->db->select('manufacture.name,
            manufacture.id');
        $this->db->from('manufacture');
        $this->db->where('manufacture.is_deleted', '0');
        $this->db->where('manufacture.is_published', '1');
        $this->db->order_by("manufacture.name", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * service function to get all manufacure
     */
    public function get_all_active_manufactures() {

        $this->db->select('manufacture.*');
        $this->db->from('manufacture');
        $this->db->where('manufacture.is_deleted', '0');
        $this->db->where('manufacture.is_published', '1');
        $this->db->order_by("manufacture.name", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * get the manufacture details by pasing the manufacture id as a parameter
     */
    function get_manufacure_by_id($manufacture_model) {
        $query = $this->db->get_where('manufacture', array('id'         => $manufacture_model->get_id(), 'is_deleted' => '0'));
        return $query->row();
    }

    /*
     * get names of all manufaturers
     */
    function get_manufacture_name() {
        $this->db->select('manufacture.name,
            manufacture.logo,
            model.name as modelname');
        $this->db->from('manufacture');
        $this->db->join('model', 'manufacture.id = model.manufacturer_id');
        $this->db->where('manufacture.is_deleted', '0');
        $this->db->where('manufacture.is_published', '1');
        $this->db->order_by("manufacture.name", "asc");
        $this->db->group_by('manufacture.name');
        $this->db->limit(12);
        $query = $this->db->get();
        return $query->result();
    }

}
