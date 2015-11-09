<?php

class Celebrity extends CI_Controller{
    
    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('USER_LOGGED_IN')) {
            redirect(site_url() . '/login/load_login');
        } else {
            $this->load->model('celebrity/celebrity_model');
            $this->load->model('celebrity/celebrity_service');
            
            $this->load->model('access_controll/access_controll_service');
        }
    }
    
    /* manage celebrity functions
     * this will display all the celebrity
     */

    function manage_celebrity() {

        $celebrity_service = new Celebrity_model();

        $data['heading'] = "Manage Celebrity";
        $data['results'] = $celebrity_service->get_all_celebrities();

        $parials = array('content' => 'celebrity/manage_celebrity_view');
        $this->template->load('template/main_template', $parials, $data);
    }
    
    /*
     * adding a celebrity
     */

    function add_celebrity() {
        $celebrity_model = new Celebrity_model();
        $celebrity_service = new Celebrity_service();

        $celebrity_model->set_name($this->input->post('name', TRUE));
        $celebrity_model->set_manufacture_id($this->input->post('manufacture_id', TRUE));
        $celebrity_model->set_model_id($this->input->post('model_id', TRUE));
        $celebrity_model->set_description($this->input->post('description', TRUE));
        $celebrity_model->set_image($this->input->post('image', TRUE));
        $celebrity_model->set_added_by($this->session->userdata('USER_ID'));
        $celebrity_model->set_added_date(date("Y-m-d H:i:s"));        
        $celebrity_model->set_is_published('1');
        $celebrity_model->set_is_deleted('0');

        echo $celebrity_service->add_new_celebrity($celebrity_model);
    }

    /*
     * Delete celebrity
     */

    function delete_celebrity() {
        $celebrity_service = new Celebrity_service();
        echo $celebrity_service->delete_celebrity(trim($this->input->post('id', TRUE)));
    }

    /*
     * change the publish status of the celebrity
     */

    function change_publish_status() {
        $celebrity_model = new Celebrity_model();
        $celebrity_service = new Celebrity_service();

        $celebrity_model->set_id(trim($this->input->post('id', TRUE)));
        $celebrity_model->set_is_published(trim($this->input->post('value', TRUE)));

        echo $celebrity_service->publish_celebrity($celebrity_model);
    }

    /*
     * Edit celebrity pop up content set up and then send
     */

    function load_edit_celebrity_content() {
        $celebrity_model = new Celebrity_model();
        $celebrity_service = new Celebrity_service();

        $celebrity_model->set_id(trim($this->input->post('celebrity_id', TRUE)));
        $celebrity = $celebrity_service->get_celebrity_by_id($celebrity_model);
        $data['celebrity'] = $celebrity;

        echo $this->load->view('celebrity/celebrity_edit_pop_up', $data, TRUE);
    }

    /*
     * update the celebrity details
     */

    function edit_manufacture() {
        $manufacure_model = new Manufacture_model();
        $manufacure_service = new Manufacture_service();

        $manufacure_model->set_id($this->input->post('manufacture_id', TRUE));
        $manufacure_model->set_name($this->input->post('name', TRUE));
        $manufacure_model->set_updated_by($this->session->userdata('USER_ID'));
        $manufacure_model->set_updated_date(date("Y-m-d H:i:s"));
   
        echo $manufacure_service->update_manufacure($manufacure_model);
    }

    /*
     * This function is to upload manufacture logo
     */

    function upload_manufacture_logo() {

        $uploaddir = './uploads/manufacture_logo/';
        $unique_tag = 'manufacture_logo';

        $filename = $unique_tag . time() . '-' . basename($_FILES['uploadfile']['name']); //this is the file name
        $file = $uploaddir . $filename; // this is the full path of the uploaded file

        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
            echo $filename;
        } else {
            echo "error";
        }
    }

}