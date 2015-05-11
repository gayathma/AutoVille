<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle_advertisements extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('USER_LOGGED_IN')) {
            redirect(site_url() . '/login/load_login');
        } else {
            $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
            $this->load->model('vehicle_advertisments/vehicle_advertisments_service');

            $this->load->model('users/user_model');
            $this->load->model('users/user_service');

            $this->load->model('access_controll/access_controll_service');
        }
    }

    /* manage_advertisements function
     * This will display all the advertisements
     */

    function manage_advertisements() {

        $perm = Access_controll_service::check_access('ADD_ADVERTISEMENT');
        if ($perm) {
            $vehicle_advertisments_service = new Vehicle_advertisments_service();
            $user_service = new User_service();

            $data['heading'] = "Advertisements";
            $data['results'] = $vehicle_advertisments_service->get_all_advertisements();
            $data['reg_users'] = $user_service->get_all_active_registered_users();
          

            $parials = array('content' => 'vehicle_advertisements/manage_advertisements_view');
            $this->template->load('template/main_template', $parials, $data);
        }
    }

    /*
     *  This function is to search advertisements
     */

    function search_advertisements() {

        $vehicle_advertisments_service = new Vehicle_advertisments_service();

        $data['results'] = $vehicle_advertisments_service->search_advertisements();

        $this->load->view('vehicle_advertisements/search_results_advertisements', $data);
    }

    /*
     * This is to delete a advertisement
     */

    function delete_advertisement() {

        $vehicle_advertisments_service = new Vehicle_advertisments_service();

        echo $vehicle_advertisments_service->delete_advertisement(trim($this->input->post('id', TRUE)));
    }

    /*
     * This is to approve or reject advertisement
     */

    function change_publish_status() {
        $vehicle_advertisments_model = new Vehicle_advertisments_model();
        $vehicle_advertisments_service = new Vehicle_advertisments_service();

        $vehicle_advertisments_model->set_id(trim($this->input->post('id', TRUE)));
        $vehicle_advertisments_model->set_is_published(trim($this->input->post('value', TRUE)));

        echo $vehicle_advertisments_service->publish_advertisement($vehicle_advertisments_model);
    }

    /*
     * Function to get approved advertisements for featured vehicles
     * Author - nadeesha
     */
    
     function get_Approved_advertisements() {

        $perm = Access_controll_service::check_access('ADD_ADVERTISEMENT');
        if ($perm) {
            $vehicle_advertisments_service = new Vehicle_advertisments_service();
            $user_service = new User_service();

            $data['heading'] = "Advertisements";           
            $data['reg_users'] = $user_service->get_all_active_registered_users();
            $data['approved_ads'] = $vehicle_advertisments_service->get_approved_advertisements_for_featured(4);
            

            $parials = array('content' =>'vehicle_advertisements/featured_advertisements_view');
            $this->template->load('template/main_template', $parials, $data);
        }
    }
}
