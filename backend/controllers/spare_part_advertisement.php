<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Spare_part_advertisement extends CI_Controller{
    
    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('USER_LOGGED_IN')) {
            redirect(site_url() . '/login/load_login');
        } else {
            $this->load->model('spare_parts_advertisement/spare_parts_ad_model');
            $this->load->model('spare_parts_advertisement/spare_parts_ad_service');

            $this->load->model('users/user_model');
            $this->load->model('users/user_service');

            $this->load->model('access_controll/access_controll_service');
        }
    }
    
    /*
     * This fuction will display all advertisements
     */
    
    function manage_advertisements() {

        $perm = Access_controll_service::check_access('ADD_ADVERTISEMENT');
        if ($perm) {
            $spare_parts_advertisments_service = new Spare_parts_ad_service();
            $user_service = new User_service();

            $data['heading'] = "Advertisements";
            $data['results'] = $spare_parts_advertisments_service->get_all_spare_part_advertisements();
            $data['reg_users'] = $user_service->get_all_active_registered_users();
          

            $parials = array('content' => 'spare_part_advertisements/manage_advertisements_view');
            $this->template->load('template/main_template', $parials, $data);
        }
    }
    
    /*
     * This function is to delete a advertisement
     */

    function delete_advertisement() {

        $spare_parts_advertisments_service = new Spare_parts_ad_service();

        echo $spare_parts_advertisments_service->delete_spare_part_advertisements(trim($this->input->post('id', TRUE)));
    }
    
    /*
     * This is to approve or reject advertisement
     */

    function change_publish_status() {
        $spare_parts_advertisments_model = new Spare_parts_ad_model();
        $spare_parts_advertisments_service = new Spare_parts_ad_service();

        $spare_parts_advertisments_model->set_id(trim($this->input->post('id', TRUE)));
        $spare_parts_advertisments_model->set_is_published(trim($this->input->post('value', TRUE)));

        echo $spare_parts_advertisments_service->publish_spare_part_advertisement($spare_parts_advertisments_model);
    }
    
    /*
     *  This function is to search advertisements
     */

    function search_advertisements() {

        $spare_parts_advertisments_service = new Spare_parts_ad_service();

        $data['results'] = $spare_parts_advertisments_service->get_all_spare_part_advertisements();

        $this->load->view('spare_part_advertisements/search_results_advertisements', $data);
    }
    
    /**
     * Function to get approved advertisements for featured advertisements
     * Author Ashani
     */
    
    function get_approved_advertisements() {

        $perm = Access_controll_service::check_access('ADD_ADVERTISEMENT');
        if ($perm) {
            $spare_parts_advertisments_service = new Spare_parts_ad_service();
            $user_service                  = new User_service();

            $data['heading']      = "Advertisements";
            $data['reg_users']    = $user_service->get_all_active_registered_users();
            $data['approved_ads'] = $spare_parts_advertisments_service->get_approved_advertisements_for_featured();


            $parials = array('content' => 'spare_part_advertisements/featured_advertisements_view');
            $this->template->load('template/main_template', $parials, $data);
        }
    }
    
    /*
     * change featured status of an advertisment
     * author - Ashani
     */

    function change_featured_status() {
        $spare_parts_advertisments_model = new Spare_parts_ad_model();
        $spare_parts_advertisments_service = new Spare_parts_ad_service();

        $spare_parts_advertisments_model->set_id(trim($this->input->post('id', TRUE)));
        $spare_parts_advertisments_model->set_is_featured(trim($this->input->post('value', TRUE)));

        echo $spare_parts_advertisments_service->featured_spare_part_advertisement($spare_parts_advertisments_model);
    }
}

