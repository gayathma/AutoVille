<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Body_type extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('USER_LOGGED_IN')) {
            redirect(site_url() . '/login/load_login');
        } else {
            $this->load->model('body_type/body_type_model');
            $this->load->model('body_type/body_type_service');
            
             $this->load->model('access_controll/access_controll_service');
        }
    }

    /*
     * Function to display all the body types
     */

    function manage_body_types() {

        $body_type_service = new Body_type_service();
        $data['heading'] = "Manage Body Types";
        $data['results'] = $body_type_service->get_all_body_types();

        $parials = array('content' => 'body_type/manage_body_type_view');
        $this->template->load('template/main_template', $parials, $data);
    }

    /*
     * Function to Add body types 
     */

    function add_body_type() {

        $body_type_model = new Body_type_model();
        $body_type_service = new Body_type_service();

        $body_type_model->set_name($this->input->post('name', TRUE));
        $body_type_model->set_added_by(3);
        $body_type_model->set_added_date(date("Y-m-d H:i:s"));
//        $body_type_model->set_updated_date(date("Y-m-d H:i:s"));
//        $body_type_model->set_updated_by(1);
        $body_type_model->set_is_published('1');
        $body_type_model->set_is_deleted('0');

        echo $body_type_service->add_new_body_type($body_type_model);
    }

    /*
     * Function to delete body types 
     */

    function delete_body_types() {
        $body_type_service = new Body_type_service();

        echo $body_type_service->delete_body_type(trim($this->input->post('id', TRUE)));
    }

    /*
     * Function to change publish status of a body type
     */

    function change_publish_status() {
        $body_type_model = new Body_type_model();
        $body_type_service = new Body_type_service();

        $body_type_model->set_id(trim($this->input->post('id', TRUE)));
        $body_type_model->set_is_published(trim($this->input->post('value', TRUE)));

        echo $body_type_service->publish_body_types($body_type_model);
    }

    /*
     * Function to load update pop up, edit and send
     */

    function load_update_body_type_popup() {
        $body_type_model = new Body_type_model();
        $body_type_service = new Body_type_service();

        $body_type_model->set_id(trim($this->input->post('body_type_id', TRUE)));
        $body_type = $body_type_service->get_body_type_by_id($body_type_model);
        $data['body_type'] = $body_type;

        echo $this->load->view('body_type/body_type_edit_popup', $data, TRUE);
    }

    /*
     * Function to update body types 
     */

    function update_body_types() {
        
        $body_type_model = new Body_type_model();
        $body_type_service = new Body_type_service();

        $body_type_model->set_id($this->input->post('body_type_id', TRUE));
        $body_type_model->set_name($this->input->post('name', TRUE));
        $body_type_model->set_updated_date(date("Y-m-d H:i:s"));

        echo $body_type_service->update_body_type($body_type_model);
    }

}
