<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subscribe extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('USER_LOGGED_IN')) {
            redirect(site_url() . '/login/load_login');
        } else {
            $this->load->model('subscribers/subscribers_model');
            $this->load->model('subscribers/subscribers_service');
            
            $this->load->model('newsletters/newsletters_model');
            $this->load->model('newsletters/newsletters_service');

            $this->load->model('access_controll/access_controll_service');
        }
    }

    /*
     * This will display all the subscribers registered for newsletters
     */

    function manage_subscribers()
    {

        $subscribers_service = new Subscribers_service();

        $data['heading'] = "Manage Subscribers";
        $data['results'] = $subscribers_service->get_all_subscribers();

        $parials = array('content' => 'subscribers/manage_subscribers_view');
        $this->template->load('template/main_template', $parials, $data);
    }

    /*
     * This will display all newsletters
     */

    function manage_newsletters()
    {

        $newsletters_service = new Newsletters_service();

        $data['heading'] = "Manage Newsletters";
        $data['results'] = $newsletters_service->get_all_newsletters();

        $parials = array('content' => 'newsletters/manage_newsletters_view');
        $this->template->load('template/main_template', $parials, $data);
    }

    /*
     * This is to change the published status of the transmission 
     */

    function change_publish_status()
    {
        $transmission_model = new Transmission_model();
        $transmission_service = new Transmission_service();

        $transmission_model->set_id(trim($this->input->post('id', TRUE)));
        $transmission_model->set_is_published(trim($this->input->post('value', TRUE)));

        echo $transmission_service->publish_transmission($transmission_model);
    }

}
