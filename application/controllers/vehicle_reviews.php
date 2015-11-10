<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle_reviews extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');

        $this->load->model('vehicle_reviews/vehicle_reviews_model');
        $this->load->model('vehicle_reviews/vehicle_reviews_service');
    }

    /**
     * function to load all vehicle reviews
     */
    function load_all_vehicle_reviews() {
        $vehicle_reviews_service = new Vehicle_reviews_service();
        $vehicle_id              = $this->uri->segment(3);
        $logged_user_id          = $this->session->userdata('USER_ID');
        $data['logged_user']     = $this->session->userdata('USER_ID');

        $data['vehicle_reviews'] = $vehicle_reviews_service->get_all_vehicle_reviews($vehicle_id);
        $data['user_id']         = $vehicle_reviews_service->get_logged_in_users_reviews($logged_user_id);

        $parials = array('content' => 'vehicle_adds/vehicle_detail_view');
        $this->template->load('template/main_template', $parials, $data);
    }

    /**
     * add vehicle reviews
     */
    function add_vehicle_reviews() {
        $vehicle_reviews_service = new Vehicle_reviews_service();
        $vehicle_reviews_model   = new Vehicle_reviews_model();
        $vehicle_id              = $this->input->post('vehicle_id', TRUE);

        $vehicle_reviews_model->set_description($this->input->post('description', TRUE));
        $vehicle_reviews_model->set_vehicle_id($this->input->post('vehicle_id', TRUE));
        if ($this->session->userdata('USER_ID') != '') {
            $vehicle_reviews_model->set_user_id($this->session->userdata('USER_ID'));
        }
        $vehicle_reviews_model->set_added_date(date("Y-m-d H:i:s"));
        $vehicle_reviews_model->set_added_by($this->session->userdata('USER_ID'));
        $vehicle_reviews_model->set_is_published('1');
        $vehicle_reviews_model->set_is_deleted('0');

        $vehicle_reviews_service->add_vehicle_reviews($vehicle_reviews_model);
        $vehicle_reviews = $vehicle_reviews_service->get_all_vehicle_reviews($vehicle_id);

        foreach ($vehicle_reviews as $value) {
            ?>
            <article class="review">
                <figure class="author">
                    <?php if ($value->profile_pic == '') { ?>
                        <img class="img-responsive " src="<?php echo base_url() . 'uploads/user_avatars/avatar.png'; ?>"/>
                    <?php } else { ?>
                        <img class="img-responsive " src="<?php echo base_url() . 'uploads/user_avatars/' . $value->profile_pic; ?>"/>
                    <?php } ?>
                    <div class="date"><?php echo date('Y.m.d', strtotime($value->added_date)); ?></div>
                </figure>
                <!-- /.author-->
                <div class="wrapper">
                    <?php if ($value->added_by_user != '') { ?>
                        <h5><?php echo ucfirst($value->added_by_user); ?></h5>
                    <?php } ?>
                    <p>
                        <?php echo $value->description; ?>
                    </p>
                    <?php if ($value->review_user == $this->session->userdata('USER_ID')) { ?>
                        <div class="item list admin-view">
                            <div class="description">
                                <ul class="list-unstyled actions">
                                    <li>
                                        <a style="cursor: pointer" onclick="display_edit_review_pop_up('<?php echo $value->id; ?>', '<?php echo $vehicle_id; ?>')"><i class="fa fa-pencil " title="Update"></i></a>   
                                    </li>
                                    <li>
                                        <a  style="cursor: pointer"  onclick="delete_comment('<?php echo $value->id; ?>', '<?php echo $vehicle_id; ?>')"><i class="fa fa-trash-o " title="Remove" style="color: red;"></i></a>
                                    </li>
                                </ul> 
                            </div>
                        </div>  
                    <?php } ?>
                </div>
                <!-- /.wrapper-->
            </article>

            <?php
        }
    }

    /**
     * delete vehicle review
     */
    function delete_review() {
        $vehicle_reviews_service = new Vehicle_reviews_service();
        $vehicle_reviews_service->delete_vehicle_reviews(trim($this->input->post('id', TRUE)));
        $vehicle_reviews         = $vehicle_reviews_service->get_all_vehicle_reviews($this->input->post('vehicle_id', TRUE));

        foreach ($vehicle_reviews as $value) {
            ?>
            <article class="review">
                <figure class="author">
                    <?php if ($value->profile_pic == '') { ?>
                        <img class="img-responsive " src="<?php echo base_url() . 'uploads/user_avatars/avatar.png'; ?>"/>
                    <?php } else { ?>
                        <img class="img-responsive " src="<?php echo base_url() . 'uploads/user_avatars/' . $value->profile_pic; ?>"/>
                    <?php } ?>
                    <div class="date"><?php echo date('Y.m.d', strtotime($value->added_date)); ?></div>
                </figure>
                <!-- /.author-->
                <div class="wrapper">
                    <?php if ($value->added_by_user != '') { ?>
                        <h5><?php echo ucfirst($value->added_by_user); ?></h5>
                    <?php } ?>
                    <p>
                        <?php echo $value->description; ?>
                    </p>
                    <?php if ($value->review_user == $this->session->userdata('USER_ID')) { ?>
                        <div class="item list admin-view">
                            <div class="description">
                                <ul class="list-unstyled actions">
                                    <li>
                                        <a style="cursor: pointer" onclick="display_edit_review_pop_up(<?php echo $value->id; ?>)"><i class="fa fa-pencil " title="Update"></i></a>   
                                    </li>
                                    <li>
                                        <a  style="cursor: pointer"  onclick="delete_comment(<?php echo $value->id; ?>)"><i class="fa fa-trash-o " title="Remove" style="color: red;"></i></a>
                                    </li>
                                </ul> 
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- /.wrapper-->
            </article>

            <?php
        }
    }

    /**
     * Edit transmission pop up content set up and then send .
     */
    function load_edit_review_content() {
        $vehicle_reviews_service = new Vehicle_reviews_service();
        $vehicle_reviews_model   = new Vehicle_reviews_model();

        $vehicle_reviews_model->set_id(trim($this->input->post('review_id', TRUE)));
        $review             = $vehicle_reviews_service->get_review_by_id($vehicle_reviews_model);
        $data['review']     = $review;
        $data['vehicle_id'] = $this->input->post('vehicle_id', TRUE);

        echo $this->load->view('vehicle_adds/vehicle_reviews_edit_view', $data, TRUE);
    }

    /**
     * This function is to update the review details
     */
    function edit_review() {

        $vehicle_reviews_service = new Vehicle_reviews_service();
        $vehicle_reviews_model   = new Vehicle_reviews_model();

        $vehicle_reviews_model->set_id($this->input->post('review_id', TRUE));
        $vehicle_reviews_model->set_description($this->input->post('description', TRUE));
        $vehicle_reviews_model->set_updated_by($this->session->userdata('USER_ID'));
        $vehicle_reviews_model->set_updated_date(date("Y-m-d H:i:s"));

        $vehicle_reviews_service->update_reviews($vehicle_reviews_model);
        $vehicle_reviews = $vehicle_reviews_service->get_all_vehicle_reviews($this->input->post('vehicle_id', TRUE));

        foreach ($vehicle_reviews as $value) {
            ?>
            <article class="review">
                <figure class="author">
                    <?php if ($value->profile_pic == '') { ?>
                        <img class="img-responsive " src="<?php echo base_url() . 'uploads/user_avatars/avatar.png'; ?>"/>
                    <?php } else { ?>
                        <img class="img-responsive " src="<?php echo base_url() . 'uploads/user_avatars/' . $value->profile_pic; ?>"/>
                    <?php } ?>
                    <div class="date"><?php echo date('Y.m.d', strtotime($value->added_date)); ?></div>
                </figure>
                <!-- /.author-->
                <div class="wrapper">
                    <?php if ($value->added_by_user != '') { ?>
                        <h5><?php echo ucfirst($value->added_by_user); ?></h5>
                    <?php } ?>
                    <p>
                        <?php echo $value->description; ?>
                    </p>
                    <?php if ($value->review_user == $this->session->userdata('USER_ID')) { ?>
                        <div class="item list admin-view">
                            <div class="description">
                                <ul class="list-unstyled actions">
                                    <li>
                                        <a style="cursor: pointer" onclick="display_edit_review_pop_up(<?php echo $value->id; ?>)"><i class="fa fa-pencil " title="Update"></i></a>   
                                    </li>
                                    <li>
                                        <a  style="cursor: pointer"  onclick="delete_comment(<?php echo $value->id; ?>)"><i class="fa fa-trash-o " title="Remove" style="color: red;"></i></a>
                                    </li>
                                </ul> 
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- /.wrapper-->
            </article>

            <?php
        }
    }

}
