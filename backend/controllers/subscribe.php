<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subscribe extends CI_Controller {

    function __construct() {
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

    /**
     * This will display all the subscribers registered for newsletters
     */
    function manage_subscribers() {

        $subscribers_service = new Subscribers_service();

        $data['heading'] = "Manage Subscribers";
        $data['results'] = $subscribers_service->get_all_subscribers();

        $parials = array('content' => 'subscribers/manage_subscribers_view');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * This will display all newsletters
     */
    function manage_newsletters() {

        $newsletters_service = new Newsletters_service();

        $data['heading'] = "Manage Newsletters";
        $data['results'] = $newsletters_service->get_all_newsletters();

        $parials = array('content' => 'newsletters/manage_newsletters_view');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * Newsletter add view
     */
    function add_newsletter_view($id) {
        $newsletters_service = new Newsletters_service();

        $data['heading'] = "Send Newsletter";
        if ($id == '0') {
            $data['newsletter'] = NULL;
        } else {
            $data['newsletter'] = $newsletters_service->get_newsletter_by_id($id);
        }

        $parials = array('content' => 'newsletters/add_newsletter');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * save newsletter in database
     */
    function add_newsletter() {

        $newsletters_service = new Newsletters_service();
        $newsletters_model   = new Newsletters_model();

        $id = $this->input->post('newsletter_id', TRUE);

        $newsletters_model->set_subject($this->input->post('subject', TRUE));
        $newsletters_model->set_content($this->input->post('content', TRUE));
        $newsletters_model->set_status('0'); //not sent
        $newsletters_model->set_added_date(date("Y-m-d H:i:s"));

        if ($id == '') {
            $result = $newsletters_service->add_newsletter($newsletters_model);
        } else {
            $newsletters_model->set_id($id);

            $result = $newsletters_service->update_newsletter($newsletters_model);
        }
        echo $result;
    }

    /**
     * save newsletter in database and send to all subscribers
     */
    function send_newsletter() {
        $newsletters_service = new Newsletters_service();
        $newsletters_model   = new Newsletters_model();
        $subscribers_service = new Subscribers_service();
        
        $id = $this->input->post('newsletter_id', TRUE);

        $newsletters_model->set_subject($this->input->post('subject', TRUE));
        $newsletters_model->set_content($this->input->post('content', TRUE));
        $newsletters_model->set_added_date(date("Y-m-d H:i:s"));
        $newsletters_model->set_status('1'); // sent

        if ($id == '') {
            $result = $newsletters_service->add_newsletter($newsletters_model);
        } else {
            $newsletters_model->set_id($id);

            $result = $newsletters_service->update_newsletter($newsletters_model);
        }

        //send newsletters to subscribers
        $subscribers = $subscribers_service->get_active_subscribers();
        if (!empty($subscribers)) {
            foreach ($subscribers as $subscriber) {
                //send email
                $token           = $this->generate_random_string(); //generate account activation token
                $email_to        = $subscriber->email;
                $email_subject   = $this->input->post('subject', TRUE);
                $data['link']    = $this->config->item('URL') . '/home/unsubscribe?email=' . $subscriber->email . '&token=' . $token;
                $data['content'] = $this->input->post('content', TRUE);

                $msg = $this->load->view('template/mail_template/newsletter', $data, TRUE);

                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: AutoVille <info.autovillle@gmail.com>' . "\r\n";
                $headers .= 'Cc: gayathma3@gmail.com' . "\r\n";

                $result = mail($email_to, $email_subject, $msg, $headers);
            }

            echo $result;
            die();
        }
    }

    /**
     * generate random string for url tocken
     * @param integer $length Input tocken length
     * @return string tocken
     */
    public function generate_random_string($length = 10) {
        $characters    = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $random_string;
    }

    /**
     * This is to delete a transmission
     */
    function delete_newsletter() {
        $newsletters_service = new Newsletters_service();

        echo $newsletters_service->delete_newsletter(trim($this->input->post('id', TRUE)));
    }

    /**
     * send newsletter to all subscribers
     */
    function send_newsletter_again() {
        $subscribers_service = new Subscribers_service();

        //send newsletters to subscribers
        $result      = 0;
        $subscribers = $subscribers_service->get_active_subscribers();
        if (!empty($subscribers)) {
            foreach ($subscribers as $subscriber) {
                //send email
                $token           = $this->generate_random_string(); //generate account activation token
                $email_to        = $subscriber->email;
                $email_subject   = $this->input->post('subject', TRUE);
                $data['link']    = $this->config->item('URL') . '/home/unsubscribe?email=' . $subscriber->email . '&token=' . $token;
                $data['content'] = $this->input->post('content', TRUE);

                $msg = $this->load->view('template/mail_template/newsletter', $data, TRUE);

                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: AutoVille <info.autovillle@gmail.com>' . "\r\n";
                $headers .= 'Cc: gayathma3@gmail.com' . "\r\n";

                $result = mail($email_to, $email_subject, $msg, $headers);
            }

            echo $result;
            die();
        }
    }

}
