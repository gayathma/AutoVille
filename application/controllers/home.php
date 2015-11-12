<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('manufacture/manufacture_model');
        $this->load->model('manufacture/manufacture_service');

        $this->load->model('vehicle_model/vehicle_model_model');
        $this->load->model('vehicle_model/vehicle_model_service');

        $this->load->model('body_type/body_type_model');
        $this->load->model('body_type/body_type_service');

        $this->load->model('fuel_type/fuel_type_model');
        $this->load->model('fuel_type/fuel_type_service');

        $this->load->model('transmission/transmission_model');
        $this->load->model('transmission/transmission_service');

        $this->load->model('district/district_model');
        $this->load->model('district/district_service');

        $this->load->model('contents/content_model');
        $this->load->model('contents/content_service');


        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');

        $this->load->model('vehicle_news/vehicle_news_model');
        $this->load->model('vehicle_news/vehicle_news_service');

        $this->load->model('comments/comments_model');
        $this->load->model('comments/comments_service');

        $this->load->model('subscribers/subscribers_model');
        $this->load->model('subscribers/subscribers_service');
    }

    /**
     * load about us page details
     * and display the page
     */
    function about_us() {
        $manufacture_service           = new Manufacture_service();
        $body_type_service             = new Body_type_service();
        $fuel_type_service             = new Fuel_Type_service();
        $transmission_service          = new Transmission_service();
        $district_service              = new District_service();
        $content_service               = new Content_service();
        $vehicle_advertisments_service = new Vehicle_advertisments_service();
        $vehicle_news_service          = new Vehicle_news_service();
        $comment_service               = new Comments_service();

        $data['website_comments'] = $comment_service->get_all_comments();
        $data['manufactures']     = $manufacture_service->get_all_active_manufactures_for_home();
        $data['body_types']       = $body_type_service->get_all_active_body_types();
        $data['fuel_types']       = $fuel_type_service->get_all_active_fuel_types();
        $data['transmissions']    = $transmission_service->get_all_active_transmissions();
        $data['locations']        = $district_service->get_all_districts();
        $data['why_us']           = $content_service->get_content_by_hcodes('WHYUS');
        if (isset($this->session)) {
            $vehicle_results = $vehicle_advertisments_service->get_recently_viewed_vehicles($this->session->userdata('USER_ID'));
        }
        $data['vehicle_results'] = $vehicle_results;

        $data['names'] = $manufacture_service->get_manufacture_name();

        $data['price_drop_vehicles']  = $vehicle_advertisments_service->get_price_drop_vehicles(4); //Ashani
        $data['latest_vehicles']      = $vehicle_advertisments_service->get_new_arrival(2);  //author-Ishani
        $data['vehicle_news_results'] = $vehicle_news_service->get_vehicle_news();      //author-Ishani
        $data['featured_vehicles']    = $vehicle_advertisments_service->get_featured_advertisements(4);
        $data['popular_vehicles']     = $vehicle_advertisments_service->get_popular_advertisements(4); //Ashanis']    = $vehicle_advertisments_service->get_popular_advertisements(4);//Ashani

        $parials = array('content' => 'content_pages/about_us', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * load the home page of the site
     */
    function index() {

        $manufacture_service           = new Manufacture_service();
        $body_type_service             = new Body_type_service();
        $fuel_type_service             = new Fuel_Type_service();
        $transmission_service          = new Transmission_service();
        $district_service              = new District_service();
        $content_service               = new Content_service();
        $vehicle_advertisments_service = new Vehicle_advertisments_service();
        $vehicle_news_service          = new Vehicle_news_service();
        $comment_service               = new Comments_service();

        $data['website_comments'] = $comment_service->get_all_comments();
        $data['manufactures']     = $manufacture_service->get_all_active_manufactures_for_home();
        $data['body_types']       = $body_type_service->get_all_active_body_types();
        $data['fuel_types']       = $fuel_type_service->get_all_active_fuel_types();
        $data['transmissions']    = $transmission_service->get_all_active_transmissions();
        $data['locations']        = $district_service->get_all_districts();
        $data['why_us']           = $content_service->get_content_by_hcodes('WHYUS');
        if (isset($this->session)) {
            $vehicle_results = $vehicle_advertisments_service->get_recently_viewed_vehicles($this->session->userdata('USER_ID'));
        }
        $data['vehicle_results'] = $vehicle_results;

        $data['names'] = $manufacture_service->get_manufacture_name();

        $data['price_drop_vehicles']  = $vehicle_advertisments_service->get_price_drop_vehicles(4); //Ashani
        $data['latest_vehicles']      = $vehicle_advertisments_service->get_new_arrival(2);  //author-Ishani
        $data['vehicle_news_results'] = $vehicle_news_service->get_vehicle_news();      //author-Ishani
        $data['featured_vehicles']    = $vehicle_advertisments_service->get_featured_advertisements(4);
        $data['popular_vehicles']     = $vehicle_advertisments_service->get_popular_advertisements(); //Ashani

        $parials = array('content' => 'content_pages/home_content', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * set subscriber Details
     * and save them in database
     */
    function subscribe() {
        $subscribers_model   = new Subscribers_model();
        $subscribers_service = new Subscribers_service();

        //check whether user is already subscribed or not
        $subscriber = $subscribers_service->get_subscriber($this->input->post('subscribe_email', TRUE));
        if (empty($subscriber)) {
            $subscribers_model->set_email($this->input->post('subscribe_email', TRUE));
            $subscribers_model->set_status('1');
            $subscribers_model->set_added_date(date("Y-m-d H:i:s"));

            echo $subscribers_service->add_subscribers($subscribers_model);
        } else {
            echo 0;
        }
    }

    function unsubscribe() {
        $subscribers_service = new Subscribers_service();
        if ($subscribers_service->unsubscribe($_GET['email'])) {
            redirect(site_url() . '/home/unsubscribe_success');
        } else {
            redirect(site_url() . '/home/unsubscribe_failed');
        }
    }

    function unsubscribe_success() {
        $data['status']  = 'success';
        $data['message'] = "Your email address has been removed from our distribution list. We are sorry for any inconvenience we may have caused you.";

        $parials = array('content' => 'messages/unsubscribe_message');
        $this->template->load('template/main_template', $parials, $data);
    }

    function unsubscribe_failed() {
        $data['status']  = 'failed';
        $data['message'] = "Your email address has been already removed from our distribution list. We are sorry for any inconvenience we may have caused you.";

        $parials = array('content' => 'messages/unsubscribe_message');
        $this->template->load('template/main_template', $parials, $data);
    }

}
