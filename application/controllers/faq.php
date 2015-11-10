<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('faq/faq_model');
        $this->load->model('faq/faq_service');

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');

        $this->load->model('website_advertisements/website_advertisements_service');
    }

    /**
     * load all questions and show them in the site
     */
    function load_all_questions() {
        $faq_service           = new faq_service();
        $data['faq_questions'] = $faq_service->get_all_questions();

        $parials = array('content' => 'vehicle_adds/recent_adds');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * list all questions and answers in the faq page
     */
    function list_faq_questions() {
        $faq_service                   = new faq_service();
        $vehicle_advertisments_service = new Vehicle_advertisments_service();
        $website_advertisement_service = new Website_advertisements_service();

        $data['faq_question_list'] = $faq_service->get_all_questions_list();
        $data['latest_vehicles']   = $vehicle_advertisments_service->get_new_arrival(2);
        $data['commercial_images'] = $website_advertisement_service->get_advertisement_image();

        $parials = array('content' => 'content_pages/faq_view', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * add faq questions
     */
    function add_faq_questions() {
        $faq_model   = new faq_model();
        $faq_service = new faq_service();

        $faq_model->setEmail($this->input->post('email', TRUE));
        $faq_model->setQuestion($this->input->post('question', TRUE));
        $faq_model->setAdded_date($this->input->post(date("Y-m-d H:i:s")));
        $faq_model->setAdded_by($this->session->userdata('USER_ID'));
        $faq_model->setIs_published('1');
        $faq_model->setIs_deleted('0');

        $faq_service->add_questions($faq_model);
        $questions = $faq_service->get_all_questions_list();


        foreach ($questions as $value) {
            ?> 
            <div id="question_list">
                <article class="faq-single" >
                    <i class="fa fa-question-circle"></i>
                    <div class="wrapper">
                        <h4><?php echo $value->question; ?>
                        </h4>
                        <div class="answer">
            <?php if ($value->answer == '') { ?>
                                <figure>Answer</figure>
                                <p>
                <?php echo ("Not yet Answered!"); ?>  
                                </p>
                            <?php } else { ?>
                                <figure>Answer</figure>
                                <p>
                                    <?php echo $value->answer; ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </article>
            </div>
                            <?php
                        }
                    }

                }
                