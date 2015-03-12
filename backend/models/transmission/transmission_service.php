<?php

class Transmission_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('transmission/transmission_model');
    }
    

    /*
     * This is the service function to add a new comapny
     */
    function add_new_transmission($transmission_model) {
        return $this->db->insert('transmission', $transmission_model);
    }

    
    function add_new_company_registration($company_model) {

        $this->db->insert('company', $company_model);
        return $this->db->insert_id();
    }

    
    /*
     * This is the service function to get all transmissions
     */
    public function get_all_transmissions() {

        $this->db->select('*');
        $this->db->from('transmission');
        $this->db->where('is_deleted','0');
        $this->db->order_by("added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    //update company
    function update_company($company_model) {

        $data = array('company_code' => $company_model->get_company_code(),
            'company_name' => $company_model->get_company_name(),
            'company_email' => $company_model->get_company_email(),
            'company_address' => $company_model->get_company_address(),
            'company_contact' => $company_model->get_company_contact(),
            'company_desc' => $company_model->get_company_desc(),
        );

        $this->db->where('company_Code', $company_model->get_company_code());
        return $this->db->update('company', $data);
    }
    

    /*
     * This is the service function to get company by company_id passing the 
     * company_code as a parameter
     */
    function get_company_by_id($company_code) {

        $query = $this->db->get_where('company', array('company_code' => $company_code,'del_ind'=>'1'));
        return $query->row();
    }
    
    /*
     * This service function is to delete a company
     */
    function delete_company($company_code) {
        $data = array('del_ind' => '0');
        $this->db->where('company_code', $company_code);
        return $this->db->update('company', $data);
    }

}
