<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Website_comments extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('comments/comments_model');
        $this->load->model('comments/comments_service');

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');
    }

    /**
     * load all website comments in recent adds page
     */
    function load_all_website_comments() {
        $comments_service         = new Comments_service();
        $data['website_comments'] = $comments_service->get_all_comments();

        $parials = array('content' => 'vehicle_adds/recent_adds');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * list all website comments
     */
    function list_website_comments() {
        $comments_service              = new Comments_service();
        $vehicle_advertisments_service = new Vehicle_advertisments_service();

        $data['website_comments_list'] = $comments_service->get_all_comments_list();
        $data['latest_vehicles']       = $vehicle_advertisments_service->get_new_arrival(2);

        $parials = array('content' => 'vehicle_news/website_reviews_view', 'new_arrivals' => 'vehicle_adds/new_arrivals');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * add website comments
     */
    function add_website_comments() {
        $comments_service = new Comments_service();
        $comments_model   = new Comments_model();

        $comments_model->set_description($this->input->post('description', TRUE));
        $comments_model->set_title($this->input->post('title', TRUE));
        $comments_model->set_added_date(date("Y-m-d H:i:s"));
        $comments_model->set_added_by($this->session->userdata('USER_ID'));
        $comments_model->set_is_published('1');
        $comments_model->set_is_deleted('0');

        $comments_service->add_website_comments($comments_model);
        $website_comments = $comments_service->get_all_comments_list();

        foreach ($website_comments as $value) {
            ?>
            <li class="comment"><br>
                <figure><br><br>
                    <div class="image">
                        <?php if ($value->profile_pic == '') { ?>
                            <img class="img-responsive img-circle" style="width:100px; height:50px;" src="<?php echo base_url() . 'uploads/user_avatars/avatar.png'; ?>"/>
                        <?php } else { ?>
                            <img class="img-responsive img-circle" style="width:100px; height:50px;" src="<?php echo base_url() . 'uploads/user_avatars/' . $value->profile_pic; ?>"/>
                        <?php } ?>
                    </div>
                </figure>
                <div class="comment-wrapper">
                    <?php if ($value->added_by_user != '') { ?>
                        <div class="name pull-left"><?php echo ucfirst($value->added_by_user); ?></div>
                    <?php } ?>
                    <span class="date pull-right"><br><br><br><br>
                        <span class="fa fa-calendar"></span>
                        <?php echo date('Y.m.d', strtotime($value->added_date)); ?>
                    </span>
                    <p><header><a href="blog-detail.html"><h2><?php echo $value->title; ?></h2></a></header>
                    <?php echo $value->description; ?></p>
            </div>
            </li>

            <?php
        }
    }

}
