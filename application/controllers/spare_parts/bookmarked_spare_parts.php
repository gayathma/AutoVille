<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bookmarked_spare_parts extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('bookmarked_spare_parts/bookmarked_spare_parts_model');
        $this->load->model('bookmarked_spare_parts/bookmarked_spare_parts_service');
    }

    /**
     * bookmark a spare part
     */
    function bookmark_spare_part() {

        $bookmarked_spare_parts_model   = new Bookmarked_spare_parts_model();
        $bookmarked_spare_parts_service = new Bookmarked_spare_parts_service();

        $bookmarked_spare_parts_model->set_user_id($this->session->userdata('USER_ID'));
        $bookmarked_spare_parts_model->set_spare_part_id($this->input->post('spare_part_id', TRUE));
        $bookmarked_spare_parts_model->set_is_deleted('0');
        $bookmarked_spare_parts_model->set_added_by($this->session->userdata('USER_ID'));
        $bookmarked_spare_parts_model->set_added_date(date("Y-m-d H:i:s"));

        echo $bookmarked_spare_parts_service->insert_bookmarked_spare_part($bookmarked_spare_parts_model);
    }

    /**
     * remove bookmark for a particular spare part
     */
    function remove_bookmark() {

        $bookmarked_spare_parts_model = new Bookmarked_spare_parts_service();
        echo $bookmarked_spare_parts_model->delete_bookmark($this->input->post('bookmark_id', TRUE));
    }

}
