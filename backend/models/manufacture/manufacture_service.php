<?php

class Manufacture_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('manufacture/manufacture_model');
    }

    /*
     * Service function to add a new manufacture
     */

    function add_new_manufacture($manufacture_model) {
        return $this->db->insert('manufacture', $manufacture_model);
    }

    /*
     * service function to get all manufacure
     */

    public function get_all_manufactures() {

        $this->db->select('manufacture.*,user.name as added_by_user');
        $this->db->from('manufacture');
        $this->db->join('user', 'user.id = manufacture.added_by');
        $this->db->where('manufacture.is_deleted', '0');
        $this->db->order_by("manufacture.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * service function to deleter manufacture
     */

    public function delete_manufacture($manufacture_id) {
        $data = array('is_deleted' => '1');
        $this->db->where('id', $manufacture_id);
        return $this->db->update('manufacture', $data);
    }

    /*
     * service function to update publish status of a manufacture
     */

    public function publish_manufacture($manufacture_model) {
        $data = array('is_published' => $manufacture_model->get_is_published());
        $this->db->update('manufacture', $data, array('id' => $manufacture_model->get_id()));
        return $this->db->affected_rows();
    }

    /*
     * update the manufacure
     */

    function update_manufacure($manufacture_model) {
        $data = array('name' => $manufacture_model->get_name(),
            'logo' => $manufacture_model->get_logo(),
            'updated_date' => $manufacture_model->get_updated_date(),
            'updated_by' => $manufacture_model->get_updated_by()
        );

        $this->db->where('id', $manufacture_model->get_id());
        return $this->db->update('manufacture', $data);
    }

    /*
     * get the manufacture details by pasing the manufacture id as a parameter
     */

    function get_manufacure_by_id($manufacture_model) {
        $query = $this->db->get_where('manufacture', array('id' => $manufacture_model->get_id(), 'is_deleted' => '0'));
        return $query->row();
    }
    
    /*
     * update the manufacture logo
     */
     function update_manufacture_logo($manufacture_model) {
        $data = array('logo' => $manufacture_model->get_logo());
        $this->db->where('id', $manufacture_model->get_id());
        return $this->db->update('manufacture', $data);
    }
    

}
