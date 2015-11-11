<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class spare_parts_category extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('USER_LOGGED_IN')) {
            redirect(site_url() . '/login/load_login');
        } else {
            $this->load->model('spare_parts_cat/spare_parts_cat_model');
            $this->load->model('spare_parts_cat/spare_parts_cat_service');

            $this->load->model('access_controll/access_controll_service');
        }
    }

    /**
     * Function to display all the categories
     */
    function manage_categories() {

        $spare_parts_cat_service = new Spare_parts_cat_service();
        $data['heading'] = "Manage Category";
        $data['results'] = $spare_parts_cat_service->get_all_categories();

        $parials = array('content' => 'spare_part_category/manage_spare_part_category_view');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * Function to Add categories
     */
    function add_category() {

        $spare_parts_cat_model = new Spare_parts_cat_model();
        $spare_parts_cat_service = new Spare_parts_cat_service();

        $spare_parts_cat_model->set_name($this->input->post('name', TRUE));
        $spare_parts_cat_model->set_added_by(3);
        $spare_parts_cat_model->set_added_date(date("Y-m-d H:i:s"));
        $spare_parts_cat_model->set_is_published('1');
        $spare_parts_cat_model->set_is_deleted('0');

        echo $spare_parts_cat_service->add_new_body_type($spare_parts_cat_model);
    }

    /**
     * Function to delete categories
     */
    function delete_category() {
        $spare_parts_cat_service = new Spare_parts_cat_service();

        echo $spare_parts_cat_service->delete_category(trim($this->input->post('id', TRUE)));
    }

    /**
     * Function to change publish status of a category
     */
    function change_publish_status() {
        $spare_parts_cat_model = new Spare_parts_cat_model();
        $spare_parts_cat_service = new Spare_parts_cat_service();

        $spare_parts_cat_model->set_id(trim($this->input->post('id', TRUE)));
        $spare_parts_cat_model->set_is_published(trim($this->input->post('value', TRUE)));

        echo $spare_parts_cat_service->publish_category($spare_parts_cat_model);
    }

    /**
     * Function to load update pop up, edit and send
     */
    function load_update_category_popup() {
        $spare_parts_cat_model = new Spare_parts_cat_model();
        $spare_parts_cat_service = new Spare_parts_cat_service();

        $spare_parts_cat_model->set_id(trim($this->input->post('category_id', TRUE)));
        $category = $spare_parts_cat_service->get_category_by_id($spare_parts_cat_model);
        $data['category'] = $category;

        echo $this->load->view('spare_part_category/spare_part_category_edit_popup', $data, TRUE);
    }

    /*
     * Function to update Categories 
     */

    function update_category() {

        $spare_parts_cat_model = new Spare_parts_cat_model();
        $spare_parts_cat_service = new Spare_parts_cat_service();

        $spare_parts_cat_model->set_id($this->input->post('category_id', TRUE));
        $spare_parts_cat_model->set_name($this->input->post('name', TRUE));
        $spare_parts_cat_model->set_updated_date(date("Y-m-d H:i:s"));

        echo $spare_parts_cat_service->update_body_type($spare_parts_cat_model);
    }

}
