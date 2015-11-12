<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle_advertisements extends CI_Controller {

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

        $this->load->model('equipment/equipment_model');
        $this->load->model('equipment/equipment_service');

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');

        $this->load->model('vehicle_images_temp/vehicle_images_temp_model');
        $this->load->model('vehicle_images_temp/vehicle_images_temp_service');


        $this->load->model('vehicle_images/vehicle_images_model');
        $this->load->model('vehicle_images/vehicle_images_service');

        $this->load->model('district/district_model');
        $this->load->model('district/district_service');

        $this->load->model('users/user_model');
        $this->load->model('users/user_service');

        $this->load->model('vehicle_equipment/vehicle_equipment_model');
        $this->load->model('vehicle_equipment/vehicle_equipment_service');

        $this->load->model('searched_vehicles/searched_vehicles_model');
        $this->load->model('searched_vehicles/searched_vehicles_service');

        $this->load->model('vehicle_reviews/vehicle_reviews_model');
        $this->load->model('vehicle_reviews/vehicle_reviews_service');

        $this->load->model('website_advertisements/website_advertisements_model');
        $this->load->model('website_advertisements/website_advertisements_service');

        $this->load->library('email');
        $this->load->library('sms_handler');
        
        $this->load->model('seller_subscribers/seller_subscribers_service');
    }

    /**
     * post a new advertisement
     */
    function post_new_advertisement() {

        $manufacture_service           = new Manufacture_service();
        $vehicle_model_service         = new Vehicle_model_service();
        $body_type_service             = new Body_type_service();
        $fuel_type_service             = new Fuel_Type_service();
        $transmission_service          = new Transmission_service();
        $equipment_service             = new Equipment_service();
        $vehicle_advertisement_service = new Vehicle_advertisments_service();
        $vehicle_images_temp_service   = new Vehicle_images_temp_service();
        $district_service              = new District_service();
        $vehicle_advertisments_service = new Vehicle_advertisments_service();



        $data['heading']       = "Sell your vehicle";
        $data['manufactures']  = $manufacture_service->get_all_active_manufactures();
        $data['models']        = $vehicle_model_service->get_all_active_vehicle_models();
        $data['body_types']    = $body_type_service->get_all_active_body_types();
        $data['fuel_types']    = $fuel_type_service->get_all_active_fuel_types();
        $data['transmissions'] = $transmission_service->get_all_active_transmissions();
        $data['equipments']    = $equipment_service->get_all_active_equipment();
        $data['locations']     = $district_service->get_all_districts();



        $vehicle_images_temp_service->truncate_temp_images();

        $result  = $vehicle_advertisement_service->get_last_advertisement_id();
        $last_id = '';
        if (!empty($result)) {
            $last_id = $result->id + 1;
        } else {
            $last_id = 1;
        }

        $data['last_id']         = $last_id;
        $data['latest_vehicles'] = $vehicle_advertisments_service->get_new_arrival(2);

        $parials = array('content' => 'vehicle_adds/add_new_advertisement', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * edit advertisement
     * @param integer $advertisement_id Input advertisement id
     */
    function edit_new_advertisement($advertisement_id) {


        $_POST['last_vehicle_id'] = $advertisement_id;

        $manufacture_service           = new Manufacture_service();
        $vehicle_model_service         = new Vehicle_model_service();
        $body_type_service             = new Body_type_service();
        $fuel_type_service             = new Fuel_Type_service();
        $transmission_service          = new Transmission_service();
        $equipment_service             = new Equipment_service();
        $vehicle_advertisement_service = new Vehicle_advertisments_service();
        $vehicle_equipment_service     = new Vehicle_equipment_service();
        $district_service              = new District_service();
        $vehicle_images_service        = new Vehicle_images_service();

        $data['heading']               = "Sell your vehicle";
        $data['manufactures']          = $manufacture_service->get_all_active_manufactures();
        $data['models']                = $vehicle_model_service->get_all_active_vehicle_models();
        $data['body_types']            = $body_type_service->get_all_active_body_types();
        $data['fuel_types']            = $fuel_type_service->get_all_active_fuel_types();
        $data['transmissions']         = $transmission_service->get_all_active_transmissions();
        $data['equipments']            = $equipment_service->get_all_active_equipment();
        $data['locations']             = $district_service->get_all_districts();
        $data['vehicle_advertisement'] = $vehicle_advertisement_service->get_advertisement_by_id($advertisement_id);
        $vehicle_equipments            = $vehicle_equipment_service->get_equipments_by_vehicle_id($advertisement_id);
        $equipment_array               = array();
        $data['vehicle_images']        = $vehicle_images_service->get_images_for_advertisement($advertisement_id);


        foreach ($vehicle_equipments as $value) {
            $equipment_array[] = $value->equipment_id;
        }

        $data['vehicle_equipments'] = $equipment_array;
        $data['latest_vehicles']    = $vehicle_advertisement_service->get_new_arrival(2);

        $parials = array('content' => 'vehicle_adds/edit_advertisement', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * add vehicle images to a temporary location
     */
    function add_temp_vehicle_images() {

        $vehicle_images_temp_model   = new Vehicle_images_temp_model();
        $vehicle_images_temp_service = new Vehicle_images_temp_service();

        $files = $this->input->post('file_name', TRUE);
        foreach ($files as $file) {

            $vehicle_images_temp_model->set_image_path($file);
            $vehicle_images_temp_model->set_is_published('1');
            $vehicle_images_temp_model->set_added_date(date("Y-m-d H:i:s"));
            $vehicle_images_temp_model->set_added_by($this->session->userdata('USER_ID'));


            echo $vehicle_images_temp_service->add_new_temp_images($vehicle_images_temp_model);
        }
    }

    /**
     * Add new vehicle advertisements
     */
    function add_new_advertisement() {
//        $perm = Access_controllerservice :: checkAccess('ADD_PRIVILEGES');
//        if ($perm) {

        $vehicle_advertisement_model   = new Vehicle_advertisments_model();
        $vehicle_advertisement_service = new Vehicle_advertisments_service();
        $vehicle_images_temp_service   = new Vehicle_images_temp_service();
        $vehicle_images_service        = new Vehicle_images_service();
        $vehicle_images_model          = new Vehicle_images_model();
        $vehicle_equipment_model       = new Vehicle_equipment_model();
        $vehicle_equipment_service     = new Vehicle_equipment_service();

        $temp_images = $vehicle_images_temp_service->get_all_temp_images_for_user($this->session->userdata('USER_ID'));

        $marker_position = $this->input->post('marker_position');
        $marker_position = str_replace(array('(', ')'), '', $marker_position);
        $cordinates      = explode(',', $marker_position);


        $vehicle_advertisement_model->set_model_id($this->input->post('model', TRUE));
        $vehicle_advertisement_model->set_manufacture_id($this->input->post('manufacturer', TRUE));
        $vehicle_advertisement_model->set_description($this->input->post('description', TRUE));
        $vehicle_advertisement_model->set_fuel_type_id($this->input->post('fuel_type', TRUE));
        $vehicle_advertisement_model->set_year($this->input->post('fabrication', TRUE));
        $vehicle_advertisement_model->set_transmission_id($this->input->post('transmission', TRUE));
        $vehicle_advertisement_model->set_body_type_id($this->input->post('body_type', TRUE));
        $vehicle_advertisement_model->set_doors($this->input->post('doors'));
        $vehicle_advertisement_model->set_location_id($this->input->post('location'));
        $vehicle_advertisement_model->set_colour($this->input->post('colour'));
        $vehicle_advertisement_model->set_sale_type($this->input->post('sale_type'));
        $vehicle_advertisement_model->set_chassis_no($this->input->post('chassis_no'));
        $vehicle_advertisement_model->set_kilometers($this->input->post('kilo_meters'));
        $vehicle_advertisement_model->set_price($this->input->post('price'));
        $vehicle_advertisement_model->set_latitude($cordinates[0]);
        $vehicle_advertisement_model->set_longitude($cordinates[1]);
        $vehicle_advertisement_model->set_is_deleted('0');
        $vehicle_advertisement_model->set_is_featured('0');
        $vehicle_advertisement_model->set_is_price_drop('0');
        $vehicle_advertisement_model->set_is_published('0');
        $vehicle_advertisement_model->set_added_date(date("Y-m-d H:i:s"));
        $vehicle_advertisement_model->set_added_by($this->session->userdata('USER_ID'));

        $advertisement_id = $vehicle_advertisement_service->add_new_advertisements($vehicle_advertisement_model);
        $msg              = 1;

        $equipments = $this->input->post('equipment', TRUE);

        if (!empty($equipments)) {
            foreach ($equipments as $equipment) {

                $vehicle_equipment_model->set_equipment_id($equipment);
                $vehicle_equipment_model->set_vehicle_id($advertisement_id);
                $vehicle_equipment_service->add_new_vehicle_equipment($vehicle_equipment_model);
            }
        }

        foreach ($temp_images as $image) {
            $vehicle_images_model->set_image_path($image->image_path);
            $vehicle_images_model->set_vehicle_id($advertisement_id);
            $vehicle_images_model->set_is_published('1');
            $vehicle_images_model->set_is_deleted('0');
            $vehicle_images_model->set_added_date(date("Y-m-d H:i:s"));
            $vehicle_images_model->set_added_by($this->session->userdata('USER_ID'));

            $msg = $vehicle_images_service->add_new_images($vehicle_images_model);
        }

        if ($msg == '1') {
            $email         = 'gayathma3@gmail.com';
            $email_subject = "AutoVille New Advertisement";
            $data['msg']   = "New Advertisement submitted!!";
            $mseg          = $this->load->view('template/mail_template/body_ask', $data, TRUE);

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: AutoVille <autoville@gmail.com>' . "\r\n";
            $headers .= 'Cc: gayathma3@gmail.com' . "\r\n";

            mail($email, $email_subject, $mseg, $headers);

            //sms to admins
            $message = "New Advertisement has submitted. \n ";
        }

        echo $msg;

//        } else {
//            $this->template->load('template/access_denied_page');
//        }
    }

    /**
     * Edit vehicle advertisements
     */
    function edit_advertisement() {


        $vehicle_advertisement_model   = new Vehicle_advertisments_model();
        $vehicle_advertisement_service = new Vehicle_advertisments_service();
        $vehicle_images_temp_service   = new Vehicle_images_temp_service();
        $vehicle_images_service        = new Vehicle_images_service();
        $vehicle_images_model          = new Vehicle_images_model();
        $vehicle_equipment_model       = new Vehicle_equipment_model();
        $vehicle_equipment_service     = new Vehicle_equipment_service();

        $advertisement_id = $this->input->post('vehicle_id', TRUE);
        $temp_images      = $vehicle_images_temp_service->get_all_temp_images_for_user($this->session->userdata('USER_ID'));

        $marker_position = $this->input->post('marker_position');
        $marker_position = str_replace(array('(', ')'), '', $marker_position);
        $cordinates      = explode(',', $marker_position);

        $vehicle_advertisement_model->set_id($advertisement_id);
        $vehicle_advertisement_model->set_model_id($this->input->post('model', TRUE));
        $vehicle_advertisement_model->set_manufacture_id($this->input->post('manufacturer', TRUE));
        $vehicle_advertisement_model->set_description($this->input->post('description', TRUE));
        $vehicle_advertisement_model->set_fuel_type_id($this->input->post('fuel_type', TRUE));
        $vehicle_advertisement_model->set_year($this->input->post('fabrication', TRUE));
        $vehicle_advertisement_model->set_transmission_id($this->input->post('transmission', TRUE));
        $vehicle_advertisement_model->set_body_type_id($this->input->post('body_type', TRUE));
        $vehicle_advertisement_model->set_doors($this->input->post('doors'));
        $vehicle_advertisement_model->set_location_id($this->input->post('location'));
        $vehicle_advertisement_model->set_colour($this->input->post('colour'));
        $vehicle_advertisement_model->set_sale_type($this->input->post('sale_type'));
        $vehicle_advertisement_model->set_chassis_no($this->input->post('chassis_no'));
        $vehicle_advertisement_model->set_kilometers($this->input->post('kilo_meters'));
        $vehicle_advertisement_model->set_latitude($cordinates[0]);
        $vehicle_advertisement_model->set_longitude($cordinates[1]);
        $vehicle_advertisement_model->set_price($this->input->post('price'));
        if ($this->input->post('price') < $this->input->post('price_old')) {
            $vehicle_advertisement_model->set_is_price_drop('1');
        } else {
            $vehicle_advertisement_model->set_is_price_drop('0');
        }

        $vehicle_advertisement_model->set_updated_date(date("Y-m-d H:i:s"));
        $vehicle_advertisement_model->set_updated_by($this->session->userdata('USER_ID'));



        $msg = $vehicle_advertisement_service->update_vehicle_advertisement($vehicle_advertisement_model);

        //remove exsisting equipments
        $vehicle_equipment_service->remove_equipments_for_vehicle_add($advertisement_id);

        $equipments = $this->input->post('equipment', TRUE);

        if (!empty($equipments)) {
            foreach ($equipments as $equipment) {

                $vehicle_equipment_model->set_equipment_id($equipment);
                $vehicle_equipment_model->set_vehicle_id($advertisement_id);
                $vehicle_equipment_service->add_new_vehicle_equipment($vehicle_equipment_model);
            }
        }

        foreach ($temp_images as $image) {
            $vehicle_images_model->set_image_path($image->image_path);
            $vehicle_images_model->set_vehicle_id($advertisement_id);
            $vehicle_images_model->set_is_published('1');
            $vehicle_images_model->set_is_deleted('0');
            $vehicle_images_model->set_added_date(date("Y-m-d H:i:s"));
            $vehicle_images_model->set_added_by($this->session->userdata('USER_ID'));

            $msg = $vehicle_images_service->add_new_images($vehicle_images_model);
        }

        echo $msg;
    }

    /**
     * get vehicle models for manufacturer
     */
    public function get_models_for_manufacturer() {
        $vehicle_model_service = new Vehicle_model_service();

        $models = $vehicle_model_service->get_vehicle_model_by_manufacture($this->input->post('manufacturer'));

        echo '<select name="model" id="model" title="This field is required." data-live-search="true">';
        echo '<option value="">Select Model</option>';
        foreach ($models as $model) {

            echo '<option value="' . $model->id . '">' . $model->name . '</option>';
        }

        echo '</select>';
    }

    /**
     * load vehicle advertisement detail view
     * @param integer $id Input vehicle id
     */
    public function vehicle_advertisement_detail_view($id) {
        $vehicle_advertisments_service = new Vehicle_advertisments_service();
        $vehicle_images_service        = new Vehicle_images_service();
        $searched_vehicles_model       = new Searched_vehicles_model();
        $searched_vehicles_service     = new Searched_vehicles_service();
        $vehicle_reviews_service       = new Vehicle_reviews_service();
        $vehicle_equipment_service     = new Vehicle_equipment_service();
        $equipment_service             = new Equipment_service();
        $user_service                  = new User_service();
        $website_advertisement_service = new Website_advertisements_service();

        $vehicle_id = $this->uri->segment(3);

        $data['equipments']         = $equipment_service->get_all_active_equipment();
        $data['vehicle_detail']     = $vehicle_advertisments_service->get_advertisement_by_id($id);
        $data['seller_add']         = $user_service->get_user($data['vehicle_detail']->added_by);
        $data['images']             = $vehicle_images_service->get_images_for_advertisement($id);
        $data['vehicle_reviews']    = $vehicle_reviews_service->get_all_vehicle_reviews($vehicle_id);
        $data['review_looks_count'] = count($searched_vehicles_service->get_view_count_for_advertisement($id));

        $data['suggestions'] = $vehicle_advertisments_service->similar_suggestions($data['vehicle_detail']->manufacture_id, $data['vehicle_detail']->model_id); //Ashani

        $vehicle_equipments = $vehicle_equipment_service->get_equipments_by_vehicle_id($id);
        $equipment_array    = array();
        foreach ($vehicle_equipments as $value) {
            $equipment_array[] = $value->equipment_id;
        }

        $data['vehicle_equipments'] = $equipment_array;
        $data['latest_vehicles']    = $vehicle_advertisments_service->get_new_arrival(2);

        $data['commercial_images'] = $website_advertisement_service->get_advertisement_image();

        $parials = array('content' => 'vehicle_adds/vehicle_detail_view', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * This is to delete a advertisement by the user
     */
    function delete_advertisement() {

        $vehicle_advertisments_service = new Vehicle_advertisments_service();

        echo $vehicle_advertisments_service->delete_advertisement(trim($this->input->post('id', TRUE)));
    }

    /**
     * This is to send emails to sellers by users
     * author - nadeesha
     */
    function send_email_to_sellers() {

        $email_subject        = "AutoVille Customer Request";
        $data['user_name']    = $this->input->post('name', TRUE);
        $data['name']         = 'Sir/Madam';
        $user_email           = $this->input->post('user_email', TRUE);
        $data['phone']        = $this->input->post('phone', TRUE);
        $data['sender_email'] = $this->input->post('sender_email', TRUE);
        $data['msg']          = $this->input->post('comments', TRUE);
        $msg                  = $this->load->view('template/mail_template/body_ask', $data, TRUE);

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: AutoVille <autoville@gmail.com>' . "\r\n";
        $headers .= 'Cc: gayathma3@gmail.com,niklakshaya@gmail.com,heshani7.herath@gmail.com' . "\r\n";


        if (mail($user_email, $email_subject, $msg, $headers)) {
            echo "1";
        } else {
            echo "0";
        }

        //sms to admins
        $message = "New Advertisement has submitted. \n ";
//            $message .= 'Driver:' . $driver_details->Employee_Name . ' ' . $driver_details->last_name . ' \n ';
//            $message .= 'Start Time:' . $basic_request_details->required_date . ' \n ';
        $message .= 'Location(s):';

        $message .= $location_messages;
        $this->sms_handler->sendSMS(0765514269, $message); //correct one
    }

    /**
     * This is to update the is_featured status from 0 to 1- request featured
     * author- Nadeesha
     * 
     */
    function request_featured() {
        $vehicle_advertisments_model   = new Vehicle_advertisments_model();
        $vehicle_advertisments_service = new Vehicle_advertisments_service();

        $vehicle_advertisments_model->set_id(trim($this->input->post('id', TRUE)));
        $vehicle_advertisments_model->set_is_published(trim($this->input->post('value', TRUE)));

        echo $vehicle_advertisments_service->request_featured_advertisement($vehicle_advertisments_model);
    }

    /**
     * add search histrory details for user
     */
    function add_search_history() {
        if ($this->session->userdata('USER_ID') != '') {
            $searched_vehicles_model   = new Searched_vehicles_model();
            $searched_vehicles_service = new Searched_vehicles_service();

            $recent_vehicle_list = $searched_vehicles_service->get_all_searched_vehicles();

            foreach ($recent_vehicle_list as $vehicle) {

                if (($vehicle->user_id == $this->session->userdata('USER_ID')) && ($vehicle->vehicle_id == $this->input->post('vehicle_id', TRUE))) {
                    $searched_vehicles_service->delete_serached_record($vehicle->id);
                    break;
                }
            }

            $searched_vehicles_model->set_vehicle_id($this->input->post('vehicle_id', TRUE));
            $searched_vehicles_model->set_user_id($this->session->userdata('USER_ID'));
            $searched_vehicles_model->set_date(date("Y-m-d H:i:s"));

            echo $searched_vehicles_service->add_search_record($searched_vehicles_model);
        } else {
            echo '2';
        }
    }

}
