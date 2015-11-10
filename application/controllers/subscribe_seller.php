<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subscribe_seller extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('seller_subscribers/seller_subscribers_model');
        $this->load->model('seller_subscribers/seller_subscribers_service');
    }

    /**
     * add subscriber for seller and send email to subscriber if subscription is successfull
     */
    function add_seller_subscriber() {

        $seller_subscribers_model = new Seller_subscribers_model();
        $seller_subscribers_service = new Seller_subscribers_service();

        $seller_subscribers_model->set_email($this->input->post('subscriber_email', TRUE));
        $seller_subscribers_model->set_seller_id($this->input->post('seller_id', TRUE));
        $seller_subscribers_model->set_is_deleted('0');
        $seller_subscribers_model->set_added_date(date("Y-m-d H:i:s"));

        $msg = $seller_subscribers_service->insert_seller_subscriber($seller_subscribers_model);

        if ($msg == '1') {
            //send email
            $email_to = $this->input->post('subscriber_email', TRUE); //'heshani7.herath@gmail.com';
            $email_subject = "AutoVille Subscription Notification";

            if ($this->session->userdata('USER_LOGGED_IN')) {
                $data['subscriber'] = $this->session->userdata('USER_FULLNAME');
            } else {
                $data['subscriber'] = 'Sir / Madam';
            }
            $data['seller'] = $this->input->post('seller_name', TRUE);

            $msg = $this->load->view('template/mail_template/seller_subscription', $data, TRUE);

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: AutoVille <info.autovillle@gmail.com>' . "\r\n";
            // $headers .= 'Cc: info.autovillle@gmail.com' . "\r\n";

            if (mail($email_to, $email_subject, $msg, $headers)) {
                echo "1";
                die();
            } else {
                echo "2";
                die();
            }
        }       
    }

}
