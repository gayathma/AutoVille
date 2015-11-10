<?php

class Inquries extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('inquries/inquries_model');
        $this->load->model('inquries/inquries_service');
    }

    /**
     * This service function to add an inqurie
     */
    function add_inqurie() {
        $inqurie_model   = new Inquries_model();
        $inqurie_service = new Inquries_service();
        $data['name']    = $this->input->post('name', TRUE);
        $data['message'] = $this->input->post('message', TRUE);
        $data['email']   = $this->input->post('email', TRUE);

        $inqurie_model->set_name($this->input->post('name', TRUE));
        $inqurie_model->set_email($this->input->post('email', TRUE));
        $inqurie_model->set_message($this->input->post('message', TRUE));
        $inqurie_model->set_added_date(date("Y-m-d H:i:s"));
        $inqurie_model->set_is_deleted('0');

        $msg = $inqurie_service->add_inquries($inqurie_model);

        if ($msg == '1') {
            $email         = 'info.autovillle@gmail.com';
            $email_subject = "AutoVille New Inquiry";
            $mseg          = $this->load->view('template/mail_template/contact_us', $data, TRUE);

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: AutoVille <autoville@gmail.com>' . "\r\n";
            $headers .= 'Cc: ishanipathinayake@gmail.com' . "\r\n";

            mail($email, $email_subject, $mseg, $headers);
        }

        echo $msg;
    }

}
